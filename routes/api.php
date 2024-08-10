<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/forecast', [ForecastController::class, 'index']);
Route::post('/forecast', [ForecastController::class, 'create']);
