<?php

namespace App\Http\Controllers;

use App\Application\GetForecastHandler;
use App\Application\GetForecastQuery;
use App\Models\Forecast;
use App\Shared\ExpectedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ForecastController
{
    public function index(Request $request, GetForecastHandler $handler)
    {
        Log::info('get forecast request arrived', $request->toArray());
        $cityName = $request->query('cityName');

        if (!$cityName) {
            return response()->json(['message' => 'cityName is required'], 400);
        }

        try {
            $query = new GetForecastQuery($cityName);
            $result = $handler->getForecast($query);
        } catch (ExpectedException $exception) {
            Log::error('error while requesting forecast', [
                "error" => $exception->getMessage(),
                "prevMessage" => $exception->getPrevious()->getMessage()
            ]);

            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        } catch (Throwable $exception) {
            Log::error('unexpected error while requesting forecast', ["error" => $exception->getMessage()]);

            return response()->json(['message' => "unexpected error"], 500);
        }

        return response()->json($result);
    }

    public function createForecast(Request $req)
    {
        $forecast = Forecast::create($req->all());

        return response()->json($forecast, 201);
    }
}
