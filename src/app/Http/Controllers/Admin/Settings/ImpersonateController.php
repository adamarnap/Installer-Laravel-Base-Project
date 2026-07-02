<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\ImpersonateService;
use App\Models\User;

class ImpersonateController extends Controller
{
    public function __construct(protected ImpersonateService $impersonateService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-impersonate.read');

        // Get data users for data table
        if (request()->ajax()) {
            return $this->impersonateService->getAllUsersForDataTable();
        }
        // Get data roles
        $roles = $this->impersonateService->getAllRoles();

        // Return view
        return view('admin.settings.impersonate.index', compact('roles'));
    }

    /**
     * Start impersonate user.
     */
    public function store($userId)
    {
        $this->setRule('settings-impersonate.create');

        $targetUser = User::findOrFail($userId);
        $originalUserId = (int) auth()->user()->id;

        // Store process
        return $this->impersonateService->startImpersonation(originalUserId: $originalUserId, targetUserId: (int) $userId);
    }

    /**
     * Logout impersonate user and back to admin user.
     */
    public function destroy($userId)
    {
        // Check is impersonating or not
        if(! $this->impersonateService->isImpersonating()) {
            return redirect()->back()->with('error', 'Anda tidak sedang melakukan impersonate.');
        }

        // Leave Impersonate Process
        return $this->impersonateService->stopImpersonation();
    }
}
