<?php

use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\StatsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->middleware('throttle:5,1')->group(function () {
    Route::get('/ping', fn () => response()->json(
        ['status' => 'ok', 'message' => 'Сервер автосалона работает', 'time' => now()->toIso8601String()],
        200,
        [],
        JSON_UNESCAPED_UNICODE
    ));

    Route::get('/stats', StatsController::class)->name('stats');

    // random объявляем ДО apiResource, иначе слово "random" попадёт в {car}
    Route::get('/cars/random', [CarController::class, 'random'])->name('cars.random');
    Route::apiResource('cars', CarController::class)->only(['index', 'show']);

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/{brand}/cars', [BrandController::class, 'cars'])->name('brands.cars');
});