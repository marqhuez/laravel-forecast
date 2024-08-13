<?php

namespace App\Console\Commands;

use App\Application\GetForecastHandler;
use App\Application\GetForecastQuery;
use App\Infrastructure\DTOs\Forecast;
use App\Infrastructure\DTOs\HourlyForecast;
use App\Shared\ExpectedException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class FetchForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-forecast {cityName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches forecast for a city.';

    /**
     * Execute the console command.
     */
    public function handle(GetForecastHandler $handler)
    {
        Log::info('get forecast command arrived');
        $cityName = $this->argument('cityName');

        if (!$cityName) {
            Log::error('cityName is required');

            $this->error('cityName is required');
            return 1;
        }

        $this->info('requesting forecast for city: ' . $cityName);

        try {
            $query = new GetForecastQuery($cityName);
            /** @var Forecast $result */
            $result = $handler->getForecast($query);

            $this->info('GPS Coordinates: ' . $result->gpsCoordinates->lon . ' '. $result->gpsCoordinates->lat);

            /** @var HourlyForecast $forecast */
            foreach ($result->hourlyForecasts as $forecast) {
                $this->info(date('j F, Y H:i:s', strtotime($forecast->time)) . ': ' . $forecast->temp . ' ' . $result->unit);
            }
        } catch (ExpectedException $exception) {
            Log::error('error while requesting forecast', [
                "error" => $exception->getMessage(),
                "prevMessage" => $exception->getPrevious()->getMessage()
            ]);

            $this->error($exception->getMessage());
            return 1;
        } catch (Throwable $exception) {
            Log::error('unexpected error while requesting forecast', ["error" => $exception->getMessage()]);

            $this->error('unexpected error');
            return 1;
        }
    }
}
