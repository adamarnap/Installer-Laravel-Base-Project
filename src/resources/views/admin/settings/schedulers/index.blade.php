@extends('layouts.admin.master')

@section('title', 'Scheduler Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('schedulers') }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Monitoring & Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Monitoring Heartbeat Card -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full {{ $monitoring['is_healthy'] ? 'bg-success/10 text-success' : 'bg-danger/10 text-danger animate-pulse' }} flex items-center justify-center text-2xl">
                <i class="ti ti-heart-rate-monitor"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Status Monitoring Scheduler</p>
                <div class="flex items-center gap-2 mt-0.5">
                    <span class="inline-flex items-center py-0.5 px-2 rounded-full text-xs font-bold {{ $monitoring['is_healthy'] ? 'bg-success text-white' : 'bg-danger text-white' }}">
                        {{ $monitoring['status_label'] }}
                    </span>
                </div>
                <span class="text-[11px] text-gray-400 block mt-1">Heartbeat: {{ $monitoring['last_heartbeat'] }}</span>
            </div>
        </div>

        <!-- Total Schedulers Card -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary flex items-center justify-center text-2xl">
                <i class="ti ti-calendar-time"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Task Terdaftar</p>
                <h4 class="text-xl font-bold text-gray-800">{{ $stats['total_tasks'] }} Task</h4>
                <span class="text-xs text-gray-400">{{ $stats['kernel_tasks_count'] }} Kernel / {{ $stats['db_tasks_count'] }} Custom UI</span>
            </div>
        </div>

        <!-- Failed Execution Logs Card -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full {{ $stats['failed_logs_count'] > 0 ? 'bg-danger/10 text-danger' : 'bg-info/10 text-info' }} flex items-center justify-center text-2xl">
                <i class="ti ti-history-toggle"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Log Eksekusi Gagal</p>
                <h4 class="text-xl font-bold {{ $stats['failed_logs_count'] > 0 ? 'text-danger' : 'text-gray-800' }}">{{ $stats['failed_logs_count'] }} Log Error</h4>
                <span class="text-xs text-gray-400">Riwayat eksekusi gagal</span>
            </div>
        </div>
    </div>
    <!-- END: Monitoring & Summary Cards -->

    <!-- START: Operations Bar -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header border-b border-borderColor p-4 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h5 class="card-title text-base font-bold text-gray-800">Manajemen Task Schedulers & Cron Jobs</h5>
                <p class="text-xs text-gray-500 mt-0.5">Kelola task berkala, buat cron task kustom, dan pantau riwayat eksekusi otomatis.</p>
            </div>
            <div class="flex items-center gap-2">
                @can('settings-schedulers.create')
                    <button type="button" class="btn bg-primary border border-primary text-white hover:bg-primary-hover py-2 px-3.5 rounded text-xs inline-flex items-center gap-1.5"
                        data-modal-toggle="modalAdd" data-modal-target="modalAdd">
                        <i class="ti ti-plus text-sm"></i> Tambah Task Scheduler
                    </button>
                @endcan
            </div>
        </div>
    </div>
    <!-- END: Operations Bar -->

    <!-- START: Tabs & Tables -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="border-b border-borderColor px-5 pt-4">
            <div class="flex space-x-6">
                <button type="button" id="tab-btn-tasks" class="tab-link pb-3 font-semibold text-sm border-b-2 border-primary text-primary flex items-center gap-2">
                    <i class="ti ti-calendar-time"></i> Daftar Task Scheduler
                    <span class="py-0.5 px-2 rounded-full text-xs font-bold bg-primary/10 text-primary">{{ $stats['total_tasks'] }}</span>
                </button>
                <button type="button" id="tab-btn-logs" class="tab-link pb-3 font-semibold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    <i class="ti ti-history"></i> Riwayat Eksekusi (Logs)
                </button>
            </div>
        </div>

        <!-- Content Tab 1: Schedulers Table -->
        <div id="tab-content-tasks" class="p-0">
            <div class="card-header py-4 px-5 border-b border-borderColor">
                <div class="relative w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="scheduler-table-search" placeholder="Cari scheduled task..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary w-full"/>
                </div>
            </div>
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-schedulers">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama Task & Command</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Interval & Expression</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Status</th>
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
                        <div class="datatable-length-tasks"></div>
                    </div>
                    <div class="w-full md:w-1/2 text-center">
                        <div class="datatable-info-tasks text-sm text-gray-500"></div>
                    </div>
                    <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end">
                        <div class="datatable-paginate-tasks"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Tab 2: Execution Logs Table -->
        <div id="tab-content-logs" class="p-0 hidden">
            <div class="card-header py-4 px-5 border-b border-borderColor">
                <div class="relative w-72">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="logs-table-search" placeholder="Cari log riwayat..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary w-full"/>
                </div>
            </div>
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-logs">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama Task</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Status</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Durasi</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Waktu Eksekusi</th>
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
                        <div class="datatable-length-logs"></div>
                    </div>
                    <div class="w-full md:w-1/2 text-center">
                        <div class="datatable-info-logs text-sm text-gray-500"></div>
                    </div>
                    <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end">
                        <div class="datatable-paginate-logs"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Tabs & Tables -->
</div>

{{-- Hidden Form for Running Tasks --}}
<form id="form-run-task" action="{{ route('settings.schedulers.run') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="source" id="input-run-source" value="kernel">
    <input type="hidden" name="task_index" id="input-run-index" value="">
    <input type="hidden" name="task_id" id="input-run-id" value="">
</form>

{{-- Hidden Form for Deleting Tasks --}}
<form id="form-delete-task" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@can('settings-schedulers.create')
    @include('admin.settings.schedulers.partials.modal-add')
@endcan

@can('settings-schedulers.update')
    @include('admin.settings.schedulers.partials.modal-edit')
@endcan

@include('admin.settings.schedulers.partials.modal-detail')
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            // Tab switching
            $('#tab-btn-tasks').on('click', function () {
                $(this).addClass('border-primary text-primary').removeClass('border-transparent text-gray-500');
                $('#tab-btn-logs').removeClass('border-primary text-primary').addClass('border-transparent text-gray-500');
                $('#tab-content-tasks').removeClass('hidden');
                $('#tab-content-logs').addClass('hidden');
            });

            $('#tab-btn-logs').on('click', function () {
                $(this).addClass('border-primary text-primary').removeClass('border-transparent text-gray-500');
                $('#tab-btn-tasks').removeClass('border-primary text-primary').addClass('border-transparent text-gray-500');
                $('#tab-content-logs').removeClass('hidden');
                $('#tab-content-tasks').addClass('hidden');
                if (!$.fn.DataTable.isDataTable('#data-table-logs')) {
                    initLogsDataTable();
                }
            });

            // Schedulers DataTable
            const schedulersDataTable = $('#data-table-schedulers').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ task',
                    infoEmpty: 'Tidak ada task scheduler yang ditemukan',
                    infoFiltered: '(difilter dari _MAX_ total task)',
                    lengthMenu: 'Tampilkan _MENU_ task',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.schedulers.index') }}",
                    type: 'GET',
                },
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'task_name_view', name: 'name', searchable: true, orderable: true, className: 'px-5 py-2.5 text-left' },
                    { data: 'interval_view', name: 'expression', searchable: true, orderable: false, className: 'px-5 py-2.5 text-left' },
                    { data: 'status_badge', name: 'is_active', searchable: false, orderable: false, className: 'px-5 py-2.5 text-left' },
                    { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: 'px-5 py-2.5 text-left' },
                ],
                initComplete: function () {
                    if ($('.datatable-length-tasks').length) {
                        $('#data-table-schedulers_wrapper .dt-length').appendTo('.datatable-length-tasks');
                    }
                    if ($('.datatable-info-tasks').length) {
                        $('#data-table-schedulers_wrapper .dt-info').appendTo('.datatable-info-tasks');
                    }
                    if ($('.datatable-paginate-tasks').length) {
                        $('#data-table-schedulers_wrapper .dt-paging').appendTo('.datatable-paginate-tasks');
                    }
                },
            });

            $('#scheduler-table-search').on('input', function () {
                schedulersDataTable.search(this.value).draw();
            });

            // Logs DataTable
            function initLogsDataTable() {
                const logsDataTable = $('#data-table-logs').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    dom: 'lrtip',
                    language: {
                        search: ' ',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: 'Search',
                        info: 'Menampilkan _START_ - _END_ dari _TOTAL_ log',
                        infoEmpty: 'Tidak ada riwayat log',
                        infoFiltered: '(difilter dari _MAX_ total log)',
                        lengthMenu: 'Tampilkan _MENU_ log',
                        paginate: {
                            next: '<i class="ti ti-chevron-right"></i>',
                            previous: '<i class="ti ti-chevron-left"></i>',
                        },
                    },
                    ajax: {
                        url: "{{ route('settings.schedulers.index') }}",
                        data: { type: 'logs' }
                    },
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'px-5 py-2.5 text-gray-500 text-left' },
                        { data: 'task_name_view', name: 'task_name', searchable: true, orderable: true, className: 'px-5 py-2.5 text-left' },
                        { data: 'status_badge', name: 'status', searchable: true, orderable: true, className: 'px-5 py-2.5 text-left' },
                        { data: 'duration_formatted', name: 'duration_seconds', searchable: false, orderable: true, className: 'px-5 py-2.5 text-xs text-gray-600 text-left' },
                        { data: 'executed_at_formatted', name: 'executed_at', searchable: false, orderable: true, className: 'px-5 py-2.5 text-xs text-gray-500 text-left' },
                        { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: 'px-5 py-2.5 text-left' },
                    ],
                    initComplete: function () {
                        if ($('.datatable-length-logs').length) {
                            $('#data-table-logs_wrapper .dt-length').appendTo('.datatable-length-logs');
                        }
                        if ($('.datatable-info-logs').length) {
                            $('#data-table-logs_wrapper .dt-info').appendTo('.datatable-info-logs');
                        }
                        if ($('.datatable-paginate-logs').length) {
                            $('#data-table-logs_wrapper .dt-paging').appendTo('.datatable-paginate-logs');
                        }
                    },
                });

                $('#logs-table-search').on('input', function () {
                    logsDataTable.search(this.value).draw();
                });
            }

            // Preset interval change
            $('#preset-interval-select').on('change', function () {
                const val = $(this).val();
                if (val !== 'custom') {
                    $('#cron-expression-input').val(val);
                }
            });

            // 1. Run Task with SweetAlert
            $(document).on('click', '.btn-run-task', function (e) {
                e.preventDefault();
                const source = $(this).data('source');
                const id = $(this).data('id');
                const name = $(this).data('name');
                const command = $(this).data('command');

                Swal.fire({
                    title: 'Jalankan Task Ini?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Sistem akan segera mengeksekusi task <strong>${name}</strong>.</p>
                            <div class="p-2.5 bg-gray-100 rounded border text-xs font-mono text-primary font-bold">${command}</div>
                            <p class="text-xs text-gray-500">Lanjutkan eksekusi sekarang?</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="ti ti-player-play mr-1"></i> Ya, Jalankan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#input-run-source').val(source);
                        if (source === 'db') {
                            $('#input-run-id').val(id);
                            $('#input-run-index').val('');
                        } else {
                            $('#input-run-index').val(id);
                            $('#input-run-id').val('');
                        }
                        $('#form-run-task').submit();
                    }
                });
            });

            // 2. Edit Task via AJAX and trigger Flowbite modal
            $(document).on('click', '.btnModalEdit, .btn-edit-task', function (e) {
                e.preventDefault();
                const taskId = $(this).data('id');
                const showUrl = "{{ route('settings.schedulers.show', ':id') }}".replace(':id', taskId);
                const updateUrl = "{{ route('settings.schedulers.update', ':id') }}".replace(':id', taskId);

                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    success: function (data) {
                        $('#modalEditLabel').text('Edit Task Scheduler - ' + data.name);
                        $('#form-edit').attr('action', updateUrl);
                        $('#edit-name').val(data.name);
                        $('#edit-command').val(data.command);
                        $('#edit-type').val(data.type ? (data.type.value || data.type) : 'artisan');
                        $('#edit-expression').val(data.expression);
                        $('#edit-description').val(data.description);
                        $('#edit-notification-channel').val(data.notification_channel ? (data.notification_channel.value || data.notification_channel) : 'none');
                        $('#edit-notification-recipient').val(data.notification_recipient);

                        $('#edit-is-active').prop('checked', !!data.is_active);
                        $('#edit-without-overlapping').prop('checked', !!data.without_overlapping);
                        $('#edit-run-in-background').prop('checked', !!data.run_in_background);

                        $('#modalEditToggle').click();
                    },
                    error: function () {
                        Swal.fire('Error', 'Gagal memuat data task scheduler.', 'error');
                    }
                });
            });

            // 3. Delete Task with SweetAlert
            $(document).on('click', '.btn-delete-task', function (e) {
                e.preventDefault();
                const taskId = $(this).data('id');
                const taskName = $(this).data('name');
                const deleteUrl = "{{ route('settings.schedulers.destroy', ':id') }}".replace(':id', taskId);

                Swal.fire({
                    title: 'Hapus Task Scheduler?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Task <strong>${taskName}</strong> akan dihapus dari jadwal sistem.</p>
                            <p class="text-xs text-danger font-semibold">Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-task').attr('action', deleteUrl).submit();
                    }
                });
            });

            // 4. Log Detail Modal
            $(document).on('click', '.btn-log-detail', function (e) {
                e.preventDefault();
                const name = $(this).data('name');
                const command = $(this).data('command');
                const status = $(this).data('status');
                const duration = $(this).data('duration');
                const time = $(this).data('time');
                const output = $(this).data('output');
                const error = $(this).data('error');

                $('#log-modal-name').text(name);
                $('#log-modal-command').text(command);
                $('#log-modal-time').text(time);
                $('#log-modal-status').html(status === 'SUCCESS'
                    ? `<span class="text-success font-bold">SUKSES (${duration})</span>`
                    : `<span class="text-danger font-bold">GAGAL (${duration})</span>`
                );
                $('#log-modal-output').text(output || 'Tidak ada output teks');

                if (error) {
                    $('#log-modal-error').text(error);
                    $('#log-modal-error-wrapper').removeClass('hidden');
                } else {
                    $('#log-modal-error-wrapper').addClass('hidden');
                }

                $('#modalDetailToggle').click();
            });
        });
    </script>
@endpush
