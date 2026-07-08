<?php

namespace App\Http\Services\Admin\Settings;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class ImpersonateService
{
    const SESSION_KEY        = 'impersonate_original_user_id';
    const SESSION_GUARD_KEY  = 'impersonate_original_guard';

    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', RoleEnum::DEVELOPER->value);
            })
            ->where('is_active', 1)
            ->orderBy('name');
        
        return Datatables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y H:i');
            })
            ->addColumn('role', function ($row) {
                return $row->getRoleNames()->isNotEmpty() ? $row->getRoleNames()->implode(', ') : '-';
            })
            ->addColumn('status', function ($row) {
                if ($row->is_active == 1) {
                    return '<span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">Aktif</span>';
                }
                return '<span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">Tidak Aktif</span>';
            })
            ->addColumn('aksi', function ($row) {
                $html = '<div class="flex items-center gap-[9px] justify-center">';
                
                // Btn Impersonate
                if (auth()->user()->can('settings-impersonate.create')) {
                    $html .= '<form action="' . route('settings.impersonate.store', $row->id) . '" method="POST" class="inline">
                        ' . csrf_field() . '
                        <button type="submit" 
                                title="Impersonate pengguna" 
                                class="btn border-danger text-danger hover:bg-danger hover:text-white">
                            <i class="iconify tabler--lock text-xs"></i>
                            <span>Impersonate</span>
                        </button>
                    </form>';
                }
                
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    /* Get all roles (except developer) */
    public function getAllRoles()
    {
        return Role::where('name', '!=', RoleEnum::DEVELOPER->value)->get();
    }

    /* POST: Start Impersonation */
    public function startImpersonation($originalUserId = null, $targetUserId = null, $guard = 'web')
    {
        // Get data target user
        $targetUser = User::findOrFail($targetUserId);

        // Get data original user
        $originalUser = User::findOrFail($originalUserId);

        // Check target user is original user
        if ($targetUserId == $originalUserId) {
            return redirect()->back()->with('error', 'Tidak dapat melakukan impersonate pada pengguna yang sama.');
        }

        // Check if the user is active
        if ($targetUser->is_active != 1) {
            return redirect()->back()->with('error', 'Pengguna tidak aktif. Tidak dapat melakukan impersonate.');
        }

        // Check if the user has the developer role
        if ($targetUser->hasRole(RoleEnum::DEVELOPER->value)) {
            return redirect()->back()->with('error', 'Tidak dapat melakukan impersonate pada pengguna dengan peran Developer.');
        }

        // Save original user id and guard in session
        Session::put(self::SESSION_KEY, $originalUser->id);
        Session::put(self::SESSION_GUARD_KEY, $guard);

        // Log in as the target user.
        Auth::guard($guard)->login($targetUser);

        return redirect()->route('dashboard')->with('success', 'Anda sekarang sedang melakukan impersonate sebagai ' . $targetUser->name . '.');
    }

    /* POST: Stop Impersonation */
    public function stopImpersonation($guard = 'web')
    {
        // Check if the user is impersonating
        if (!Session::has(self::SESSION_KEY)) {
            return redirect()->back()->with('error', 'Anda tidak sedang melakukan impersonate.');
        }

        // Get original user id is impersonating
        $originalUserId = Session::pull(self::SESSION_KEY);

        // GET Original user and log in as the original user
        $originalUser = User::find($originalUserId);

        if (!$originalUser) {
            Auth::guard($guard)->logout();
            return redirect()->route('login')->with('error', 'Pengguna asli tidak ditemukan. Silakan login kembali.');
        }
        
        // Session forget the guard key and target user
        Session::forget(self::SESSION_KEY);
        Session::forget(self::SESSION_GUARD_KEY);

        // Login as original user
        Auth::guard($guard)->login($originalUser);

        return redirect()->route('settings.impersonate.index')->with('success', 'Anda telah keluar dari mode impersonate dan kembali sebagai ' . $originalUser->name . '.');
    }

    /* GET: Check if user is impersonating */
    public function isImpersonating()
    {
        return Session::has(self::SESSION_KEY);
    }

    /* GET: Original User Id */
    public function getImpersonatorUserId()
    {
        return Session::get(self::SESSION_KEY);
    }

    /* GET: Original User Data */
    public function getImpersonatorUserData()
    {
        $userId = $this->getImpersonatorUserId();
        return $userId ? User::find($userId) : null;
    }

    /* GET: Impersonated User Data */
    public function getImpersonatedUserData()
    {
        return auth()->user();
    }

}