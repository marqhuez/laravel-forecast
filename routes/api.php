<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/forecasts/{cityName}', [ForecastController::class, 'index']);
Route::post('/forecasts', [ForecastController::class, 'create']);
