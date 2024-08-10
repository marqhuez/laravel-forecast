<?php

namespace App\Infrastructure\DTOs;

class HourlyForecast
{
    public function __construct(public readonly string $time, public readonly float $temp) {
    }
}
