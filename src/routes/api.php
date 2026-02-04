<?php

use Illuminate\Support\Facades\Route;

/**
 * =======================================================================================================
 * ========================================= API ROUTES INDEX ============================================
 * =======================================================================================================
 * 
 * This file serves as the main router for API endpoints.
 * Routes are organized by platform/purpose in separate files.
 * 
 * Available API Endpoints:
 * - /api/mobile/*  -> Mobile application routes
 * - /api/admin/*   -> Admin dashboard routes
 */

// Mobile API Routes (prefix: /api/mobile)
Route::prefix('mobile')->group(function () {
    require __DIR__ . '/api/mobile.php';
});

// Admin API Routes (prefix: /api/admin)
Route::prefix('admin')->group(function () {
    require __DIR__ . '/api/admin.php';
});
