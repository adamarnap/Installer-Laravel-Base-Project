# STRUKTUR FOLDER, FILE, DAN CODE
1. Controller : 
Untuk kontroller laman admin (biasa, tanpa module) letaknya di path "app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}", namun apabila menggunakan laravel module dari nwidart (https://nwidart.com/laravel-modules) file cotroller letaknya di "Modules/{NamaModule}/app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}". Lalu untuk kontroller laman landing (biasa, tanpa module) letaknya di path "app/Http/Controllers/Landing/{NamaControllerSesuaiNamaMenu}", namun apabila menggunakan laravel module dari nwidart (https://nwidart.com/laravel-modules) file controller letaknya di "Modules/{NamaModule}/app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}".

2. Service
- Tanpa menggunakan laravel module
	a. Untuk Laman Admin :
		> Path	: app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}
	b. Untuk Laman Landing :
		> Path	: app/Http/Controllers/Landing/{NamaControllerSesuaiNamaMenu}
- Jika menggunakan laravel module (https://nwidart.com/laravel-modules):
	a. Untuk Laman Admin :
		> Path	: Modules/{NamaModule}/app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}
	b. Untuk Laman Landing :
		> Path	: Modules/{NamaModule}/app/Http/Controllers/Landing/{NamaControllerSesuaiNamaMenu}

3. Model
Semua model diletakan di path : app/Models

4. view blade :
- Tanpa menggunakan laravel module
	a. Untuk Laman Admin :
		> Path	: resources/views/admin/nama-menu-sesuai-controller/{nama-file-blade}
	b. Untuk Laman Landing :
		> Path	: resources/views/landing/nama-menu-sesuai-controller/{nama-file-blade}
- Jika menggunakan laravel module (https://nwidart.com/laravel-modules):
	a. Untuk Laman Admin :
		> Path	: Modules/{NamaModule}/resources/views/admin/nama-menu-sesuai-controller/{nama-file-blade}
	b. Untuk Laman Landing :
		> Path	: Modules/{NamaModule}/resources/views/landing/nama-menu-sesuai-controller/{nama-file-blade}

5. Untuk file validation request :
- Tanpa menggunakan laravel module
	a. Untuk Laman Admin :
		> Path	: app/Http/Requests/Admin/{nama-menu-sesuai-controller}/{NamaFileRequestSesuaiAkanDigunakanDicontrollerUntukApa} (contoh: untuk update, namanya ya UpdateRequest.php)
	b. Untuk Laman Landing :
		> Path	: app/Http/Requests/Landing/{nama-menu-sesuai-controller}/{NamaFileRequestSesuaiAkanDigunakanDicontrollerUntukApa} (contoh: untuk update, namanya ya UpdateRequest.php)
- Jika menggunakan laravel module (https://nwidart.com/laravel-modules):
	a. Untuk Laman Admin :
		> Path	: Modules/{NamaModule}/app/Http/Requests/Admin/{nama-menu-sesuai-controller}/{NamaFileRequestSesuaiAkanDigunakanDicontrollerUntukApa} (contoh: untuk update, namanya ya UpdateRequest.php)
	b. Untuk Laman Landing :
		> Path	: Modules/{NamaModule}/app/Http/Requests/Landing/{nama-menu-sesuai-controller}/{NamaFileRequestSesuaiAkanDigunakanDicontrollerUntukApa} (contoh: untuk update, namanya ya UpdateRequest.php)

# KEGUNAAN FILE CONTROLLER, SERVICE, MODEL, BLADE
1. Controller :
File controller hanya untuk menghandel mengkontrol data. Tidak untuk logic pengegetan data, pengolahan data, atau logic terkait data. Controller hanya bertugas untuk memanggil service, lalu service yang mengambil, mengquery, dan mengolah data, lalu data dari service yang sudah siap untuk di gunakan akan dikembalikan ke controller. Sebagai contoh disini saya memiliki controller yang tugasnya yakni hanya sebagai berikut :
class RolesController extends Controller
{
    public function __construct(protected RolesService $rolesService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-roles.read');

        $roles = $this->rolesService->getAllRoles();
        return view('admin.settings.roles.index', compact('roles'));
    }
    
Untuk detailnya anda bisa melihat contoh file controller yakni di file app/Http/Controllers/Admin/Settings/UsersController.php

2. Service :
File service hanya untuk menghandle get data, pengolahan data, dan logika logika apapun ada di file ini. File ini bertugas hanya menerima lemparan parameter dari controller, melakukan query eloquent, mengolah data, dan mengembalikannya ke controller. Sebagai contoh disini saya memiliki service yang tugasnya yakni sebagai berikut :

class UsersService
{
    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', RoleEnum::DEVELOPER->value);
            })
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
                $wrapperStart = '<div class="flex items-center gap-[9px] justify-center">';
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('settings-users.update')) {
                    $btnEdit = '<button type="button" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="btn-modal-edit-user text-warning-500 dark:text-warning-400 ">
                            <i class="iconify tabler--{icon_name} text-xs !text-md">
                                edit
                            </i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('settings-users.delete')) {
                    $btnDelete = '<button type="button" title="Hapus data pengguna" id="btn-delete"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="text-danger-500 ">
                            <i class="iconify tabler--{icon_name} text-xs !text-md">
                                delete
                            </i>
                        </button>';
                }

                $wrapperBottom = '</div>';

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

atau lebih detailnya anda bisa melihat file app/Http/Services/Admin/Settings/UsersService.php

3. Model : 
File model seperti biasanya, dan pada umumnya yakni untuk mengurus data dari db, membuat relasi eloquent, membuat acessor, membuat mutator, dan membuat function apapun itu yang berhubungan dengan data dari db. 

4. View :
File view disini menggunakan blade, untuk laman :
- Admin : 
	> Master Layout : resources/views/layouts/admin/master.blade.php
- Landing Page :
	> Master Layout : resources/views/layouts/landing/master.blade.php

File master layout sudah ada, untuk file content.blade.php dimuat dalam format seperti berikut (Sebagai Contoh) :
@extends('layouts.admin.master')

@section('title', 'Profile Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
<!-- Isi content view -->
@endsection

@push('scripts')
<!-- Isi dari script yang ada di content tersebut -->
@endpush

5. Breadcrumbs
Untuk breadcrumbs disini saya menggunakan diglactic/laravel-breadcrumbs, di setiap fitur, didalam content viewnya memiliki 
@section('breadcrumb')
    {{ Breadcrumbs::render('{nama_breadcrumbs_route}') }}
@endsection

nama_breadcrumbs_route diambil dari routes/breadcrumbs.php