<?php

namespace App\Application;

use App\Domain\ForecastFetcherInterface;

class GetForecastHandler
{
    public function __construct(private ForecastFetcherInterface $forecastFetcher)
    {
    }

    public function getForecast(GetForecastQuery $query)
    {
        return $this->forecastFetcher->getForecast($query->cityName);
    }
}
