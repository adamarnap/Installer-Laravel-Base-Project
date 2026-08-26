# Project Overview & Coding Guidelines (Laravel)

Dokumen ini adalah acuan wajib bagi AI coding agent saat menulis atau mengubah kode di project ini.
Ikuti setiap aturan di bawah secara ketat — jangan berimprovisasi di luar yang diizinkan (lihat Bagian 3).

---

## 1. Struktur Folder & Penempatan File

Semua path di bawah bersifat **wajib**. Ganti placeholder `{...}` sesuai konteks fitur yang sedang dikerjakan.

### 1.1 Controller

| Jenis Laman | Tanpa Laravel Module | Dengan Laravel Module ([nwidart](https://nwidart.com/laravel-modules)) |
|---|---|---|
| Admin | `app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}` | `Modules/{NamaModule}/app/Http/Controllers/Admin/{NamaControllerSesuaiNamaMenu}` |
| Landing | `app/Http/Controllers/Landing/{NamaControllerSesuaiNamaMenu}` | `Modules/{NamaModule}/app/Http/Controllers/Landing/{NamaControllerSesuaiNamaMenu}` |

### 1.2 Service

| Jenis Laman | Tanpa Laravel Module | Dengan Laravel Module |
|---|---|---|
| Admin | `app/Http/Services/Admin/{NamaControllerSesuaiNamaMenu}` | `Modules/{NamaModule}/app/Http/Services/Admin/{NamaServiceSesuaiNamaMenu}` |
| Landing | `app/Http/Services/Landing/{NamaControllerSesuaiNamaMenu}` | `Modules/{NamaModule}/app/Http/Services/Landing/{NamaServiceSesuaiNamaMenu}` |

### 1.3 Model

Semua model diletakkan di satu tempat, tidak dipisah admin/landing atau module:

```
app/Models
```

### 1.4 View (Blade)

| Jenis Laman | Tanpa Laravel Module | Dengan Laravel Module |
|---|---|---|
| Admin | `resources/views/admin/{nama-menu-sesuai-controller}/{nama-file-blade}` | `Modules/{NamaModule}/resources/views/admin/{nama-menu-sesuai-controller}/{nama-file-blade}` |
| Landing | `resources/views/landing/{nama-menu-sesuai-controller}/{nama-file-blade}` | `Modules/{NamaModule}/resources/views/landing/{nama-menu-sesuai-controller}/{nama-file-blade}` |

### 1.5 Form Request (Validation)

| Jenis Laman | Tanpa Laravel Module | Dengan Laravel Module |
|---|---|---|
| Admin | `app/Http/Requests/Admin/{nama-menu-sesuai-controller}/{NamaRequestSesuaiTujuan}.php` | `Modules/{NamaModule}/app/Http/Requests/Admin/{nama-menu-sesuai-controller}/{NamaRequestSesuaiTujuan}.php` |
| Landing | `app/Http/Requests/Landing/{nama-menu-sesuai-controller}/{NamaRequestSesuaiTujuan}.php` | `Modules/{NamaModule}/app/Http/Requests/Landing/{nama-menu-sesuai-controller}/{NamaRequestSesuaiTujuan}.php` |

Contoh penamaan: request untuk action `update` → `UpdateRequest.php`.

---

## 2. Tanggung Jawab Tiap Layer (Controller / Service / Model / View)

Aturan inti: **Controller tidak boleh mengandung logic pengambilan atau pengolahan data.** Alur wajib: `Controller → Service → (Model/Eloquent)`.

### 2.1 Controller

- Hanya bertugas menerima request, memanggil Service, lalu mengirim hasilnya ke View.
- **Dilarang** menulis query, logic pengolahan data, atau logic bisnis apa pun langsung di controller.
- **Wajib** membatasi permission berdasarkan menu & role: setiap method controller harus memanggil di baris pertama:
  ```php
  $this->setRule('slug-navs.action');
  ```
  `action` disesuaikan dengan fungsi method tersebut: `create`, `read`, `update`, atau `delete`.

Contoh referensi: `app/Http/Controllers/Admin/Settings/UsersController.php`

```php
class RolesController extends Controller
{
    public function __construct(protected RolesService $rolesService)
    {
    }

    public function index()
    {
        $this->setRule('settings-roles.read');

        $roles = $this->rolesService->getAllRoles();
        return view('admin.settings.roles.index', compact('roles'));
    }
}
```

### 2.2 Service

- Menerima parameter dari Controller, melakukan query Eloquent, mengolah data, lalu mengembalikan hasil siap-pakai ke Controller.
- Semua logic (query, transformasi data, kondisi bisnis) tinggal di sini.

Contoh referensi: `app/Http/Services/Admin/Settings/UsersService.php`

```php
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
            ->addColumn('created_at', fn ($row) => $row->created_at->format('d M Y H:i'))
            ->addColumn('role', fn ($row) => $row->getRoleNames()->isNotEmpty()
                ? $row->getRoleNames()->implode(', ')
                : '-')
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

                if (auth()->user()->can('settings-users.update')) {
                    $btnEdit = '<button type="button" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '" data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="btn-modal-edit-user text-warning-500 dark:text-warning-400 ">
                            <i class="iconify tabler--{icon_name} text-xs !text-md">edit</i>
                        </button>';
                }

                if (auth()->user()->can('settings-users.delete')) {
                    $btnDelete = '<button type="button" title="Hapus data pengguna" id="btn-delete"
                        data-id="' . $row->id . '" data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="text-danger-500 ">
                            <i class="iconify tabler--{icon_name} text-xs !text-md">delete</i>
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
        $user->role_names = $user->roles->pluck('name')->toArray();
        return $user;
    }
}
```
**Wajib** Gunakan DB Transaction ketika ada action yang melakukan perubahan data ke DB
// Start: DB Transaction
\DB::beginTransaction();

// Commit DB Transaction when Success in all actions
\DB::commit();

// Rollback DB Transaction when Error in actions
\DB::rollBack();

**Wajib** Gunakan try catch dan untuk action yang melakukan redirect, gunakan dengan format berikut (agar SweetAlert di `resources/views/layouts/admin/partials/alert-script.blade.php` otomatis ter-trigger):

```php
// SUKSES
return redirect()->back()->with('success', 'Pesan Sukses');

// ERROR
return redirect()->back()->withInput()->withErrors(['error' => 'Pesan Error. Error: ' . $e->getMessage()]);
```

### 2.3 Model

- Berisi hal-hal standar: relasi Eloquent, accessor, mutator, dan function lain terkait data dari DB.
- **Wajib** setiap model menggunakan trait `app/Traits/TracksUserActions.php`.
- Jika tabel yang direferensikan model tersebut **belum** punya kolom `created_by`, `updated_by`, `deleted_by`, tambahkan kolom-kolom tersebut terlebih dahulu (buat migration baru, jangan edit migration lama).
- UNTUK MODEL ANDA BISA JADIKAN CONTOH REFERENSI CARA CODINGNYA dan FORMAT PENULISAN DAN PEMISAHAN ATAU PENGELOMPOKAN BARIS CODE ANTARA BOOTH, RELATIONSHIP, FUNCTION BIASA, ASESOR, MUTATOR : app/Models/Template-Model.php 

### 2.4 View (Blade)

Master layout sudah tersedia, jangan dibuat ulang:

| Jenis Laman | Master Layout |
|---|---|
| Admin | `resources/views/layouts/admin/master.blade.php` |
| Landing | `resources/views/layouts/landing/master.blade.php` |

Format wajib untuk content blade (contoh untuk laman admin):

```blade
@extends('layouts.admin.master')

@section('title', 'Profile Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('nama_breadcrumbs_route') }}
@endsection

@section('content')
    {{-- Isi content view --}}
@endsection

@push('scripts')
    {{-- Script khusus content ini --}}
@endpush
```

### 2.5 Breadcrumbs

- Menggunakan package `diglactic/laravel-breadcrumbs`.
- Setiap fitur wajib mendaftarkan route breadcrumb di `routes/breadcrumbs.php`, lalu dipanggil di section `@section('breadcrumb')` seperti contoh di atas.

---

## 3. Batasan Styling UI/UX

### Untuk laman Admin anda harus menggunakan referensi template html dibawah ini :
**Dilarang berimprovisasi** terhadap styling. Semua UI wajib mengikuti template HTML yang sudah disediakan (khusus Admin Page — Landing Page belum punya template baku).

| Kebutuhan UI | Template Referensi |
|---|---|
| Badge | `resources/views/templates/admin/template-badges.blade.php` |
| Basic Alert | `resources/views/templates/admin/template-basic-alert.blade.php` |
| Buttons | `resources/views/templates/admin/template-buttons.blade.php` |
| Content Blade | `resources/views/templates/admin/template-content.blade.php` |
| Data Table | `resources/views/templates/admin/template-data-table.blade.php` |
| Form Input | `resources/views/templates/admin/template-form-input.blade.php` |
| Modal Add | `resources/views/templates/admin/template-modal-add.blade.php` |
| Modal Edit | `resources/views/templates/admin/template-modal-edit.blade.php` |
| Select2 | `resources/views/templates/admin/template-select2.blade.php` |
| Tabs | `resources/views/templates/admin/template-tabs.blade.php` |
| Card Image with Button Action | `resources/views/templates/admin/template-card-image.blade.php` |
| Pagination Section (hanya digunakan di list yang bukan data table) | `resources/views/templates/admin/template-pagination.blade.php` |
| Two Content (Main and Aside) | `resources/views/templates/admin/template-two-contents-main-content-and-aside.blade.php` |
| Widgets | `resources/views/templates/admin/template-widgets.blade.php` |

### Untuk laman Landing anda harus menggunakan referensi template html dibawah ini :
File file referensi untuk halaman landing tidak dipisahkan berdasarkan komponen tertentu, saya hanya memisahkan berdasarkan page yang ada di template html, silahkan cari komponen tertentu dengan membaca file file template html ini satu persatu, dan terapkan bagi yang diperlukan.
| Kebutuhan UI | Template Referensi |
|---|---|
|  |  |

Aturan tambahan wajib:

1. **Table** → wajib pakai Data Table (bukan table biasa).
2. **Dropdown/select** → wajib pakai Select2.
3. **Alert** → wajib pakai SweetAlert. Resource-nya sudah di-load global via `resources/views/layouts/admin/master.blade.php` (lewat `partials/styles.blade.php` dan `partials/alert-script.blade.php`) — agent hanya perlu mengimplementasikan pemanggilannya di action yang butuh, tidak perlu load ulang.
4. **Modal Edit** → data untuk form input wajib di-load via AJAX.
5. **Button yang sedang tidak bisa diklik** karena suatu kondisi:
   - **Jangan** disembunyikan (hidden).
   - Ubah warnanya jadi *secondary*/abu-abu.
   - Saat diklik, tampilkan SweetAlert yang menjelaskan alasan action tidak bisa dilakukan.


---

## 4. Aturan Laravel Enum

1. Kolom database bertipe enum **wajib** dibuat menggunakan Laravel Enum, diimplementasikan di file migration.
2. Di layer manapun (Controller, View, Service, Model, dll.) yang membutuhkan data bersifat enum, **wajib** menggunakan Laravel Enum — jangan hardcode string/angka.
3. Semua file Laravel Enum diletakkan di `app/Enums`. Kelompokkan per fitur/menu menggunakan subfolder agar rapi, contoh: `app/Enums/Settings/RoleEnum.php`.
4. Gunakan `app/Enums/TemplateLaravelEnum.php` sebagai referensi pola implementasi.

---

## 5. Ringkasan Alur Kerja (Checklist Singkat untuk Agent)

Saat membuat fitur baru, ikuti urutan ini:

1. Tentukan apakah fitur pakai Laravel Module atau tidak, dan apakah Admin atau Landing.
2. Buat **Migration** baru (jangan edit migration lama) — tambahkan `created_by`, `updated_by`, `deleted_by` bila model memakai `TracksUserActions`.
3. Buat/perbarui **Model** di `app/Models`, pasang trait `TracksUserActions`.
4. Buat **Enum** (jika ada data bersifat tetap/terbatas) di `app/Enums/{...}`.
5. Buat **Service** (logic & query) sesuai path Bagian 1.2.
6. Buat **Form Request** (validasi) sesuai path Bagian 1.5.
7. Buat **Controller** (tipis, hanya panggil Service) sesuai path Bagian 1.1.
8. Buat **View Blade** sesuai path Bagian 1.4, wajib pakai template UI di Bagian 3 dan extend master layout yang sudah ada.
9. Daftarkan **route breadcrumb** di `routes/breadcrumbs.php` dan panggil di view.
10. Semua **komentar kode ditulis dalam bahasa Inggris**.
11. Semua route, file controller, model, nama table db, view ditulis dalam bahasa inggris
12. Jangan gunakan icon, symbol, emote ketika merespon atau saat codingpla