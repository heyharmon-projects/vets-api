<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use DDD\Http\Locations\LocationScreenshotController;
use DDD\Http\Locations\LocationController;

// Subscriptions
// Route::prefix('locations')->group(function() {
//     Route::get('/', [LocationController::class, 'index']);
//     Route::get('/{location}', [LocationController::class, 'show']);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('locations', LocationController::class);
    Route::get('locations/screenshot/{location}', [LocationScreenshotController::class, 'take']);
});
