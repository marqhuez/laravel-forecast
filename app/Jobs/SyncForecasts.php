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

            $existingForecast = Forecast::where('city', $this->cityName)->where('time', $time);
            $result = $existingForecast->first();

            if ($result) {
                Log::info('existing forecast found, updating', ['city' => $result->city, 'temp' => $result->temperature]);

                $existingForecast->update(['temperature' => $forecast->temp]);
            } else {
                Log::info('existing forecast not found, creating', [
                    'city' => $this->cityName,
                    'time' => $forecast->time,
                    'temp' => $forecast->temp
                ]);

                Forecast::create([
                    "city" => $this->cityName,
                    "time" => $time,
                    "temperature" => $forecast->temp
                ]);
            }
        }
    }
}
