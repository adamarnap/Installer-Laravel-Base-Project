<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Settings\AppsLogController;
use App\Http\Controllers\Admin\Settings\CacheController;
use App\Http\Controllers\Admin\Settings\ImpersonateController;
use App\Http\Controllers\Admin\Settings\MigrationsController;
use App\Http\Controllers\Admin\Settings\NavigationsController;
use App\Http\Controllers\Admin\Settings\PreferencesController;
use App\Http\Controllers\Admin\Settings\QueuesController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\Settings\SchedulersController;
use App\Http\Controllers\Admin\Settings\SeedersController;
use App\Http\Controllers\Admin\Settings\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* 
|--------------------------------------------------------------------------
| Landing Routes
|--------------------------------------------------------------------------
*/
Route::resource('/beranda', BerandaController::class)->names(['beranda']);
Route::redirect('/', '/beranda');

/* 
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth', 'verified')->group(function () {
    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---- Settings */
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        /* Users */
        Route::resource('users', UsersController::class)->names('users');
        /* Impersonate */
        Route::get('/impersonate', [ImpersonateController::class, 'index'])
            ->name('impersonate.index');

        Route::post('/impersonate/{userId}', [ImpersonateController::class, 'store'])
            ->name('impersonate.store');

        Route::delete('/impersonate/{userId}', [ImpersonateController::class, 'destroy'])
            ->name('impersonate.destroy');
        /* Roles */
        Route::resource('roles', RolesController::class)->names('roles');
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
        /* Navigation */
        Route::resource('navs', NavigationsController::class)->names('navs');
        /* Preferences */
        Route::resource('preferences', PreferencesController::class)->names('preferences');

        /* Cache Management */
        Route::get('/cache', [CacheController::class, 'index'])->name('cache.index');
        Route::post('/cache/execute', [CacheController::class, 'execute'])->name('cache.execute');

        /* App Logs */
        Route::get('/apps-log', [AppsLogController::class, 'index'])->name('apps-log.index');
        Route::get('/apps-log/{filename}', [AppsLogController::class, 'show'])->name('apps-log.show');
        Route::delete('/apps-log/{filename}', [AppsLogController::class, 'destroy'])->name('apps-log.destroy');

        /* Migrations Management */
        Route::get('/migrations', [MigrationsController::class, 'index'])->name('migrations.index');
        Route::post('/migrations/run', [MigrationsController::class, 'run'])->name('migrations.run');
        Route::post('/migrations/fresh', [MigrationsController::class, 'fresh'])->name('migrations.fresh');

        /* Seeders Management */
        Route::get('/seeders', [SeedersController::class, 'index'])->name('seeders.index');
        Route::post('/seeders/run', [SeedersController::class, 'run'])->name('seeders.run');

        /* Queues Management */
        Route::get('/queues', [QueuesController::class, 'index'])->name('queues.index');
        Route::post('/queues/retry-all', [QueuesController::class, 'retryAll'])->name('queues.retry-all');
        Route::post('/queues/retry/{id}', [QueuesController::class, 'retry'])->name('queues.retry');
        Route::delete('/queues/forget/{id}', [QueuesController::class, 'forget'])->name('queues.forget');
        Route::delete('/queues/flush', [QueuesController::class, 'flush'])->name('queues.flush');
        Route::delete('/queues/clear', [QueuesController::class, 'clear'])->name('queues.clear');

        /* Schedulers Management */
        Route::get('/schedulers', [SchedulersController::class, 'index'])->name('schedulers.index');
        Route::post('/schedulers', [SchedulersController::class, 'store'])->name('schedulers.store');
        Route::get('/schedulers/{scheduler}', [SchedulersController::class, 'show'])->name('schedulers.show');
        Route::put('/schedulers/{scheduler}', [SchedulersController::class, 'update'])->name('schedulers.update');
        Route::delete('/schedulers/{scheduler}', [SchedulersController::class, 'destroy'])->name('schedulers.destroy');
        Route::post('/schedulers/run', [SchedulersController::class, 'run'])->name('schedulers.run');
    }); 
});

require __DIR__ . '/auth.php';


// Change Locale Language
Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])->name('change-locale');


// Route::middleware('auth')->group(function () {
//     Route::resource('home', HomeController::class);
//     Route::prefix('settings')->name('settings.')->group(function () {
//         Route::resource('users', HomeController::class);
//     });
// });
