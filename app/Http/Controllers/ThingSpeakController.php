<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ThingSpeakController extends Controller
{
    public function showData()
    {
        $channelId = 276330;  // Public channel ID for soil moisture data
        $url = "https://api.thingspeak.com/channels/{$channelId}/feeds.json?results=10";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['feeds'])) {
                // Sort feeds by created_at datetime in descending order
                usort($data['feeds'], function ($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });

                // Get the latest entry
                $latestEntry = $data['feeds'][0];

                // Format created_at datetime using Carbon
                $latestEntry['formatted_created_at'] = Carbon::parse($latestEntry['created_at'])->timezone('Asia/Dhaka')->format('M d, Y, h:i:s A');
                return view('thingspeak-data', [
                    'channel' => $data['channel'],
                    'latestEntry' => $latestEntry
                ]);
            }

            return view('thingspeak-data', ['channel' => $data['channel'], 'latestEntry' => null]);
        }

        return view('thingspeak-data', ['channel' => [], 'latestEntry' => null]);
    }
}
