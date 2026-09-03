@extends('layouts.admin.master')

@section('title', 'Seeders Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('seeders') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- START: Top Card with Rerun DatabaseSeeder & Quick Overview --}}
        <div class="card">
            <div class="card-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h4 class="card-title mb-1.25">Manajemen Database Seeders</h4>
                    <p class="text-default-400">Jalankan dan kelola seeder aplikasi secara selektif maupun keseluruhan (DatabaseSeeder).</p>
                </div>

                @can('settings-seeders.update')
                    <div class="flex items-center gap-2">
                        <button type="button"
                            id="btn-rerun-main-seeder"
                            class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm"
                            data-class="DatabaseSeeder"
                            data-command="php artisan db:seed">
                            <i class="iconify tabler--rotate-clockwise text-base"></i>
                            Jalankan Ulang DatabaseSeeder Utama
                        </button>
                    </div>
                @endcan
            </div>
        </div>
        {{-- END: Top Card --}}

        {{-- START: Manual Seeder Execution Card --}}
        @can('settings-seeders.update')
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title mb-1.25">Eksekusi Seeder Manual</h4>
                        <p class="text-default-400">Jalankan class seeder kustom yang tidak terdaftar di daftar otomatis atau berada di luar direktori seeder default.</p>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-manual-seeder" action="{{ route('settings.seeders.run') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
                            <div>
                                <label for="manual_seeder_class" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Nama Class Seeder <span class="text-danger">*</span></label>
                                <input type="text"
                                    id="manual_seeder_class"
                                    name="seeder_class"
                                    class="form-input text-xs font-mono"
                                    placeholder="Contoh: NavigationSeeder atau Database\Seeders\CustomSeeder"
                                    required>
                                <small class="text-default-400 mt-1 block text-2xs">
                                    Masukkan nama class seeder (misal: <code>UserSeeder</code>) atau namespace lengkap jika berada di luar folder default.
                                </small>
                            </div>

                            <div>
                                <label for="manual_seeder_password" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Konfirmasi Password Akun <span class="text-danger">*</span></label>
                                <input type="password"
                                    id="manual_seeder_password"
                                    name="password"
                                    class="form-input text-xs"
                                    placeholder="Masukkan password akun Anda"
                                    autocomplete="current-password"
                                    required>
                                <small class="text-default-400 mt-1 block text-2xs">
                                    Verifikasi keamanan untuk memastikan hanya pengguna terotorisasi yang dapat mengubah data sistem.
                                </small>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                id="btn-submit-manual-seeder"
                                class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-4 rounded inline-flex items-center gap-1.5 shadow-sm">
                                <i class="iconify tabler--player-play text-sm"></i>
                                Jalankan Seeder Manual
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
        {{-- END: Manual Seeder Execution Card --}}

        {{-- START: Seeders List DataTable Card --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Class Seeder Tersedia</h4>
                    <p class="text-default-400">Daftar seluruh berkas seeder pada direktori <code>database/seeders</code> yang dapat dijalankan secara individual.</p>
                </div>
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4">
                    <table id="seeders-table" class="table table-striped" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center" style="width: 5%">No.</th>
                                <th class="ltr:!text-left rtl:!text-right" style="width: 35%">Class Seeder</th>
                                <th class="ltr:!text-left rtl:!text-right" style="width: 35%">Deskripsi</th>
                                <th class="text-center" style="width: 15%">Terakhir Diubah</th>
                                <th class="text-center" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="5">
                                    <div class="flex items-center justify-center py-6">
                                        <span class="text-gray-500">Memuat daftar seeder...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- END: Seeders List DataTable Card --}}
    </div>

    {{-- Hidden Form for Action Seeder Per Row / Main --}}
    <form id="form-run-single-seeder" action="{{ route('settings.seeders.run') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="seeder_class" id="input-single-seeder-class" value="">
        <input type="hidden" name="password" id="input-single-seeder-password" value="">
    </form>
@endsection

@push('scripts')
    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#seeders-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                language: {
                    paginate: {
                        first: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7l-5 5l5 5" /><path d="M17 7l-5 5l5 5" /></svg>',
                        previous: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>',
                        next: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>',
                        last: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7l5 5l-5 5" /><path d="M13 7l5 5l-5 5" /></svg>',
                    },
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ seeder",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 seeder",
                    infoFiltered: "(disaring dari total _MAX_ seeder)",
                    zeroRecords: "Tidak ada data seeder ditemukan",
                    processing: "Memuat seeder..."
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.seeders.index') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'class_name',
                        name: 'class',
                        className: 'ltr:!text-left rtl:!text-right'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        className: 'text-sm text-default-600'
                    },
                    {
                        data: 'modified_at',
                        name: 'modified_at',
                        className: 'text-center text-xs font-mono'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                drawCallback: function() {
                    if (window.HSStaticMethods) {
                        window.HSStaticMethods.autoInit();
                    }
                }
            });

            // 1. Run Single Seeder per row
            $(document).on('click', '.btn-run-seeder', function(e) {
                e.preventDefault();
                const seederClass = $(this).data('class');

                Swal.fire({
                    title: 'Jalankan Seeder Ini?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Anda akan mengeksekusi seeder: <strong class="text-gray-800 font-mono">${seederClass}</strong>.</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <span class="text-gray-500 font-semibold block text-[10px] uppercase mb-1">Perintah yang dijalankan:</span>
                                <code>php artisan db:seed --class=${seederClass}</code>
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Masukkan Password Akun Anda:</label>
                                <input type="password" id="swal-password-seeder" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Password akun saat ini" autocomplete="current-password">
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--player-play mr-1"></i> Jalankan Seeder',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const pwd = document.getElementById('swal-password-seeder').value;
                        if (!pwd) {
                            Swal.showValidationMessage('Password konfirmasi wajib diisi!');
                        }
                        return pwd;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-single-seeder-class').val(seederClass);
                        $('#input-single-seeder-password').val(result.value);
                        $('#form-run-single-seeder').submit();
                    }
                });
            });

            // 2. Rerun Main DatabaseSeeder
            $('#btn-rerun-main-seeder').on('click', function(e) {
                e.preventDefault();
                const seederClass = $(this).data('class') || 'DatabaseSeeder';

                Swal.fire({
                    title: 'Jalankan Ulang DatabaseSeeder Utama?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Perintah ini akan menjalankan seluruh rangkaian seeder utama aplikasi (<strong class="font-mono">DatabaseSeeder</strong>).</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <span class="text-gray-500 font-semibold block text-[10px] uppercase mb-1">Perintah Artisan:</span>
                                <code>php artisan db:seed</code>
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Masukkan Password Akun Anda:</label>
                                <input type="password" id="swal-password-main-seeder" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Password akun saat ini" autocomplete="current-password">
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--rotate-clockwise mr-1"></i> Ya, Jalankan!',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const pwd = document.getElementById('swal-password-main-seeder').value;
                        if (!pwd) {
                            Swal.showValidationMessage('Password konfirmasi wajib diisi!');
                        }
                        return pwd;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-single-seeder-class').val(seederClass);
                        $('#input-single-seeder-password').val(result.value);
                        $('#form-run-single-seeder').submit();
                    }
                });
            });

            // 3. Form Manual Seeder Confirmation
            $('#form-manual-seeder').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const seederClass = $('#manual_seeder_class').val().trim();
                const password = $('#manual_seeder_password').val();

                if (!seederClass) {
                    Swal.fire('Peringatan', 'Nama class seeder wajib diisi!', 'warning');
                    return;
                }

                if (!password) {
                    Swal.fire('Peringatan', 'Password akun wajib diisi!', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Eksekusi Seeder Manual?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Apakah Anda yakin ingin menjalankan class seeder: <strong class="font-mono text-gray-800">${seederClass}</strong>?</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>php artisan db:seed --class=${seederClass}</code>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--player-play mr-1"></i> Ya, Eksekusi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
