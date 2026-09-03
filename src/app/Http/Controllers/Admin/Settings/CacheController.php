<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\CacheService;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function __construct(protected CacheService $cacheService)
    {
    }

    /**
     * Display a listing of the cache status and management options.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setRule('settings-cache.read');

        $cacheStatus = $this->cacheService->getCacheStatus();

        return view('admin.settings.cache.index', compact('cacheStatus'));
    }

    /**
     * Execute a specific cache operation.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute(Request $request)
    {
        $this->setRule('settings-cache.update');

        $request->validate([
            'action' => 'required|string',
        ]);

        return $this->cacheService->executeAction($request->input('action'));
    }
}
