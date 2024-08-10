<?php

namespace App\Infrastructure;

use App\Infrastructure\DTOs\GPSCoordinates;
use Illuminate\Support\Facades\Http;

class GeolocationApiClient
{
    public function fetchGPSCoordFromCityName(string $cityName)
    {
        $apiKey = "5e41caf28ba141fca47f80db6be4d7ab";
        $response = Http::get('https://api.geoapify.com/v1/geocode/search', [
            'text' => $cityName,
            'apiKey' => $apiKey
        ])->json();

        $lon = $response['features'][0]['properties']["lon"];
        $lat = $response['features'][0]['properties']["lat"];

        return new GPSCoordinates($lon, $lat);
    }
}
