<?php

namespace App\Infrastructure;

use App\Infrastructure\DTOs\GPSCoordinates;
use Illuminate\Support\Facades\Http;

class GeolocationApiClient
{
    public function fetchGPSCoordFromCityName(string $cityName)
    {
        $response = Http::get(env('GEOLOCATION_API_URL'), [
            'text' => $cityName,
            'apiKey' => env('GEOLOCATION_API_KEY')
        ])->json();

        $lon = $response['features'][0]['properties']['lon'];
        $lat = $response['features'][0]['properties']['lat'];

        return new GPSCoordinates($lon, $lat);
    }
}
