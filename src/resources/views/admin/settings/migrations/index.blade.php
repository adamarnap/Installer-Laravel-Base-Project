@extends('layouts.admin.master')

@section('title', 'Migrations Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('migrations') }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Migration Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary flex items-center justify-center text-2xl">
                <i class="ti ti-files"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total File Migrasi</p>
                <h4 class="text-xl font-bold text-gray-800">{{ $stats['total'] }} File</h4>
                <span class="text-xs text-gray-400">database/migrations/</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-success/10 text-success flex items-center justify-center text-2xl">
                <i class="ti ti-check"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Sudah Dijalankan (Ran)</p>
                <h4 class="text-xl font-bold text-gray-800">{{ $stats['ran'] }} File</h4>
                <span class="text-xs text-success font-medium">Tersinkronisasi dengan DB</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full {{ $stats['pending'] > 0 ? 'bg-danger/10 text-danger animate-pulse' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center text-2xl">
                <i class="ti ti-alert-triangle"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Belum Dijalankan (Pending)</p>
                <h4 class="text-xl font-bold {{ $stats['pending'] > 0 ? 'text-danger' : 'text-gray-800' }}">{{ $stats['pending'] }} File</h4>
                <span class="text-xs {{ $stats['pending'] > 0 ? 'text-danger font-semibold' : 'text-gray-400' }}">
                    {{ $stats['pending'] > 0 ? 'Perlu Dijalankan Segera' : 'Database Up to Date' }}
                </span>
            </div>
        </div>
    </div>
    <!-- END: Migration Summary Cards -->

    <!-- START: Operations & Actions Bar -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header border-b border-borderColor p-4 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h5 class="card-title text-base font-bold text-gray-800">Operasi Database Migration</h5>
                <p class="text-xs text-gray-500 mt-0.5">Jalankan migrasi yang tertunda atau reset skema database dengan konfirmasi otorisasi.</p>
            </div>
            <div class="flex items-center gap-2">
                @if($stats['pending'] > 0)
                    <button type="button" id="btn-run-all-migrations" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white inline-flex items-center gap-1.5 py-2 px-4 rounded text-sm">
                        <i class="ti ti-player-play text-base"></i> Jalankan Pending Migrations ({{ $stats['pending'] }})
                    </button>
                @else
                    <button type="button" class="btn bg-gray-100 border border-borderColor text-gray-400 cursor-not-allowed inline-flex items-center gap-1.5 py-2 px-4 rounded text-sm" disabled>
                        <i class="ti ti-circle-check text-base text-success"></i> Seluruh Migrasi Telah Dijalankan
                    </button>
                @endif

                <button type="button" class="btn bg-danger border border-danger text-white text-center hover:bg-danger/80 hover:text-white inline-flex items-center gap-1.5 py-2 px-4 rounded text-sm"
                    data-modal-toggle="modalMigrateFresh" data-modal-target="modalMigrateFresh">
                    <i class="ti ti-refresh-alert text-base"></i> Migrate Fresh
                </button>
            </div>
        </div>
    </div>
    <!-- END: Operations & Actions Bar -->

    <!-- START: Comparison Data Table Card -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="card-header py-4 px-5 border-b border-borderColor">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="migration-table-search" placeholder="Cari nama migration..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary"/>
                </div>
                <div class="text-xs text-gray-500">
                    <i class="ti ti-database mr-1"></i> Tabel: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-700">migrations</code>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-migrations">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama File Migration</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Batch</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Status</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Terakhir Diubah</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer p-4 border-t border-borderColor">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div class="w-full md:w-1/2">
                    <div class="datatable-length"></div>
                </div>
                <div class="w-full md:w-1/2 text-center">
                    <div class="datatable-info text-sm text-gray-500"></div>
                </div>
                <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end">
                    <div class="datatable-paginate"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Comparison Data Table Card -->
</div>

@include('admin.settings.migrations.partials.modal-run')
@include('admin.settings.migrations.partials.modal-fresh')
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            const dataTable = $('#data-table-migrations').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ file migrasi',
                    infoEmpty: 'Tidak ada migrasi yang ditemukan',
                    infoFiltered: '(difilter dari _MAX_ total file)',
                    lengthMenu: 'Tampilkan _MENU_ file',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.migrations.index') }}",
                    type: 'GET',
                },
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100, 200],
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'migration_name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-left'
                    },
                    {
                        data: 'batch_badge',
                        name: 'batch',
                        searchable: false,
                        orderable: true,
                        className: 'px-5 py-2.5 text-left'
                    },
                    {
                        data: 'status_badge',
                        name: 'status',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-left'
                    },
                    {
                        data: 'modified_at',
                        name: 'modified_at',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-xs text-left'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-left'
                    },
                ],
                initComplete: function () {
                    if ($('.datatable-length').length) {
                        $('.dt-length').appendTo('.datatable-length');
                    }
                    if ($('.datatable-info').length) {
                        $('.dt-info').appendTo('.datatable-info');
                    }
                    if ($('.datatable-paginate').length) {
                        $('.dt-paging').appendTo('.datatable-paginate');
                    }
                },
            });

            $('#migration-table-search').on('input', function () {
                dataTable.search(this.value).draw();
            });

            // 1. Run Single Migration: open modal-run with pre-filled migration
            $(document).on('click', '.btn-run-single-migration', function (e) {
                e.preventDefault();
                const migrationName = $(this).data('migration');
                const file = $(this).data('file');
                const command = $(this).data('command');

                $('#modalRunMigrationLabel').text('Jalankan Migrasi: ' + file);
                $('#modal-migration-desc').text('Sistem akan mengeksekusi file migrasi ' + file + ' ke dalam database.');
                $('#modal-migration-command').text(command);
                $('#modal-input-migration-name').val(migrationName);

                $('#modalRunMigrationToggle').click();
            });

            // 2. Run All Pending Migrations: open modal-run
            $('#btn-run-all-migrations').on('click', function (e) {
                e.preventDefault();
                $('#modalRunMigrationLabel').text('Jalankan Seluruh Migrasi Pending');
                $('#modal-migration-desc').text('Sistem akan mengeksekusi seluruh file migrasi yang berstatus pending di database.');
                $('#modal-migration-command').text('php artisan migrate');
                $('#modal-input-migration-name').val('');

                $('#modalRunMigrationToggle').click();
            });
        });
    </script>
@endpush
