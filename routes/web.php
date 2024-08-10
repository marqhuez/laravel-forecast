<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Support\Facades\Route;

Route::get('/forecast', [ForecastController::class, 'index']);
Route::get('/', function () {
    return view('forecast');
});
