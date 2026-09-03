<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\MigrationsService;
use Illuminate\Http\Request;

class MigrationsController extends Controller
{
    public function __construct(protected MigrationsService $migrationsService)
    {
    }

    /**
     * Display a listing of migrations and comparison status.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->setRule('settings-migrations.read');

        if ($request->ajax()) {
            return $this->migrationsService->getMigrationsForDataTable();
        }

        $stats = $this->migrationsService->getMigrationStats();

        return view('admin.settings.migrations.index', compact('stats'));
    }

    /**
     * Run pending migrations (all or single).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(Request $request)
    {
        $this->setRule('settings-migrations.update');

        $request->validate([
            'password' => 'required|string',
            'migration' => 'nullable|string',
        ]);

        if ($request->filled('migration')) {
            return $this->migrationsService->runSingleMigration(
                $request->input('migration'),
                $request->input('password')
            );
        }

        return $this->migrationsService->runMigrations($request->input('password'));
    }

    /**
     * Run migrate fresh.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fresh(Request $request)
    {
        $this->setRule('settings-migrations.update');

        $request->validate([
            'password' => 'required|string',
            'with_seed' => 'nullable|boolean',
        ]);

        return $this->migrationsService->runMigrateFresh(
            $request->input('password'),
            $request->has('with_seed') ? $request->boolean('with_seed') : true
        );
    }
}
