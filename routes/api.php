<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChartDataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Chart data endpoints
Route::get('/chart-data/admin', [ChartDataController::class, 'adminChartData'])
    ->middleware('auth:web');