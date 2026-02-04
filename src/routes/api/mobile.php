<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Mobile\AuthController;
use App\Http\Controllers\Api\Mobile\ProfileController;

/**
 * =======================================================================================================
 * ======================================== MOBILE API ROUTES ============================================
 * =======================================================================================================
 * 
 * All routes here will be prefixed with: /api/mobile
 * Example: /api/mobile/auth/login
 */

/* =========== Public Routes */
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

/* =========== Private Routes (Requires Authentication) */
Route::middleware('auth:sanctum')->group(function () {
    
    /* == Auth Routes */
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
    });

    /* == User Profile Routes */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::put('/avatar', [ProfileController::class, 'updateProfilePhoto']);
    });

    /* == Add more mobile-specific routes here */
});
