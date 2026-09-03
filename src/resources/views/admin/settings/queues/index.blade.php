@extends('layouts.admin.master')

@section('title', 'Queue Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('queues') }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    {{-- START: Queue Overview Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-[25px] mb-[25px]">
        {{-- Queue Driver --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Queue Connection Driver
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ strtoupper($stats['driver'] ?? 'sync') }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Default Driver
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Configured
                    </span>
                </div>
            </div>
        </div>

        {{-- Pending Jobs Count --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Antrean Pending (In Queue)
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['pending_count'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Menunggu Diproses Worker
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Tabel `jobs`
                    </span>
                </div>
            </div>
        </div>

        {{-- Failed Jobs Count --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Failed Jobs (Gagal)
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold {{ ($stats['failed_count'] ?? 0) > 0 ? 'text-danger-500' : 'text-gray-800 dark:text-white' }}">
                    {{ $stats['failed_count'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Perlu Evaluasi
                    </span>
                    @if (($stats['failed_count'] ?? 0) > 0)
                        <span class="px-[8px] py-[3px] inline-block bg-danger-100 dark:bg-[#15203c] text-danger-600 rounded-sm font-medium text-xs">
                            Ada Kegagalan
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                            Bersih
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- END: Queue Overview Widgets --}}

    {{-- START: Queue Management Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                {{-- Tabs Navigation --}}
                <div class="flex items-center gap-2 border-b border-gray-200 dark:border-[#172036]">
                    <button type="button" id="tab-btn-pending" class="queue-tab-btn py-2 px-4 text-sm font-semibold border-b-2 border-primary-500 text-primary-500 transition-all inline-flex items-center gap-1.5">
                        <i class="material-symbols-outlined !text-sm">hourglass_top</i>
                        Pending Jobs ({{ $stats['pending_count'] ?? 0 }})
                    </button>
                    <button type="button" id="tab-btn-failed" class="queue-tab-btn py-2 px-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-all inline-flex items-center gap-1.5">
                        <i class="material-symbols-outlined !text-sm">error</i>
                        Failed Jobs ({{ $stats['failed_count'] ?? 0 }})
                    </button>
                </div>
            </div>

            <div class="trezo-card-subtitle mt-3 sm:mt-0 flex flex-wrap items-center gap-3">
                {{-- Actions for Pending Jobs --}}
                <div id="pending-actions" class="flex items-center gap-2">
                    @can('settings-queues.delete')
                        <button type="button" id="btn-swal-clear-queue" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-orange-100 text-orange-600 hover:bg-orange-200 transition-all rounded-md border border-orange-200 text-xs md:text-sm font-medium inline-flex items-center gap-2 shadow-sm">
                            <i class="ri-delete-bin-line text-lg leading-none"></i>
                            <span>Bersihkan Antrean (Clear Queue)</span>
                        </button>
                    @endcan
                </div>

                {{-- Actions for Failed Jobs --}}
                <div id="failed-actions" class="hidden flex items-center gap-2">
                    @can('settings-queues.update')
                        <form action="{{ route('settings.queues.retry-all') }}" method="POST">
                            @csrf
                            <button type="submit" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-primary-500 text-white hover:bg-primary-400 transition-all rounded-md border border-primary-500 text-xs md:text-sm font-medium inline-flex items-center gap-2 shadow-sm">
                                <i class="ri-refresh-line text-lg leading-none"></i>
                                <span>Retry All Failed</span>
                            </button>
                        </form>
                    @endcan

                    @can('settings-queues.delete')
                        <button type="button" id="btn-swal-flush-failed" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-danger-500 text-white hover:bg-danger-400 transition-all rounded-md border border-danger-500 text-xs md:text-sm font-medium inline-flex items-center gap-2 shadow-sm">
                            <i class="ri-delete-bin-2-line text-lg leading-none"></i>
                            <span>Flush All Failed</span>
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        {{-- START: Pending Jobs Table Pane --}}
        <div id="pane-pending" class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="pending-jobs-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Job Handler</th>
                            <th class="px-2 py-1 !text-center">Queue</th>
                            <th class="px-2 py-1 !text-center">Percobaan (Attempts)</th>
                            <th class="px-2 py-1 !text-center">Reserved At</th>
                            <th class="px-2 py-1 !text-center">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="6">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat pending jobs...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- START: Failed Jobs Table Pane --}}
        <div id="pane-failed" class="trezo-card-content hidden">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="failed-jobs-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Job Name</th>
                            <th class="px-2 py-1 !text-center">Queue</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Penyebab Error (Exception)</th>
                            <th class="px-2 py-1 !text-center">Waktu Gagal</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="6">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat failed jobs...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END: Queue Management Card --}}

    {{-- START: Modal Failed Job Exception Detail --}}
    <div class="modal-edit z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-exception-detail">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[900px] lg:max-w-[1000px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0 text-base">
                            Detail Failed Job Exception
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-exception-modal">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-[#15203c] rounded-md text-xs">
                        UUID: <span id="modal-failed-uuid" class="font-mono text-gray-800 dark:text-white">-</span>
                    </div>

                    <div>
                        <label class="font-medium text-xs text-gray-700 dark:text-gray-300 block mb-1">Stack Exception:</label>
                        <pre id="modal-failed-exception" class="p-3 bg-gray-900 text-danger-400 rounded-md font-mono text-[11px] overflow-x-auto max-h-[250px] leading-relaxed whitespace-pre-wrap"></pre>
                    </div>

                    <div>
                        <label class="font-medium text-xs text-gray-700 dark:text-gray-300 block mb-1">Job Payload:</label>
                        <pre id="modal-failed-payload" class="p-3 bg-gray-100 dark:bg-[#172036] text-gray-900 dark:text-gray-100 rounded-md font-mono text-[11px] overflow-x-auto max-h-[180px] leading-relaxed whitespace-pre-wrap"></pre>
                    </div>
                </div>

                <div class="trezo-card-footer flex items-center justify-end -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="py-[8px] px-[24px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md text-xs font-medium btn-close-exception-modal" type="button">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal Failed Job Exception Detail --}}

    {{-- Hidden forms --}}
    <form action="{{ route('settings.queues.clear') }}" id="form-clear-queue" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ route('settings.queues.flush') }}" id="form-flush-failed" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <form action="" id="form-delete-job" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $(document).ready(function() {
            // 1. Pending Jobs DataTable
            var pendingTable = $('#pending-jobs-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.queues.index') }}",
                    type: 'GET',
                    data: { type: 'pending' }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: '!text-center', width: '5%' },
                    { data: 'job_name', name: 'job_name', searchable: true, orderable: false, width: '45%' },
                    { data: 'queue_badge', name: 'queue_badge', searchable: false, orderable: false, className: '!text-center', width: '10%' },
                    { data: 'attempts_badge', name: 'attempts_badge', searchable: false, orderable: false, className: '!text-center', width: '10%' },
                    { data: 'reserved_at_formatted', name: 'reserved_at_formatted', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                    { data: 'created_at_formatted', name: 'created_at_formatted', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                ],
            });

            // 2. Failed Jobs DataTable
            var failedTable = null;
            function initFailedTable() {
                if (!failedTable) {
                    failedTable = $('#failed-jobs-table').DataTable({
                        pageLength: 100,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        processing: true,
                        serverSide: true,
                        language: {
                            url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                        },
                        ajax: {
                            url: "{{ route('settings.queues.index') }}",
                            type: 'GET',
                            data: { type: 'failed' }
                        },
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: '!text-center', width: '5%' },
                            { data: 'job_name', name: 'job_name', searchable: true, orderable: false, width: '30%' },
                            { data: 'queue_badge', name: 'queue_badge', searchable: false, orderable: false, className: '!text-center', width: '10%' },
                            { data: 'exception_view', name: 'exception_view', searchable: false, orderable: false, width: '30%' },
                            { data: 'failed_at_formatted', name: 'failed_at_formatted', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                            { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: '!text-center', width: '10%' },
                        ],
                    });
                } else {
                    failedTable.ajax.reload();
                }
            }

            // Tab toggling
            $('#tab-btn-pending').on('click', function() {
                $(this).addClass('border-primary-500 text-primary-500').removeClass('border-transparent text-gray-500');
                $('#tab-btn-failed').removeClass('border-primary-500 text-primary-500').addClass('border-transparent text-gray-500');
                $('#pane-pending, #pending-actions').removeClass('hidden');
                $('#pane-failed, #failed-actions').addClass('hidden');
                pendingTable.ajax.reload();
            });

            $('#tab-btn-failed').on('click', function() {
                $(this).addClass('border-primary-500 text-primary-500').removeClass('border-transparent text-gray-500');
                $('#tab-btn-pending').removeClass('border-primary-500 text-primary-500').addClass('border-transparent text-gray-500');
                $('#pane-failed, #failed-actions').removeClass('hidden');
                $('#pane-pending, #pending-actions').addClass('hidden');
                initFailedTable();
            });

            // SweetAlert for Clear Queue
            $('#btn-swal-clear-queue').on('click', function() {
                Swal.fire({
                    title: 'Kosongkan Antrean Queue?',
                    text: 'Seluruh job yang masih menunggu antrean akan dihapus dari tabel jobs.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Kosongkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-clear-queue').submit();
                    }
                });
            });

            // SweetAlert for Flush Failed
            $('#btn-swal-flush-failed').on('click', function() {
                Swal.fire({
                    title: 'Hapus Seluruh Failed Jobs?',
                    text: 'Semua rekaman failed jobs akan dibersihkan secara permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Hapus Semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-flush-failed').submit();
                    }
                });
            });

            // Exception Modal
            const exceptionModal = document.getElementById('modal-exception-detail');

            $(document).on('click', '.btn-exception-detail', function() {
                var uuid = $(this).data('uuid');
                var exception = $(this).data('exception');
                var rawPayload = $(this).data('payload');

                $('#modal-failed-uuid').text(uuid);
                $('#modal-failed-exception').text(exception);

                try {
                    var parsed = typeof rawPayload === 'object' ? rawPayload : JSON.parse(rawPayload);
                    $('#modal-failed-payload').text(JSON.stringify(parsed, null, 2));
                } catch (e) {
                    $('#modal-failed-payload').text(rawPayload);
                }

                exceptionModal.classList.add('active');
            });

            $('.btn-close-exception-modal').on('click', function() {
                exceptionModal.classList.remove('active');
            });

            // Forget single job handler
            $(document).on('click', '.btn-forget-job', function() {
                var urlAction = $(this).data('url-action');
                Swal.fire({
                    title: 'Hapus Failed Job?',
                    text: 'Catatan job gagal ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-job').attr('action', urlAction).submit();
                    }
                });
            });
        });
    </script>
@endpush
