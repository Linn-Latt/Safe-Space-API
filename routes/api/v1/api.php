<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Authentication\AuthenticationController;

// Authentication routes with rate limiting
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
