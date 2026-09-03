@extends('layouts.admin.master')

@section('title', 'Scheduler Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('schedulers') }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    {{-- Select2 CSS --}}
    <link href="{{ URL::asset('assets/admin/css/select2-4.1.0/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/admin/css/select2-4.1.0/select2-height-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
    {{-- START: Scheduler Overview Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[25px] mb-[25px]">
        {{-- Heartbeat Daemon Monitor --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Scheduler Daemon Heartbeat
                </span>
                <div class="flex items-center gap-2 mt-[4px]">
                    @if (($stats['heartbeat_status'] ?? '') === 'RUNNING')
                        <span class="w-3 h-3 rounded-full bg-success-500 animate-ping"></span>
                        <h5 class="!mb-0 !text-[18px] font-semibold text-success-600">
                            Aktif Berjalan
                        </h5>
                    @else
                        <span class="w-3 h-3 rounded-full bg-orange-500"></span>
                        <h5 class="!mb-0 !text-[18px] font-semibold text-orange-600">
                            Tidak Terdeteksi
                        </h5>
                    @endif
                </div>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        {{ !empty($stats['last_heartbeat']) ? 'Heartbeat: ' . $stats['last_heartbeat'] : 'Daemon belum berjalan' }}
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Cron Worker
                    </span>
                </div>
            </div>
        </div>

        {{-- Total Registered Tasks --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Total Scheduled Tasks
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['total_tasks'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Aktif: <strong class="text-primary-500">{{ $stats['active_tasks'] ?? 0 }}</strong>
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Tasks
                    </span>
                </div>
            </div>
        </div>

        {{-- Tasks by Source --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Sumber Definisi Task
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $stats['db_tasks_count'] ?? 0 }} DB / {{ $stats['kernel_tasks_count'] ?? 0 }} Code
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Database & Kernel
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Registered
                    </span>
                </div>
            </div>
        </div>

        {{-- Failed Logs Count --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Total Eksekusi Gagal (Logs)
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold {{ ($stats['failed_logs_count'] ?? 0) > 0 ? 'text-danger-500' : 'text-gray-800 dark:text-white' }}">
                    {{ $stats['failed_logs_count'] ?? 0 }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Riwayat Log Eksekusi
                    </span>
                    @if (($stats['failed_logs_count'] ?? 0) > 0)
                        <span class="px-[8px] py-[3px] inline-block bg-danger-100 dark:bg-[#15203c] text-danger-600 rounded-sm font-medium text-xs">
                            Ada Error
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                            Normal
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- END: Scheduler Overview Widgets --}}

    {{-- START: Scheduler Main Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                {{-- Tabs Navigation --}}
                <div class="flex items-center gap-2 border-b border-gray-200 dark:border-[#172036]">
                    <button type="button" id="tab-btn-tasks" class="scheduler-tab-btn py-2 px-4 text-sm font-semibold border-b-2 border-primary-500 text-primary-500 transition-all inline-flex items-center gap-1.5">
                        <i class="material-symbols-outlined !text-sm">schedule</i>
                        Scheduled Tasks ({{ $stats['total_tasks'] ?? 0 }})
                    </button>
                    <button type="button" id="tab-btn-logs" class="scheduler-tab-btn py-2 px-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-all inline-flex items-center gap-1.5">
                        <i class="material-symbols-outlined !text-sm">history</i>
                        Riwayat Eksekusi Log
                    </button>
                </div>
            </div>

            @can('settings-schedulers.create')
                <div class="trezo-card-subtitle mt-3 sm:mt-0" id="tasks-actions-header">
                    <button type="button" id="modal-add-toggle" class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium text-xs md:text-sm inline-flex items-center gap-2 shadow-sm">
                        <i class="ri-add-line text-lg leading-none"></i>
                        <span>Tambah Scheduled Task</span>
                    </button>
                </div>
            @endcan
        </div>

        {{-- START: Tasks Table Pane --}}
        <div id="pane-tasks" class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="schedulers-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Nama Task & Perintah</th>
                            <th class="px-2 py-1 !text-center">Jadwal (Cron)</th>
                            <th class="px-2 py-1 !text-center">Next Run Time</th>
                            <th class="px-2 py-1 !text-center">Sumber</th>
                            <th class="px-2 py-1 !text-center">Status Terakhir</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="7">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat task scheduler...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- START: Logs Table Pane --}}
        <div id="pane-logs" class="trezo-card-content hidden">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="scheduler-logs-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Task & Command</th>
                            <th class="px-2 py-1 !text-center">Status</th>
                            <th class="px-2 py-1 !text-center">Durasi Eksekusi</th>
                            <th class="px-2 py-1 !text-center">Waktu Eksekusi</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="6">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat log scheduler...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- END: Scheduler Main Card --}}

    {{-- Partial Modals --}}
    @include('admin.settings.schedulers.partials.modal-add')
    @include('admin.settings.schedulers.partials.modal-edit')

    {{-- Modal Log Output Detail --}}
    <div class="modal-edit z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-log-detail">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[850px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0 text-base">Detail Log Eksekusi Scheduler</h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-log-modal">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-3">
                    <div class="grid grid-cols-2 gap-3 text-xs bg-gray-50 dark:bg-[#15203c] p-3 rounded">
                        <div>Task: <strong id="log-detail-name" class="text-gray-800 dark:text-white">-</strong></div>
                        <div>Status: <span id="log-detail-status">-</span></div>
                        <div>Command: <code id="log-detail-command" class="text-primary-600 dark:text-primary-400">-</code></div>
                        <div>Waktu: <span id="log-detail-time" class="text-gray-600 dark:text-gray-300">-</span> (Durasi: <span id="log-detail-duration">-</span>)</div>
                    </div>

                    <div id="log-error-container" class="hidden">
                        <label class="font-medium text-xs text-danger-600 block mb-1">Error Message:</label>
                        <pre id="log-detail-error" class="p-3 bg-danger-50 dark:bg-danger-900/20 text-danger-600 rounded-md font-mono text-[11px] overflow-x-auto max-h-[150px] whitespace-pre-wrap"></pre>
                    </div>

                    <div>
                        <label class="font-medium text-xs text-gray-700 dark:text-gray-300 block mb-1">Command Output:</label>
                        <pre id="log-detail-output" class="p-3 bg-gray-900 text-gray-100 rounded-md font-mono text-[11px] overflow-x-auto max-h-[220px] whitespace-pre-wrap"></pre>
                    </div>
                </div>

                <div class="trezo-card-footer flex items-center justify-end -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="py-[8px] px-[24px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md text-xs font-medium btn-close-log-modal" type="button">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden form for running task immediately --}}
    <form id="form-run-task" action="{{ route('settings.schedulers.run') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="source" id="input-run-source">
        <input type="hidden" name="identifier" id="input-run-id">
    </form>

    {{-- Hidden form for delete task --}}
    <form id="form-delete-task" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    {{-- Select2 JS --}}
    <script src="{{ URL::asset('assets/admin/js/select2-4.1.0/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Select2 initialization
            $('.select2').select2({
                dropdownParent: $('#modal-add')
            });

            // 1. Tasks DataTable
            var tasksTable = $('#schedulers-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.schedulers.index') }}",
                    type: 'GET',
                    data: { type: 'tasks' }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: '!text-center', width: '5%' },
                    { data: 'task_name_view', name: 'task_name_view', searchable: true, orderable: false, width: '30%' },
                    { data: 'interval_view', name: 'interval_view', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                    { data: 'next_run_at', name: 'next_run_at', searchable: false, orderable: false, className: '!text-center font-mono text-xs', width: '15%' },
                    {
                        data: 'source_badge',
                        name: 'source_badge',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '10%',
                        render: function(data) {
                            return data === 'DATABASE'
                                ? '<span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">Database</span>'
                                : '<span class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-700 rounded-sm font-medium text-xs">Kernel Code</span>';
                        }
                    },
                    { data: 'status_badge', name: 'status_badge', searchable: false, orderable: false, className: '!text-center', width: '12%' },
                    { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: '!text-center', width: '13%' },
                ],
            });

            // 2. Logs DataTable
            var logsTable = null;
            function initLogsTable() {
                if (!logsTable) {
                    logsTable = $('#scheduler-logs-table').DataTable({
                        pageLength: 100,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        processing: true,
                        serverSide: true,
                        language: {
                            url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                        },
                        ajax: {
                            url: "{{ route('settings.schedulers.index') }}",
                            type: 'GET',
                            data: { type: 'logs' }
                        },
                        columns: [
                            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: '!text-center', width: '5%' },
                            { data: 'task_name_view', name: 'task_name_view', searchable: true, orderable: false, width: '40%' },
                            { data: 'status_badge', name: 'status_badge', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                            { data: 'duration_formatted', name: 'duration_formatted', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                            { data: 'executed_at_formatted', name: 'executed_at_formatted', searchable: false, orderable: false, className: '!text-center', width: '15%' },
                            { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: '!text-center', width: '10%' },
                        ],
                    });
                } else {
                    logsTable.ajax.reload();
                }
            }

            // Tab Switching
            $('#tab-btn-tasks').on('click', function() {
                $(this).addClass('border-primary-500 text-primary-500').removeClass('border-transparent text-gray-500');
                $('#tab-btn-logs').removeClass('border-primary-500 text-primary-500').addClass('border-transparent text-gray-500');
                $('#pane-tasks, #tasks-actions-header').removeClass('hidden');
                $('#pane-logs').addClass('hidden');
                tasksTable.ajax.reload();
            });

            $('#tab-btn-logs').on('click', function() {
                $(this).addClass('border-primary-500 text-primary-500').removeClass('border-transparent text-gray-500');
                $('#tab-btn-tasks').removeClass('border-primary-500 text-primary-500').addClass('border-transparent text-gray-500');
                $('#pane-logs').removeClass('hidden');
                $('#pane-tasks, #tasks-actions-header').addClass('hidden');
                initLogsTable();
            });

            // Preset Cron Selectors
            $('#preset-cron-select').on('change', function() {
                if ($(this).val()) {
                    $('#input-expression-add').val($(this).val());
                }
            });

            $('#preset-cron-select-edit').on('change', function() {
                if ($(this).val()) {
                    $('#edit-expression').val($(this).val());
                }
            });

            // Modal Add Toggle
            const modalAdd = document.getElementById('modal-add');
            $(document).on('click', '#modal-add-toggle', function() {
                modalAdd.classList.toggle('active');
            });

            // Modal Edit Logic (AJAX loaded)
            const modalEdit = document.getElementById('modal-edit');

            $(document).on('click', '.btn-edit-task', function() {
                var id = $(this).data('id');
                var editUrl = "{{ url('settings/schedulers') }}/" + id + "/edit";
                var updateUrl = "{{ url('settings/schedulers') }}/" + id;

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    success: function(response) {
                        $('#form-edit-task').attr('action', updateUrl);
                        $('#edit-name').val(response.name);
                        $('#edit-type').val(response.type);
                        $('#edit-command').val(response.command);
                        $('#edit-expression').val(response.expression);
                        $('#edit-description').val(response.description);
                        $('#edit-is-active').prop('checked', response.is_active == 1);
                        $('#edit-without-overlapping').prop('checked', response.without_overlapping == 1);
                        $('#edit-run-in-background').prop('checked', response.run_in_background == 1);
                        $('#edit-notification-channel').val(response.notification_channel || 'none');
                        $('#edit-notification-recipient').val(response.notification_recipient);

                        modalEdit.classList.add('active');
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal memuat data task scheduler.', 'error');
                    }
                });
            });

            $('.btn-modal-edit-close').on('click', function() {
                modalEdit.classList.remove('active');
            });

            // Delete Task
            $(document).on('click', '.btn-delete-task', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var deleteUrl = "{{ url('settings/schedulers') }}/" + id;

                Swal.fire({
                    title: 'Hapus Task Scheduler?',
                    text: `Task "${name}" akan dihapus permanen dari jadwal database.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-task').attr('action', deleteUrl).submit();
                    }
                });
            });

            // Run Task Immediate Confirmation
            $(document).on('click', '.btn-run-task', function() {
                var source = $(this).data('source');
                var id = $(this).data('id');
                var name = $(this).data('name');
                var command = $(this).data('command');

                Swal.fire({
                    title: 'Jalankan Task Scheduler Sekarang?',
                    html: `
                        <div class="text-left text-xs space-y-2 leading-relaxed">
                            <p class="text-gray-600 dark:text-gray-300">Task: <strong>${name}</strong></p>
                            <div class="p-2.5 bg-gray-100 dark:bg-gray-800 rounded font-mono text-xs text-primary-600 dark:text-primary-400">
                                <code>${command}</code>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#605DFF',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Jalankan Sekarang!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#input-run-source').val(source);
                        $('#input-run-id').val(id);
                        $('#form-run-task').submit();
                    }
                });
            });

            // Log detail modal
            const logModal = document.getElementById('modal-log-detail');

            $(document).on('click', '.btn-log-detail', function() {
                var name = $(this).data('name');
                var command = $(this).data('command');
                var status = $(this).data('status');
                var duration = $(this).data('duration');
                var time = $(this).data('time');
                var output = $(this).data('output');
                var error = $(this).data('error');

                $('#log-detail-name').text(name);
                $('#log-detail-command').text(command);
                $('#log-detail-status').html(status === 'SUCCESS' ? '<span class="text-success-600 font-semibold">Sukses</span>' : '<span class="text-danger-600 font-semibold">Gagal</span>');
                $('#log-detail-duration').text(duration);
                $('#log-detail-time').text(time);
                $('#log-detail-output').text(output || '(Tidak ada output)');

                if (error) {
                    $('#log-error-container').removeClass('hidden');
                    $('#log-detail-error').text(error);
                } else {
                    $('#log-error-container').addClass('hidden');
                }

                logModal.classList.add('active');
            });

            $('.btn-close-log-modal').on('click', function() {
                logModal.classList.remove('active');
            });
        });
    </script>
@endpush
