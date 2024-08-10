<?php

namespace App\Infrastructure\DTOs;

class OneHourForecast
{
    public function __construct(public readonly string $time, public readonly float $temp) {
    }
}
