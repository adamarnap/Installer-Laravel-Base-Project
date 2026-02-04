<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * =======================================================================================================
 * ======================================== ADMIN API ROUTES =============================================
 * =======================================================================================================
 * 
 * All routes here will be prefixed with: /api/admin
 * Example: /api/admin/users
 */

/* =========== Public Routes */
Route::prefix('auth')->group(function () {
    // Route::post('/login', [AdminAuthController::class, 'login']);
});

/* =========== Private Routes (Requires Authentication) */
Route::middleware('auth:sanctum')->group(function () {
    
    /* == Dashboard */
    Route::get('/dashboard', function (Request $request) {
        return [
            'message' => 'Admin Dashboard',
            'user' => $request->user()
        ];
    });

    /* == User Management */
    Route::prefix('users')->group(function () {
        // Route::get('/', [AdminUserController::class, 'index']);
        // Route::post('/', [AdminUserController::class, 'store']);
        // Route::get('/{id}', [AdminUserController::class, 'show']);
        // Route::put('/{id}', [AdminUserController::class, 'update']);
        // Route::delete('/{id}', [AdminUserController::class, 'destroy']);
    });

    /* == Add more admin-specific routes here */
});
