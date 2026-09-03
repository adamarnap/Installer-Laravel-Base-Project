@extends('layouts.admin.master')

@section('title', 'Queue Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('queues') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- START: Queue Statistics & Global Controls --}}
        <div class="card">
            <div class="card-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h4 class="card-title mb-1.25">Status & Manajemen Antrean (Queue)</h4>
                    <p class="text-default-400">Pantau proses background jobs yang sedang antre (pending) maupun yang gagal (failed jobs).</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @can('settings-queues.update')
                        <button type="button"
                            id="btn-retry-all"
                            class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm"
                            {{ $stats['failed_count'] === 0 ? 'disabled' : '' }}>
                            <i class="iconify tabler--rotate-clockwise text-base"></i>
                            Coba Ulang Semua Failed Jobs (Retry All)
                        </button>
                    @endcan

                    @can('settings-queues.delete')
                        <button type="button"
                            id="btn-flush-failed"
                            class="btn bg-danger hover:bg-danger-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm"
                            {{ $stats['failed_count'] === 0 ? 'disabled' : '' }}>
                            <i class="iconify tabler--trash text-base"></i>
                            Bersihkan Semua Failed Jobs (Flush)
                        </button>

                        <button type="button"
                            id="btn-clear-pending"
                            class="btn border border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm"
                            {{ $stats['pending_count'] === 0 ? 'disabled' : '' }}>
                            <i class="iconify tabler--circle-x text-base"></i>
                            Kosongkan Antrean Pending (Clear)
                        </button>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Driver Status --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Queue Connection / Driver</span>
                            <div class="text-lg font-bold font-mono text-default-800 uppercase">{{ $stats['driver'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <i class="iconify tabler--server text-xl"></i>
                        </div>
                    </div>

                    {{-- Pending Jobs Count --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Jobs dalam Antrean (Pending)</span>
                            <div class="text-2xl font-bold text-primary">{{ $stats['pending_count'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-info/10 text-info flex items-center justify-center">
                            <i class="iconify tabler--hourglass-empty text-xl"></i>
                        </div>
                    </div>

                    {{-- Failed Jobs Count --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Jobs Gagal (Failed Jobs)</span>
                            <div class="text-2xl font-bold {{ $stats['failed_count'] > 0 ? 'text-danger' : 'text-success' }}">
                                {{ $stats['failed_count'] }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full {{ $stats['failed_count'] > 0 ? 'bg-danger/10 text-danger' : 'bg-success/10 text-success' }} flex items-center justify-center">
                            <i class="iconify tabler--alert-circle text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Queue Statistics --}}

        {{-- START: Tabs for Pending and Failed Jobs --}}
        <div class="card">
            <div class="card-header border-b border-default-200 p-0">
                <nav class="flex space-x-2 px-4" aria-label="Tabs" role="tablist">
                    <button type="button"
                        class="hs-tab-active:border-primary hs-tab-active:text-primary active py-3.5 px-3 inline-flex items-center gap-2 border-b-2 border-transparent text-sm font-semibold whitespace-nowrap text-default-500 hover:text-primary"
                        id="tab-pending-item"
                        data-hs-tab="#tab-pending"
                        aria-controls="tab-pending"
                        role="tab">
                        <i class="iconify tabler--list-check text-lg"></i>
                        Antrean Pending
                        <span class="badge bg-primary/10 text-primary rounded-full text-xs px-2 py-0.5">{{ $stats['pending_count'] }}</span>
                    </button>

                    <button type="button"
                        class="hs-tab-active:border-danger hs-tab-active:text-danger py-3.5 px-3 inline-flex items-center gap-2 border-b-2 border-transparent text-sm font-semibold whitespace-nowrap text-default-500 hover:text-danger"
                        id="tab-failed-item"
                        data-hs-tab="#tab-failed"
                        aria-controls="tab-failed"
                        role="tab">
                        <i class="iconify tabler--alert-triangle text-lg"></i>
                        Jobs Gagal (Failed)
                        <span class="badge {{ $stats['failed_count'] > 0 ? 'bg-danger/15 text-danger' : 'bg-default-200 text-default-600' }} rounded-full text-xs px-2 py-0.5">{{ $stats['failed_count'] }}</span>
                    </button>
                </nav>
            </div>

            <div class="card-body">
                {{-- Content Tab 1: Pending Jobs --}}
                <div id="tab-pending" role="tabpanel" aria-labelledby="tab-pending-item">
                    <div class="table-wrapper -mb-4">
                        <table id="pending-jobs-table" class="table table-striped" style="width:100%">
                            <thead class="text-2xs font-semibold uppercase">
                                <tr>
                                    <th class="text-center" style="width: 5%">No.</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 45%">Job Handler</th>
                                    <th class="text-center" style="width: 15%">Queue Channel</th>
                                    <th class="text-center" style="width: 10%">Percobaan</th>
                                    <th class="text-center" style="width: 12%">Status Reservasi</th>
                                    <th class="text-center" style="width: 13%">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">
                                    <td colspan="6">
                                        <div class="flex items-center justify-center py-6">
                                            <span class="text-gray-500">Memuat antrean jobs...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Content Tab 2: Failed Jobs --}}
                <div id="tab-failed" class="hidden" role="tabpanel" aria-labelledby="tab-failed-item">
                    <div class="table-wrapper -mb-4">
                        <table id="failed-jobs-table" class="table table-striped" style="width:100%">
                            <thead class="text-2xs font-semibold uppercase">
                                <tr>
                                    <th class="text-center" style="width: 5%">No.</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 35%">Job Handler</th>
                                    <th class="text-center" style="width: 12%">Queue</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 25%">Pesan Exception</th>
                                    <th class="text-center" style="width: 13%">Waktu Gagal</th>
                                    <th class="text-center" style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">
                                    <td colspan="6">
                                        <div class="flex items-center justify-center py-6">
                                            <span class="text-gray-500">Memuat failed jobs...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Tabs --}}
    </div>

    {{-- START: Exception Detail Modal --}}
    <div id="modal-exception-detail" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-exception-title">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all max-w-4xl w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-default-200 shadow-sm rounded-xl pointer-events-auto dark:bg-default-800 dark:border-default-700">
                <div class="flex justify-between items-center py-3 px-4 border-b border-default-200 dark:border-default-700">
                    <div class="flex items-center gap-2">
                        <i class="iconify tabler--bug text-danger text-xl"></i>
                        <h3 id="modal-exception-title" class="font-bold text-default-800 dark:text-white">
                            Detail Kegagalan Job (Exception Stack Trace)
                        </h3>
                    </div>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-default-100 text-default-800 hover:bg-default-200 focus:outline-none dark:bg-default-700 dark:hover:bg-default-600 dark:text-default-400" data-hs-overlay="#modal-exception-detail">
                        <span class="sr-only">Close</span>
                        <i class="iconify tabler--x text-base"></i>
                    </button>
                </div>

                <div class="p-4 overflow-y-auto max-h-[75vh] space-y-4">
                    <div>
                        <span class="text-2xs text-default-500 font-semibold uppercase block mb-1">UUID Job:</span>
                        <span id="exception-uuid" class="font-mono text-xs font-bold text-default-800"></span>
                    </div>

                    <div>
                        <label class="form-label font-bold text-xs uppercase text-default-700">Exception Message & Stack Trace:</label>
                        <pre id="exception-trace" class="bg-slate-900 text-red-300 p-3 rounded text-xs font-mono break-all whitespace-pre-wrap max-h-72 overflow-y-auto border border-slate-800"></pre>
                    </div>

                    <div>
                        <label class="form-label font-bold text-xs uppercase text-default-700">Job Payload (Data Serialized):</label>
                        <pre id="exception-payload" class="bg-default-100 text-default-900 p-3 rounded text-xs font-mono break-all whitespace-pre-wrap max-h-48 overflow-y-auto border border-default-200"></pre>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200 dark:border-default-700">
                    <button type="button" class="btn border border-default-300 hover:bg-default-100 text-default-700 text-xs py-2 px-4 rounded inline-flex items-center gap-1" data-hs-overlay="#modal-exception-detail">
                        <i class="iconify tabler--x text-sm"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Exception Detail Modal --}}

    {{-- Global Forms --}}
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

    <form id="form-forget-job" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // 1. Pending Jobs DataTable
            var pendingTable = $('#pending-jobs-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ job pending",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    zeroRecords: "Tidak ada antrean pending",
                    processing: "Memuat antrean..."
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.queues.index') }}",
                    data: { type: 'pending' },
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'id',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'job_name',
                        name: 'job_name',
                        orderable: false
                    },
                    {
                        data: 'queue_badge',
                        name: 'queue',
                        className: 'text-center'
                    },
                    {
                        data: 'attempts_badge',
                        name: 'attempts',
                        className: 'text-center'
                    },
                    {
                        data: 'reserved_at_formatted',
                        name: 'reserved_at',
                        className: 'text-center text-xs'
                    },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at',
                        className: 'text-center text-xs'
                    }
                ],
                drawCallback: function() {
                    if (window.HSStaticMethods) {
                        window.HSStaticMethods.autoInit();
                    }
                }
            });

            // 2. Failed Jobs DataTable
            var failedTable = $('#failed-jobs-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ failed jobs",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    zeroRecords: "Tidak ada failed job",
                    processing: "Memuat failed jobs..."
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.queues.index') }}",
                    data: { type: 'failed' },
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'id',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'job_name',
                        name: 'job_name',
                        orderable: false
                    },
                    {
                        data: 'queue_badge',
                        name: 'queue',
                        className: 'text-center'
                    },
                    {
                        data: 'exception_view',
                        name: 'exception',
                        orderable: false
                    },
                    {
                        data: 'failed_at_formatted',
                        name: 'failed_at',
                        className: 'text-center text-xs'
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

            // Re-render table on tab activation
            $('#tab-failed-item').on('click', function() {
                setTimeout(function() {
                    failedTable.columns.adjust().draw();
                }, 150);
            });

            // View Exception Details
            $(document).on('click', '.btn-exception-detail', function(e) {
                e.preventDefault();
                const uuid = $(this).attr('data-uuid') || '-';
                const exception = $(this).attr('data-exception') || '';
                const payload = $(this).attr('data-payload') || '';

                $('#exception-uuid').text(uuid);
                $('#exception-trace').text(exception);
                try {
                    const parsed = JSON.parse(payload);
                    $('#exception-payload').text(JSON.stringify(parsed, null, 2));
                } catch(e) {
                    $('#exception-payload').text(payload);
                }

                if (window.HSOverlay) {
                    HSOverlay.open('#modal-exception-detail');
                }
            });

            // 1. Retry All Failed Jobs
            $('#btn-retry-all').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Coba Ulang Semua Failed Jobs?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Semua job yang sebelumnya gagal akan dikembalikan ke dalam antrean pending untuk dieksekusi ulang oleh worker.</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>php artisan queue:retry all</code>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--rotate-clockwise mr-1"></i> Ya, Retry Semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-retry-all').submit();
                    }
                });
            });

            // 2. Flush All Failed Jobs
            $('#btn-flush-failed').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Semua Failed Jobs?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus seluruh rekaman antrean yang gagal (<strong class="text-danger">Flush Failed Jobs</strong>)?</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>php artisan queue:flush</code>
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Hapus Semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-flush-failed').submit();
                    }
                });
            });

            // 3. Clear Pending Queue
            $('#btn-clear-pending').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Kosongkan Antrean Pending?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Tindakan ini akan menghapus seluruh jobs yang sedang menunggu giliran dalam antrean (pending queue).</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>php artisan queue:clear</code>
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Kosongkan Antrean!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-clear-pending').submit();
                    }
                });
            });

            // 4. Forget Single Failed Job
            $(document).on('click', '.btn-forget-job', function(e) {
                e.preventDefault();
                const urlAction = $(this).data('url-action');
                Swal.fire({
                    title: 'Hapus Failed Job Ini?',
                    text: 'Job gagal ini akan dihapus permanen dari daftar failed_jobs.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-forget-job').attr('action', urlAction);
                        $('#form-forget-job').submit();
                    }
                });
            });
        });
    </script>
@endpush
