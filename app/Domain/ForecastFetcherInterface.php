<?php

namespace App\Domain;

interface ForecastFetcherInterface
{
    public function getForecast(string $cityName);
}
