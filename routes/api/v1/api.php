<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Authentication\AuthenticationController;
use App\Http\Controllers\Api\V1\MoodTracker\MoodEntryController;
use App\Http\Controllers\Api\V1\MoodTracker\WeeklyMoodFeedbackController;
use App\Http\Controllers\Api\V1\Post\PostCommentController;
use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\Profile\ProfileController;
use App\Http\Controllers\Api\v1\SelfAssessmentTest\SelfAssessmentTestController;

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

    // Profile
    Route::patch('/toggle-anonymous', [ProfileController::class, 'toggleAnonymous']);

    // Mood Tracking
    Route::post('/mood-entry', [MoodEntryController::class, 'store']);
    Route::get('/weekly-mood-feedback', [WeeklyMoodFeedbackController::class, 'getWeeklyMoodFeedback']);

    // Self Assessment Tests
    Route::get('/tests', [SelfAssessmentTestController::class, 'getTests']);
    Route::get('/tests/{test}/questions', [SelfAssessmentTestController::class, 'getTestQuestions']);
    Route::post('/tests/{test}/submit', [SelfAssessmentTestController::class, 'submitTestAnswers']);
    
    // Review Past Test Results
    Route::get('/tests-history', [SelfAssessmentTestController::class, 'getUserTestHistory']);
    Route::get('/test-results/{attempt}', [SelfAssessmentTestController::class, 'getTestResult']);

    // Post
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::put('/post/{post}', [PostController::class, 'update']);
    Route::delete('/post/{post}', [PostController::class, 'destory']);

    // Post Comment
    Route::get('/post/{post}/comments', [PostCommentController::class, 'index']);
    Route::post('/post/{post}/comment', [PostCommentController::class, 'store']);
});
