@extends('layouts.admin.master')

@section('title', 'Migrations Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('migrations') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- START: Migration Stats & Global Actions --}}
        <div class="card">
            <div class="card-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h4 class="card-title mb-1.25">Status & Manajemen Migrasi Database</h4>
                    <p class="text-default-400">Pantau perbandingan berkas migration di filesystem dengan riwayat eksekusi pada tabel migrations database.</p>
                </div>

                @can('settings-migrations.update')
                    <div class="flex flex-wrap items-center gap-2.5">
                        {{-- Button Run All Pending Migrations --}}
                        <button type="button"
                            id="btn-run-all-migrations"
                            class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm">
                            <i class="iconify tabler--player-play text-base"></i>
                            Jalankan Semua Migrasi Pending
                        </button>

                        {{-- Button Migrate Fresh (Destructive Action) --}}
                        <button type="button"
                            id="btn-migrate-fresh"
                            class="btn bg-danger hover:bg-danger-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm">
                            <i class="iconify tabler--alert-octagon text-base"></i>
                            Migrate Fresh (--seed)
                        </button>
                    </div>
                @endcan
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-2">
                    {{-- Total Migrations --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Total Migrasi Terdaftar</span>
                            <div class="text-xl font-bold text-default-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <i class="iconify tabler--files text-xl"></i>
                        </div>
                    </div>

                    {{-- Ran Migrations --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Sudah Dijalankan</span>
                            <div class="text-xl font-bold text-success">{{ $stats['ran'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-success/10 text-success flex items-center justify-center">
                            <i class="iconify tabler--circle-check text-xl"></i>
                        </div>
                    </div>

                    {{-- Pending Migrations --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Pending (Belum Berjalan)</span>
                            <div class="text-xl font-bold {{ $stats['pending'] > 0 ? 'text-danger' : 'text-default-800' }}">
                                {{ $stats['pending'] }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full {{ $stats['pending'] > 0 ? 'bg-danger/10 text-danger' : 'bg-default-200 text-default-600' }} flex items-center justify-center">
                            <i class="iconify tabler--alert-triangle text-xl"></i>
                        </div>
                    </div>

                    {{-- Status Sync --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Status Sinkronisasi</span>
                            <div>
                                @if ($stats['status'] === 'SYNCHRONIZED')
                                    <span class="badge bg-success/15 text-success font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--circle-check text-sm"></i> Sinkron Penuh
                                    </span>
                                @else
                                    <span class="badge bg-danger/15 text-danger font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--alert-circle text-sm"></i> Ada Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-dark/10 text-dark flex items-center justify-center">
                            <i class="iconify tabler--database-cog text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Command Informational Callout --}}
                <div class="mt-4 p-3 rounded-lg bg-default-100/80 border border-default-200 flex flex-col md:flex-row md:items-center justify-between gap-3 text-xs text-default-600">
                    <div class="flex items-center gap-2">
                        <i class="iconify tabler--info-circle text-primary text-base"></i>
                        <span>Aksi <strong>Migrate Fresh</strong> akan mengeksekusi perintah Artisan: <code class="font-mono bg-default-200 text-danger px-1.5 py-0.5 rounded font-bold">php artisan migrate:fresh --seed</code></span>
                    </div>
                    <div class="text-default-500 font-mono text-2xs">
                        *Memerlukan verifikasi password akun pengguna untuk keamanan.
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Migration Stats --}}

        {{-- START: Migration DataTable Card --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Berkas Migrasi</h4>
                    <p class="text-default-400">Daftar seluruh file migrasi pada direktori database/migrations beserta batch dan status eksekusinya.</p>
                </div>
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4">
                    <table id="migrations-table" class="table table-striped" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center" style="width: 5%">No.</th>
                                <th class="ltr:!text-left rtl:!text-right" style="width: 50%">Nama Migrasi</th>
                                <th class="text-center" style="width: 12%">Batch</th>
                                <th class="text-center" style="width: 18%">Status</th>
                                <th class="text-center" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="5">
                                    <div class="flex items-center justify-center py-6">
                                        <span class="text-gray-500">Memuat data migrasi...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- END: Migration DataTable Card --}}
    </div>

    {{-- Hidden Form for Running Migrations --}}
    <form id="form-run-migrations" action="{{ route('settings.migrations.run') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="password" id="input-run-password" value="">
        <input type="hidden" name="migration" id="input-run-migration" value="">
    </form>

    {{-- Hidden Form for Migrate Fresh --}}
    <form id="form-migrate-fresh" action="{{ route('settings.migrations.fresh') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="password" id="input-fresh-password" value="">
        <input type="hidden" name="with_seed" value="1">
    </form>
@endsection

@push('scripts')
    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#migrations-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ migrasi",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 migrasi",
                    infoFiltered: "(disaring dari total _MAX_ migrasi)",
                    zeroRecords: "Tidak ada data migrasi ditemukan",
                    processing: "Memuat daftar migrasi..."
                },
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ route('settings.migrations.index') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'migration_name',
                        name: 'migration_name'
                    },
                    {
                        data: 'batch_badge',
                        name: 'batch_badge',
                        className: 'text-center'
                    },
                    {
                        data: 'status_badge',
                        name: 'status_badge',
                        className: 'text-center'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-center'
                    }
                ],
                drawCallback: function() {
                    if (window.HSStaticMethods) {
                        window.HSStaticMethods.autoInit();
                    }
                }
            });

            // 1. Run Single Migration
            $(document).on('click', '.btn-run-single-migration', function(e) {
                e.preventDefault();
                const migrationName = $(this).data('migration');
                const command = $(this).data('command');

                Swal.fire({
                    title: 'Jalankan Migrasi Ini?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Anda akan mengeksekusi berkas migrasi: <strong class="text-gray-800 font-mono">${migrationName}</strong></p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>${command}</code>
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Masukkan Password Akun Anda:</label>
                                <input type="password" id="swal-password-single" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Password akun saat ini" autocomplete="current-password">
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--player-play mr-1"></i> Jalankan Migrasi',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const pwd = document.getElementById('swal-password-single').value;
                        if (!pwd) {
                            Swal.showValidationMessage('Password wajib dimasukkan!');
                        }
                        return pwd;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-run-password').val(result.value);
                        $('#input-run-migration').val(migrationName);
                        $('#form-run-migrations').submit();
                    }
                });
            });

            // 2. Run All Pending Migrations
            $('#btn-run-all-migrations').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Jalankan Semua Migrasi Pending?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Perintah ini akan mengeksekusi seluruh berkas migrasi baru yang belum tercatat pada database.</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>php artisan migrate</code>
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Masukkan Password Akun Anda:</label>
                                <input type="password" id="swal-password-all" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Password akun saat ini" autocomplete="current-password">
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--player-play mr-1"></i> Jalankan Semua',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const pwd = document.getElementById('swal-password-all').value;
                        if (!pwd) {
                            Swal.showValidationMessage('Password wajib dimasukkan!');
                        }
                        return pwd;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-run-password').val(result.value);
                        $('#input-run-migration').val('');
                        $('#form-run-migrations').submit();
                    }
                });
            });

            // 3. Migrate Fresh (Destructive Action with High Security Confirmation)
            $('#btn-migrate-fresh').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '<span class="text-danger">PERINGATAN: TINDAKAN DESTRUKTIF!</span>',
                    html: `
                        <div class="text-left space-y-3">
                            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded text-xs leading-relaxed">
                                <strong>PERHATIAN SANGAT PENTING:</strong><br>
                                Tindakan ini akan <strong>MENGHAPUS / ME-RESET SELURUH TABEL & DATA DATABASE</strong>, lalu menjalankan ulang seluruh migrasi dari awal dan mengeksekusi seeder default (<code class="font-bold">--seed</code>). Seluruh data transaksi yang ada akan hilang secara permanen!
                            </div>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <span class="text-gray-500 font-semibold block text-[10px] uppercase mb-1">Perintah yang akan dieksekusi:</span>
                                <code>php artisan migrate:fresh --seed</code>
                            </div>
                            <div class="mt-3">
                                <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Konfirmasi Password Akun Anda:</label>
                                <input type="password" id="swal-password-fresh" class="w-full px-3 py-2 border border-red-300 rounded text-sm focus:ring-2 focus:ring-red-500 focus:outline-none" placeholder="Masukkan password Anda untuk konfirmasi" autocomplete="current-password">
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--alert-octagon mr-1"></i> Ya, Reset Database & Seed!',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const pwd = document.getElementById('swal-password-fresh').value;
                        if (!pwd) {
                            Swal.showValidationMessage('Password konfirmasi WAJIB diisi!');
                        }
                        return pwd;
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-fresh-password').val(result.value);
                        $('#form-migrate-fresh').submit();
                    }
                });
            });
        });
    </script>
@endpush
