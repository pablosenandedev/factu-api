<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/me', [\App\Http\Controllers\Api\AuthController::class, 'me']);
        Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
        Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
        Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
});