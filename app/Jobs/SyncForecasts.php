<?php

namespace App\Jobs;

use App\Infrastructure\DTOs\Forecast as ForecastDTO;
use App\Infrastructure\DTOs\HourlyForecast;
use App\Models\Forecast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncForecasts implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private ForecastDTO $forecast,
        private string $cityName
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('syncing job handling started');

        /** @var HourlyForecast $forecast */
        foreach ($this->forecast->hourlyForecasts as $forecast) {
            $time = strtotime($forecast->time);

            $newForecast = Forecast::updateOrCreate(['city' => $this->cityName, 'time' => $time], ['temp' => $forecast->temp]);

            Log::info('created or updated forecast', ['city' => $newForecast->city, 'temp' => $newForecast->temperature, 'time' => $newForecast->time]);
        }
    }
}
