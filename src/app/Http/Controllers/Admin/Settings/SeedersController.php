<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\SeedersService;
use Illuminate\Http\Request;

class SeedersController extends Controller
{
    public function __construct(protected SeedersService $seedersService)
    {
    }

    /**
     * Display a listing of available seeders.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->setRule('settings-seeders.read');

        if ($request->ajax()) {
            return $this->seedersService->getSeedersForDataTable();
        }

        $seeders = $this->seedersService->getAvailableSeeders();

        return view('admin.settings.seeders.index', compact('seeders'));
    }

    /**
     * Run a specific seeder.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(Request $request)
    {
        $this->setRule('settings-seeders.update');

        $request->validate([
            'seeder_class' => 'required|string',
            'password' => 'required|string',
        ]);

        return $this->seedersService->runSeeder(
            $request->input('seeder_class'),
            $request->input('password')
        );
    }
}
