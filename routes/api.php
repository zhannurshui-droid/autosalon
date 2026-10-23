<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\StatsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookingController;

Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    Route::get('/ping', fn () => response()->json(
        ['status' => 'ok', 'message' => 'Сервер автосалона работает', 'time' => now()->toIso8601String()],
        200,
        [],
        JSON_UNESCAPED_UNICODE
    ));

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');

    Route::get('/stats', StatsController::class)->name('stats');

    Route::get('/cars/random', [CarController::class, 'random'])->name('cars.random');
    Route::apiResource('cars', CarController::class)->only(['index', 'show']);

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/{brand}/cars', [BrandController::class, 'cars'])->name('brands.cars');

    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::get('/me/bookings', [BookingController::class, 'mine'])->name('me.bookings');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/tokens', [AuthController::class, 'logoutAll'])->name('tokens.destroy');

    Route::post('/cars/{car}/bookings', [BookingController::class, 'store'])->name('cars.bookings.store');

    Route::apiResource('cars', CarController::class)->only(['store', 'update', 'destroy']);
});
    Route::apiResource('cars', CarController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('abilities:write');
});