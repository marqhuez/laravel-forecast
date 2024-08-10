<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forecasts', [ForecastController::class, 'index']);
