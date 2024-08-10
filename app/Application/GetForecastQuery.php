<?php

namespace App\Application;

class GetForecastQuery
{
    public function __construct(public readonly string $cityName)
    {
    }
}
