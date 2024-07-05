<?php

namespace App\Http\Controllers;

use App\Events\ThingspeakDataUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ThingSpeakController extends Controller
{


    public function showData()
    {
        // $channelId = 276330;  // Public channel ID for soil moisture data
        // $url = "https://api.thingspeak.com/channels/{$channelId}/feeds.json?results=10";

        // $response = Http::get($url);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     event(new ThingspeakDataUpdated($data['feeds']));

        //     return view('thingspeak-data', ['data' => $data['feeds']]);
        // }
        // $filePath = resource_path('js/feeds.json');

        // if (File::exists($filePath)) {
        //     $data = json_decode(File::get($filePath), true);
        //     Log::info('Event is being fired'); // Add this line to log the event firing

        //     event(new ThingspeakDataUpdated($data['feeds']));

        //     return view('thingspeak-data', ['data' => $data['feeds']]);
        // }


        // return view('thingspeak-data', ['data' => []]);
        return view('thingspeak-data');

    }


    // public function showData()
    // {
    //     // $channelId = 276330;  // Public channel ID for soil moisture data
    //     // $url = "https://api.thingspeak.com/channels/{$channelId}/feeds.json?results=10";

    //     // $response = Http::get($url);

    //     // if ($response->successful()) {
    //     //     $data = $response->json();
    //     //     event(new ThingspeakDataUpdated($data['feeds']));

    //     //     return view('thingspeak-data', ['data' => $data['feeds']]);
    //     // }
    //     $filePath = resource_path('js/feeds.json');

    //     if (File::exists($filePath)) {
    //         $data = json_decode(File::get($filePath), true);
    //         Log::info('Event is being fired'); // Add this line to log the event firing

    //         event(new ThingspeakDataUpdated($data['feeds']));

    //         return view('thingspeak-data', ['data' => $data['feeds']]);
    //     }


    //     return view('thingspeak-data', ['data' => []]);

    // }


}
