<?php

namespace App\Infrastructure;

use App\Shared\ExpectedException;
use App\Domain\ForecastFetcherInterface;
use App\Jobs\SyncForecasts;
use App\Models\Forecast;
use Illuminate\Support\Facades\Log;
use Throwable;

class ForecastFetcherAdapter implements ForecastFetcherInterface
{
    public function __construct(
        private WeatherApiClient $weatherApiClient,
        private GeolocationApiClient $geolocationApiClient
    ) {
    }

    public function getForecast(string $cityName)
    {
        try {
            $gpsCoords = $this->geolocationApiClient->fetchGPSCoordFromCityName($cityName);
            $forecast = $this->weatherApiClient->fetchForecastForCoords($gpsCoords);
        } catch (Throwable $exception) {
            $message = "error while requesting forecast data";
            Log::error($message, ["error" => $exception->getMessage()]);

            throw new ExpectedException($message, 400, $exception);
        }

        SyncForecasts::dispatch($forecast, $cityName);

        return $forecast;
    }
}
