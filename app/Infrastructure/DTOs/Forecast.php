<?php

namespace App\Infrastructure\DTOs;

use App\Infrastructure\DTOs\GPSCoordinates;

class Forecast
{
    /** @param OneHourForecast[] $oneHourForecasts */
    public function __construct(
        public readonly GPSCoordinates $gpsCoordinates,
        public readonly string $unit,
        public readonly array $oneHourForecasts
    ) {
    }
}
