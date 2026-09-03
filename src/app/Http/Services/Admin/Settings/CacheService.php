<?php

namespace App\Http\Services\Admin\Settings;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CacheService
{
    /**
     * Get the current status of various application caches.
     *
     * @return array
     */
    public function getCacheStatus(): array
    {
        $viewsPath = storage_path('framework/views');
        $viewFilesCount = File::isDirectory($viewsPath) ? count(File::files($viewsPath)) : 0;

        return [
            'config_cached' => app()->configurationIsCached(),
            'routes_cached' => app()->routesAreCached(),
            'events_cached' => app()->eventsAreCached(),
            'view_files_count' => $viewFilesCount,
            'cache_driver' => config('cache.default'),
            'app_env' => config('app.env'),
            'app_debug' => config('app.debug'),
        ];
    }

    /**
     * Execute a specific cache operation.
     *
     * @param string $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function executeAction(string $action)
    {
        $actions = [
            'config_cache' => [
                'command' => 'config:cache',
                'label' => 'Cache Konfigurasi berhasil dibuat.',
            ],
            'config_clear' => [
                'command' => 'config:clear',
                'label' => 'Cache Konfigurasi berhasil dibersihkan.',
            ],
            'route_cache' => [
                'command' => 'route:cache',
                'label' => 'Cache Rute berhasil dibuat.',
            ],
            'route_clear' => [
                'command' => 'route:clear',
                'label' => 'Cache Rute berhasil dibersihkan.',
            ],
            'view_cache' => [
                'command' => 'view:cache',
                'label' => 'Cache Tampilan (Blade View) berhasil dikompilasi.',
            ],
            'view_clear' => [
                'command' => 'view:clear',
                'label' => 'Cache Tampilan (Blade View) berhasil dibersihkan.',
            ],
            'event_cache' => [
                'command' => 'event:cache',
                'label' => 'Cache Event & Listener berhasil dibuat.',
            ],
            'event_clear' => [
                'command' => 'event:clear',
                'label' => 'Cache Event & Listener berhasil dibersihkan.',
            ],
            'cache_clear' => [
                'command' => 'cache:clear',
                'label' => 'Application Data Cache berhasil dibersihkan.',
            ],
            'optimize' => [
                'command' => 'optimize',
                'label' => 'Optimasi framework berhasil dijalankan.',
            ],
            'optimize_clear' => [
                'command' => 'optimize:clear',
                'label' => 'Seluruh cache optimasi berhasil dibersihkan.',
            ],
        ];

        if (!array_key_exists($action, $actions)) {
            return redirect()->back()->withErrors(['error' => 'Aksi cache tidak valid.']);
        }

        try {
            Artisan::call($actions[$action]['command']);
            $output = trim(Artisan::output());

            $successMessage = $actions[$action]['label'];
            if (!empty($output)) {
                $successMessage .= ' (' . $output . ')';
            }

            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Gagal menjalankan aksi cache. Error: ' . $e->getMessage()
            ]);
        }
    }
}
