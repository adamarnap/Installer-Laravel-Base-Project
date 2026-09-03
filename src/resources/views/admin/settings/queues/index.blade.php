@extends('layouts.admin.master')

@section('title', 'Queue Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('queues') }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Queue Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary flex items-center justify-center text-2xl">
                <i class="ti ti-server-cog"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Default Queue Driver</p>
                <h4 class="text-xl font-bold text-gray-800 uppercase">{{ $stats['driver'] }}</h4>
                <span class="text-xs text-gray-400">config('queue.default')</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-info/10 text-info flex items-center justify-center text-2xl">
                <i class="ti ti-clock-play"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Antrean Tertunda (Pending)</p>
                <h4 class="text-xl font-bold text-gray-800">{{ $stats['pending_count'] }} Job</h4>
                <span class="text-xs text-gray-400">Tabel: jobs</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full {{ $stats['failed_count'] > 0 ? 'bg-danger/10 text-danger animate-pulse' : 'bg-success/10 text-success' }} flex items-center justify-center text-2xl">
                <i class="ti ti-alert-triangle"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Gagal Dijalankan (Failed)</p>
                <h4 class="text-xl font-bold {{ $stats['failed_count'] > 0 ? 'text-danger' : 'text-gray-800' }}">{{ $stats['failed_count'] }} Job</h4>
                <span class="text-xs text-gray-400">Tabel: failed_jobs</span>
            </div>
        </div>
    </div>
    <!-- END: Queue Summary Cards -->

    <!-- START: Operations Bar -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header border-b border-borderColor p-4 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h5 class="card-title text-base font-bold text-gray-800">Operasi Queue & Background Jobs</h5>
                <p class="text-xs text-gray-500 mt-0.5">Kelola job gagal, bersihkan antrean, atau coba ulang proses yang error.</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                @if($stats['failed_count'] > 0)
                    <button type="button" id="btn-retry-all-jobs" class="btn bg-primary border border-primary text-white hover:bg-primary-hover py-2 px-3 rounded text-xs inline-flex items-center gap-1.5">
                        <i class="ti ti-rotate-clockwise text-sm"></i> Retry All Failed Jobs
                    </button>

                    <button type="button" id="btn-flush-failed-jobs" class="btn bg-danger border border-danger text-white hover:bg-danger/80 py-2 px-3 rounded text-xs inline-flex items-center gap-1.5">
                        <i class="ti ti-trash text-sm"></i> Flush All Failed Jobs
                    </button>
                @endif

                <button type="button" id="btn-clear-pending-queue" class="btn bg-white border border-borderColor text-gray-700 hover:bg-gray-100 py-2 px-3 rounded text-xs inline-flex items-center gap-1.5">
                    <i class="ti ti-clear-all text-sm"></i> Clear Pending Queue
                </button>
            </div>
        </div>
    </div>
    <!-- END: Operations Bar -->

    <!-- START: Tabs & Tables -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="border-b border-borderColor px-5 pt-4">
            <div class="flex space-x-6">
                <button type="button" id="tab-btn-pending" class="tab-link pb-3 font-semibold text-sm border-b-2 border-primary text-primary flex items-center gap-2">
                    <i class="ti ti-clock-play"></i> Pending Jobs
                    <span class="py-0.5 px-2 rounded-full text-xs font-bold bg-primary/10 text-primary">{{ $stats['pending_count'] }}</span>
                </button>
                <button type="button" id="tab-btn-failed" class="tab-link pb-3 font-semibold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    <i class="ti ti-alert-triangle"></i> Failed Jobs
                    <span class="py-0.5 px-2 rounded-full text-xs font-bold {{ $stats['failed_count'] > 0 ? 'bg-danger/10 text-danger' : 'bg-gray-100 text-gray-500' }}">{{ $stats['failed_count'] }}</span>
                </button>
            </div>
        </div>

        <!-- Content Tab 1: Pending Jobs -->
        <div id="tab-content-pending" class="p-0">
            <div class="card-header py-4 px-5 border-b border-borderColor">
                <div class="relative w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="pending-table-search" placeholder="Cari pending job..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary w-full"/>
                </div>
            </div>
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-pending">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama Job / Handler</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Queue</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Attempts</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Status Reserved</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-4 border-t border-borderColor">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="w-full md:w-1/2">
                        <div class="datatable-length-pending"></div>
                    </div>
                    <div class="w-full md:w-1/2 text-center">
                        <div class="datatable-info-pending text-sm text-gray-500"></div>
                    </div>
                    <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end">
                        <div class="datatable-paginate-pending"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Tab 2: Failed Jobs -->
        <div id="tab-content-failed" class="p-0 hidden">
            <div class="card-header py-4 px-5 border-b border-borderColor">
                <div class="relative w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="failed-table-search" placeholder="Cari failed job..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary w-full"/>
                </div>
            </div>
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-failed">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama Job</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Queue</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Pesan Error / Exception</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Gagal Pada</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-4 border-t border-borderColor">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="w-full md:w-1/2">
                        <div class="datatable-length-failed"></div>
                    </div>
                    <div class="w-full md:w-1/2 text-center">
                        <div class="datatable-info-failed text-sm text-gray-500"></div>
                    </div>
                    <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end">
                        <div class="datatable-paginate-failed"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Tabs & Tables -->
</div>

{{-- Hidden Forms for Queue Operations --}}
<form id="form-retry-all" action="{{ route('settings.queues.retry-all') }}" method="POST" class="hidden">
    @csrf
</form>

<form id="form-flush-failed" action="{{ route('settings.queues.flush') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<form id="form-clear-pending" action="{{ route('settings.queues.clear') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<form id="form-forget-single" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@include('admin.settings.queues.partials.modal-detail')
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            // Tab switching
            $('#tab-btn-pending').on('click', function () {
                $(this).addClass('border-primary text-primary').removeClass('border-transparent text-gray-500');
                $('#tab-btn-failed').removeClass('border-primary text-primary').addClass('border-transparent text-gray-500');
                $('#tab-content-pending').removeClass('hidden');
                $('#tab-content-failed').addClass('hidden');
            });

            $('#tab-btn-failed').on('click', function () {
                $(this).addClass('border-primary text-primary').removeClass('border-transparent text-gray-500');
                $('#tab-btn-pending').removeClass('border-primary text-primary').addClass('border-transparent text-gray-500');
                $('#tab-content-failed').removeClass('hidden');
                $('#tab-content-pending').addClass('hidden');
                if (!$.fn.DataTable.isDataTable('#data-table-failed')) {
                    initFailedDataTable();
                }
            });

            // Pending DataTable
            const pendingDataTable = $('#data-table-pending').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ pending job',
                    infoEmpty: 'Tidak ada job dalam antrean',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.queues.index') }}",
                    data: { type: 'pending' }
                },
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'job_name', name: 'payload', searchable: true, orderable: false, className: 'px-5 py-2.5 text-left' },
                    { data: 'queue_badge', name: 'queue', searchable: true, orderable: true, className: 'px-5 py-2.5 text-left' },
                    { data: 'attempts_badge', name: 'attempts', searchable: false, orderable: true, className: 'px-5 py-2.5 text-left' },
                    { data: 'reserved_at_formatted', name: 'reserved_at', searchable: false, orderable: true, className: 'px-5 py-2.5 text-gray-500 text-xs text-left' },
                    { data: 'created_at_formatted', name: 'created_at', searchable: false, orderable: true, className: 'px-5 py-2.5 text-gray-500 text-xs text-left' },
                ],
                initComplete: function () {
                    if ($('.datatable-length-pending').length) {
                        $('#data-table-pending_wrapper .dt-length').appendTo('.datatable-length-pending');
                    }
                    if ($('.datatable-info-pending').length) {
                        $('#data-table-pending_wrapper .dt-info').appendTo('.datatable-info-pending');
                    }
                    if ($('.datatable-paginate-pending').length) {
                        $('#data-table-pending_wrapper .dt-paging').appendTo('.datatable-paginate-pending');
                    }
                },
            });

            $('#pending-table-search').on('input', function () {
                pendingDataTable.search(this.value).draw();
            });

            // Failed DataTable
            function initFailedDataTable() {
                const failedDataTable = $('#data-table-failed').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    dom: 'lrtip',
                    language: {
                        search: ' ',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: 'Search',
                        info: 'Menampilkan _START_ - _END_ dari _TOTAL_ failed job',
                        infoEmpty: 'Tidak ada failed job',
                        infoFiltered: '(difilter dari _MAX_ total data)',
                        lengthMenu: 'Tampilkan _MENU_ data',
                        paginate: {
                            next: '<i class="ti ti-chevron-right"></i>',
                            previous: '<i class="ti ti-chevron-left"></i>',
                        },
                    },
                    ajax: {
                        url: "{{ route('settings.queues.index') }}",
                        data: { type: 'failed' }
                    },
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'px-5 py-2.5 text-gray-500 text-left' },
                        { data: 'job_name', name: 'payload', searchable: true, orderable: false, className: 'px-5 py-2.5 text-left' },
                        { data: 'queue_badge', name: 'queue', searchable: true, orderable: true, className: 'px-5 py-2.5 text-left' },
                        { data: 'exception_view', name: 'exception', searchable: true, orderable: false, className: 'px-5 py-2.5 text-left max-w-sm' },
                        { data: 'failed_at_formatted', name: 'failed_at', searchable: false, orderable: true, className: 'px-5 py-2.5 text-gray-500 text-xs text-left' },
                        { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: 'px-5 py-2.5 text-left' },
                    ],
                    initComplete: function () {
                        if ($('.datatable-length-failed').length) {
                            $('#data-table-failed_wrapper .dt-length').appendTo('.datatable-length-failed');
                        }
                        if ($('.datatable-info-failed').length) {
                            $('#data-table-failed_wrapper .dt-info').appendTo('.datatable-info-failed');
                        }
                        if ($('.datatable-paginate-failed').length) {
                            $('#data-table-failed_wrapper .dt-paging').appendTo('.datatable-paginate-failed');
                        }
                    },
                });

                $('#failed-table-search').on('input', function () {
                    failedDataTable.search(this.value).draw();
                });
            }

            // 1. Clear Pending Queue with SweetAlert
            $('#btn-clear-pending-queue').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bersihkan Antrean Pending Job?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Tindakan ini akan <strong>menghapus seluruh antrean job</strong> yang sedang menunggu untuk dieksekusi di database.</p>
                            <div class="p-2.5 bg-gray-100 rounded border text-xs font-mono text-danger font-bold">Command: php artisan queue:clear</div>
                            <p class="text-xs text-gray-500">Apakah Anda yakin ingin melanjutkan?</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="ti ti-trash mr-1"></i> Ya, Bersihkan Antrean',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-clear-pending').submit();
                    }
                });
            });

            // 2. Flush All Failed Jobs with SweetAlert
            $('#btn-flush-failed-jobs').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Seluruh Failed Jobs?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Seluruh riwayat catatan job yang gagal akan <strong>dibersihkan permanen</strong>.</p>
                            <div class="p-2.5 bg-gray-100 rounded border text-xs font-mono text-danger font-bold">Command: php artisan queue:flush</div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="ti ti-trash mr-1"></i> Ya, Flush All',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-flush-failed').submit();
                    }
                });
            });

            // 3. Retry All Failed Jobs with SweetAlert
            $('#btn-retry-all-jobs').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Coba Ulang Seluruh Failed Jobs?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Seluruh failed job akan dimasukkan kembali ke antrean untuk dieksekusi ulang.</p>
                            <div class="p-2.5 bg-gray-100 rounded border text-xs font-mono text-primary font-bold">Command: php artisan queue:retry all</div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="ti ti-rotate-clockwise mr-1"></i> Retry All',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-retry-all').submit();
                    }
                });
            });

            // 4. Forget Single Failed Job with SweetAlert
            $(document).on('click', '.btn-forget-job', function (e) {
                e.preventDefault();
                const actionUrl = $(this).data('url-action');
                Swal.fire({
                    title: 'Hapus Failed Job Ini?',
                    text: 'Data failed job ini akan dihapus permanen dari sistem.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-forget-single').attr('action', actionUrl).submit();
                    }
                });
            });

            // 5. Exception detail modal
            $(document).on('click', '.btn-exception-detail', function (e) {
                e.preventDefault();
                const uuid = $(this).data('uuid');
                const exception = $(this).data('exception');
                const payload = $(this).data('payload');

                $('#modal-uuid').text(uuid);
                $('#modal-exception').text(exception);
                try {
                    const parsed = JSON.parse(payload);
                    $('#modal-payload').text(JSON.stringify(parsed, null, 2));
                } catch (err) {
                    $('#modal-payload').text(payload);
                }

                $('#modalDetailToggle').click();
            });
        });
    </script>
@endpush
