<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use DDD\Http\Locations\LocationScreenshotController;
use DDD\Http\Locations\LocationController;
use DDD\Http\Contacts\ContactController;
use DDD\Http\Base\Files\FileController;

// Subscriptions
// Route::prefix('locations')->group(function() {
//     Route::get('/', [LocationController::class, 'index']);
//     Route::get('/{location}', [LocationController::class, 'show']);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('locations', LocationController::class);
    // Route::apiResource('files', FileController::class);

    Route::prefix('locations/{location}')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::post('/contacts', [ContactController::class, 'store']);
        Route::post('contacts/{contact}', [ContactController::class, 'update']);
        Route::get('contacts/{contact}', [ContactController::class, 'show']);
        Route::delete('contacts/{contact}', [ContactController::class, 'destroy']);
    });

    Route::prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index']);
        Route::post('/', [FileController::class, 'store']);
        Route::post('/{file}', [FileController::class, 'update']);
        Route::get('/{file}', [FileController::class, 'show']);
        Route::delete('/{file}', [FileController::class, 'destroy']);
    });

    // Organizations
    // Route::get('organizations', [OrganizationController::class, 'index']);
    // Route::post('organizations', [OrganizationController::class, 'store']);
    // Route::get('organizations/{organization:slug}', [OrganizationController::class, 'show']);
    // Route::put('organizations/{organization:slug}', [OrganizationController::class, 'update']);
    // Route::delete('organizations/{organization:slug}', [OrganizationController::class, 'destroy']);

    Route::get('locations/screenshot/{location}', [LocationScreenshotController::class, 'take']);
});
