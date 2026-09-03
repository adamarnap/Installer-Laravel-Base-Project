@extends('layouts.admin.master')

@section('title', 'Migrations Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('migrations') }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    {{-- START: Migrations Overview Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[25px] mb-[25px]">
        {{-- Total Migrations --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Total Migration Files
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['total'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Direktori & Database
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Schema Files
                    </span>
                </div>
            </div>
        </div>

        {{-- Ran Migrations --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Sudah Dijalankan (Ran)
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['ran'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Tercatat di Database
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                        Tereksekusi
                    </span>
                </div>
            </div>
        </div>

        {{-- Pending Migrations --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Belum Dijalankan (Pending)
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['pending'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Menunggu Eksekusi
                    </span>
                    @if (($stats['pending'] ?? 0) > 0)
                        <span class="px-[8px] py-[3px] inline-block bg-danger-100 dark:bg-[#15203c] text-danger-600 rounded-sm font-medium text-xs">
                            Perlu Migrasi
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                            Tidak Ada
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sync Status --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Status Sinkronisasi
                </span>
                <h5 class="!mb-0 !text-[18px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ ($stats['status'] ?? '') === 'SYNCHRONIZED' ? 'Sinkron' : 'Ada Pending' }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Skema DB
                    </span>
                    @if (($stats['status'] ?? '') === 'SYNCHRONIZED')
                        <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                            Up to Date
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                            Pending
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- END: Migrations Overview Widgets --}}

    {{-- START: Migrations Data Table Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar Skema Migrasi Database
                </h5>
            </div>
            @can('settings-migrations.update')
                <div class="trezo-card-subtitle mt-3 sm:mt-0 flex flex-wrap items-center gap-3">
                    @if (($stats['pending'] ?? 0) > 0)
                        <button type="button" id="btn-open-modal-run-all" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium text-xs md:text-sm inline-flex items-center gap-2 shadow-sm">
                            <i class="ri-play-circle-line text-lg leading-none"></i>
                            <span>Jalankan Semua Migrasi Pending ({{ $stats['pending'] }})</span>
                        </button>
                    @endif

                    <button type="button" id="btn-open-modal-fresh" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-danger-500 text-white hover:bg-danger-400 transition-all rounded-md border border-danger-500 hover:border-danger-400 font-medium text-xs md:text-sm inline-flex items-center gap-2 shadow-sm">
                        <i class="ri-refresh-line text-lg leading-none"></i>
                        <span>Reset Database (Migrate Fresh --seed)</span>
                    </button>
                </div>
            @endcan
        </div>

        {{-- START: Data Table --}}
        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="migrations-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Nama Migrasi</th>
                            <th class="px-2 py-1 !text-center">Batch</th>
                            <th class="px-2 py-1 !text-center">Status</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="5">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat status migrasi...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    {{-- END: Migrations Data Table Card --}}

    {{-- START: Modal Migrate Fresh --}}
    <div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-migrate-fresh">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[550px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                
                {{-- START: Modal Header --}}
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0">
                            Reset Database (Migrate Fresh --seed)
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-modal-fresh">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>
                {{-- END: Modal Header --}}

                {{-- START: Form Migrate Fresh --}}
                <form action="{{ route('settings.migrations.fresh') }}" method="POST">
                    @csrf
                    <input type="hidden" name="with_seed" value="1">
                    
                    {{-- START: Modal Body --}}
                    <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                        <div class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md text-red-600 dark:text-red-400 text-xs leading-relaxed">
                            <strong class="font-semibold block mb-1">PERINGATAN:</strong>
                            Perintah ini akan menghapus (drop) semua tabel dalam database dan mengeksekusi ulang seluruh migrasi beserta data seeder (<code>php artisan migrate:fresh --seed</code>). Seluruh data yang ada saat ini akan hilang.
                        </div>

                        <div>
                            <label class="mb-[12px] font-medium block text-black dark:text-white">
                                Password Akun Admin
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-sm" placeholder="Masukkan password akun Anda untuk konfirmasi">
                        </div>
                    </div>
                    {{-- END: Modal Body --}}

                    {{-- START: Modal Footer --}}
                    <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                        <button class="inline-block py-[10px] px-[30px] bg-secondary-500 text-white transition-all hover:bg-secondary-400 rounded-md border border-secondary-500 hover:border-secondary-400 btn-close-modal-fresh" type="button">
                            Batal
                        </button>
                        <button type="submit" class="inline-block py-[10px] px-[30px] bg-danger-500 text-white transition-all hover:bg-danger-400 rounded-md border border-danger-500 hover:border-danger-400 font-medium">
                            <i class="ri-refresh-line align-middle mr-1"></i>
                            Ya, Reset Database & Seed
                        </button>
                    </div>
                    {{-- END: Modal Footer --}}
                </form>
                {{-- END: Form Migrate Fresh --}}

            </div>
        </div>
    </div>
    {{-- END: Modal Migrate Fresh --}}

    {{-- START: Modal Run All Migrations --}}
    <div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-run-all-migrations">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[550px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                
                {{-- START: Modal Header --}}
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0">
                            Jalankan Semua Migrasi Pending
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-modal-run-all">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>
                {{-- END: Modal Header --}}

                {{-- START: Form --}}
                <form action="{{ route('settings.migrations.run') }}" method="POST">
                    @csrf
                    {{-- START: Modal Body --}}
                    <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Perintah ini akan menjalankan seluruh migrasi yang masih berstatus pending secara berurutan.
                        </p>

                        <div>
                            <label class="mb-[12px] font-medium block text-black dark:text-white">
                                Password Akun Admin
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-sm" placeholder="Masukkan password akun Anda untuk konfirmasi">
                        </div>
                    </div>
                    {{-- END: Modal Body --}}

                    {{-- START: Modal Footer --}}
                    <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                        <button class="inline-block py-[10px] px-[30px] bg-secondary-500 text-white transition-all hover:bg-secondary-400 rounded-md border border-secondary-500 hover:border-secondary-400 btn-close-modal-run-all" type="button">
                            Batal
                        </button>
                        <button type="submit" class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium">
                            <i class="ri-play-circle-line align-middle mr-1"></i>
                            Jalankan Semua Migrasi
                        </button>
                    </div>
                    {{-- END: Modal Footer --}}
                </form>
            </div>
        </div>
    </div>
    {{-- END: Modal Run All Migrations --}}

    {{-- START: Modal Run Single Migration --}}
    <div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-run-single-migration">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[550px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                
                {{-- START: Modal Header --}}
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0">
                            Jalankan Migrasi Skema
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-modal-single">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>
                {{-- END: Modal Header --}}

                {{-- START: Form --}}
                <form action="{{ route('settings.migrations.run') }}" method="POST">
                    @csrf
                    <input type="hidden" name="migration" id="single-migration-input">
                    
                    {{-- START: Modal Body --}}
                    <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                        <div class="p-3 bg-gray-50 dark:bg-[#15203c] rounded-md">
                            <span class="text-xs text-gray-500 block mb-1">File Migrasi:</span>
                            <code id="single-migration-name" class="font-mono text-xs font-semibold text-primary-600 dark:text-primary-400 break-all">-</code>
                        </div>

                        <div>
                            <label class="mb-[12px] font-medium block text-black dark:text-white">
                                Password Akun Admin
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-sm" placeholder="Masukkan password akun Anda untuk konfirmasi">
                        </div>
                    </div>
                    {{-- END: Modal Body --}}

                    {{-- START: Modal Footer --}}
                    <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                        <button class="inline-block py-[10px] px-[30px] bg-secondary-500 text-white transition-all hover:bg-secondary-400 rounded-md border border-secondary-500 hover:border-secondary-400 btn-close-modal-single" type="button">
                            Batal
                        </button>
                        <button type="submit" class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium">
                            <i class="ri-play-circle-line align-middle mr-1"></i>
                            Jalankan Migrasi Ini
                        </button>
                    </div>
                    {{-- END: Modal Footer --}}
                </form>
            </div>
        </div>
    </div>
    {{-- END: Modal Run Single Migration --}}
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $(document).ready(function() {
            var migrationsTable = $('#migrations-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.migrations.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '5%'
                    },
                    {
                        data: 'migration_name',
                        name: 'migration_name',
                        searchable: true,
                        orderable: true,
                        width: '55%'
                    },
                    {
                        data: 'batch_badge',
                        name: 'batch_badge',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '12%'
                    },
                    {
                        data: 'status_badge',
                        name: 'status_badge',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '15%'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '13%'
                    },
                ],
            });

            // Modal Migrate Fresh toggles
            const modalFresh = document.getElementById('modal-migrate-fresh');
            $('#btn-open-modal-fresh').on('click', function() {
                modalFresh.classList.add('active');
            });
            $('.btn-close-modal-fresh').on('click', function() {
                modalFresh.classList.remove('active');
            });

            // Modal Run All toggles
            const modalRunAll = document.getElementById('modal-run-all-migrations');
            $('#btn-open-modal-run-all').on('click', function() {
                modalRunAll.classList.add('active');
            });
            $('.btn-close-modal-run-all').on('click', function() {
                modalRunAll.classList.remove('active');
            });

            // Modal Single Migration toggles
            const modalSingle = document.getElementById('modal-run-single-migration');
            $(document).on('click', '.btn-run-single-migration', function() {
                var migrationName = $(this).data('migration');
                $('#single-migration-input').val(migrationName);
                $('#single-migration-name').text(migrationName);
                modalSingle.classList.add('active');
            });
            $('.btn-close-modal-single').on('click', function() {
                modalSingle.classList.remove('active');
            });
        });
    </script>
@endpush
