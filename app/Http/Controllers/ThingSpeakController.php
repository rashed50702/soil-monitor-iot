<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThingSpeakController extends Controller
{
    public function showData()
    {
        $channelId = 276330;  // Public channel ID for soil moisture data
        $url = "https://api.thingspeak.com/channels/{$channelId}/feeds.json?results=10";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return view('thingspeak-data', ['data' => $data['feeds']]);
        }

        return view('thingspeak-data', ['data' => []]);

    }
}
