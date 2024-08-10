<?php

namespace App\Infrastructure\DTOs;

use App\Infrastructure\DTOs\GPSCoordinates;

class Forecast
{
    /** @param HourlyForecast[] $oneHourForecasts */
    public function __construct(
        public readonly GPSCoordinates $gpsCoordinates,
        public readonly string $unit,
        public readonly array $hourlyForecasts
    ) {
    }
}
