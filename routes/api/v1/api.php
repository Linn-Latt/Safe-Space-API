<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Authentication\AuthenticationController;

// API Health Check
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'Safe Space API is running',
        'version' => 'v1',
        'timestamp' => now()->toISOString(),
    ]);
});

// Authentication routes with rate limiting
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
});
