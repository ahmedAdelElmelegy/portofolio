<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\WorkProcessController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Test route
Route::get('/welcome/{name}', [TestController::class, 'index']);

// Public Auth Route
Route::post('/login', [AuthController::class, 'login']);

// Public Read-Only Endpoints
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);

Route::get('/skills', [SkillController::class, 'index']);
Route::get('/skills/{skill}', [SkillController::class, 'show']);

Route::get('/experiences', [ExperienceController::class, 'index']);
Route::get('/experiences/{experience}', [ExperienceController::class, 'show']);

Route::get('/work-processes', [WorkProcessController::class, 'index']);

Route::get('/profiles', [ProfileController::class, 'index']);
Route::get('/profiles/{profile}', [ProfileController::class, 'show']);

// Public Contact Message Sending
Route::post('/contact-messages', [ContactMessageController::class, 'store']);

// Protected Admin Endpoints
Route::middleware('auth:sanctum')->group(function () {
    // Auth Logout & User Info
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Write operations for portfolio data
    Route::apiResource('projects', ProjectController::class)->except(['index', 'show']);
    Route::apiResource('skills', SkillController::class)->except(['index', 'show']);
    Route::apiResource('experiences', ExperienceController::class)->except(['index', 'show']);
    Route::apiResource('profiles', ProfileController::class)->except(['index', 'show']);

    // Admin operations for Contact Messages
    Route::apiResource('contact-messages', ContactMessageController::class)->except(['store']);
});
