<?php

namespace App\Infrastructure\DTOs;

class GPSCoordinates
{
    public function __construct(public readonly float $lon, public readonly float $lat)
    {
    }
}
