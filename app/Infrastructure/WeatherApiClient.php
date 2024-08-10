<?php

namespace App\Infrastructure;

use App\Infrastructure\DTOs\Forecast;
use App\Infrastructure\DTOs\GPSCoordinates;
use App\Infrastructure\DTOs\OneHourForecast;
use Illuminate\Support\Facades\Http;

class WeatherApiClient
{
    public function fetchForecastForCoords(GPSCoordinates $gpsCoords)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $gpsCoords->lat,
            'longitude' => $gpsCoords->lon,
            'hourly' => 'temperature_2m'
        ])->json();

        $forecasts = [];
        foreach ($response["hourly"]["time"] as $key => $time) {
            $forecasts[] = new OneHourForecast($time, $response["hourly"]["temperature_2m"][$key]);
        }

        return new Forecast($gpsCoords, $response["hourly_units"]["temperature_2m"], $forecasts);
    }
}
