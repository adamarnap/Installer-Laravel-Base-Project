<?php

namespace App\Http\Services\Admin\Settings;

use App\Models\User;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Illuminate\Container\Attributes\DB;
use Yajra\DataTables\Facades\DataTables;

class UsersService
{
    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::query()
            ->select('users.*')
            ->with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', RoleEnum::DEVELOPER->value);
            });
        
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
                    return '<span class="badge border-primary text-primary rounded-full border text-center">Aktif</span>';
                }
                return '<span class="badge border-orange-500 text-orange-500 rounded-full border text-center">Tidak Aktif</span>';
            })
            ->orderColumn('name', fn ($query, $order) => $query->orderBy('users.name', $order))
            ->orderColumn('email', fn ($query, $order) => $query->orderBy('users.email', $order))
            ->orderColumn('created_at', fn ($query, $order) => $query->orderBy('users.created_at', $order))
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="hs-dropdown relative inline-flex">
                    <button type="button" class="hs-dropdown-toggle flex h-7.5 w-11.25 items-center justify-center font-semibold" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown" hs-dropdown-placement="bottom-end">
                        <i class="iconify tabler--dots-vertical text-xl"></i>
                    </button>
                    <div class="hs-dropdown-menu" role="menu" aria-orientation="vertical">';
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('settings-users.update')) {
                    $btnEdit = '<a title="Edit data pengguna" href="javascript:void(0)"
                        data-id="' . $row->id . '" data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="dropdown-item btn-modal-edit-user">
                            <i class="iconify tabler--edit text-xs"></i>
                            Edit
                        </a>';
                }

                // Btn Delete
                if (auth()->user()->can('settings-users.delete')) {
                    $btnDelete = '<a title="Hapus data pengguna" href="javascript:void(0)"
                        data-id="' . $row->id . '" data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="dropdown-item text-danger btn-delete-user">
                            <i class="iconify tabler--trash text-xs"></i>
                            Delete
                        </a>';
                }

                $wrapperBottom = '</div></div>';

                return $wrapperStart . $btnEdit . ' ' . $btnDelete . $wrapperBottom;
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    /* Get all roles (except developer) */
    public function getAllRoles()
    {
        return Role::where('name', '!=', RoleEnum::DEVELOPER->value)->get();
    }

    /* Get user by ID */
    public function getUserById(int $id)
    {
        $user = User::findOrFail($id);
        // If you want to include role names, you can add them as an attribute
        $user->role_names = $user->roles->pluck('name')->toArray();
        return $user;
    }

    /* Store new user data */
    public function store(array $data)
    {
        try {
            // DB Transaction
            \DB::beginTransaction();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'is_active' => 1,
            ]);
            
            // Assign roles
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            // Return success response
            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pengguna gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update user data */
    public function update($userId, array $data)
    {
        try {
            // DB Transaction
            \DB::beginTransaction();

            // Get data user
            $user = User::findOrFail($userId);
            // Update user data
            $user->update([
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
                'is_active' => isset($data['is_active']) ? (int) $data['is_active'] : $user->is_active,
            ]);

            // Assign roles
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            // Return success response
            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pengguna gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete user data */
    public function delete($userId)
    {
        try {
            // DB Transaction
            \DB::beginTransaction();

            // Get data user
            $user = User::findOrFail($userId);
            $user->delete();

            // Return success response
            \DB::commit();
            return redirect()->route('settings.users.index')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            \DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Pengguna gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
