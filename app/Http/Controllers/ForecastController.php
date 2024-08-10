<?php

namespace App\Http\Controllers;

use App\Application\GetForecastHandler;
use App\Application\GetForecastQuery;
use App\Models\Forecast;
use App\Shared\ExpectedException;
use Illuminate\Http\Request;
use Throwable;

class ForecastController
{
    public function index(Request $req, GetForecastHandler $handler)
    {
        $query = new GetForecastQuery("Debrecen");
        try {
            $result = $handler->getForecast($query);
        } catch (ExpectedException $exception) {
            return response()->json(["message" => $exception->getMessage()], $exception->getCode());
        } catch (Throwable $exception) {
            return response()->json(["message" => "unexpected error"], 500);
        }

        return response()->json($result);
    }

    public function createForecast(Request $req)
    {
        $forecast = Forecast::create($req->all());

        return response()->json($forecast, 201);
    }
}
