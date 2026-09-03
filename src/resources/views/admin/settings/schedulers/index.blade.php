@extends('layouts.admin.master')

@section('title', 'Scheduler Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('schedulers') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- START: Scheduler Monitoring & Overview Stats --}}
        <div class="card">
            <div class="card-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h4 class="card-title mb-1.25">Status & Manajemen Penjadwalan Tugas (Scheduler)</h4>
                    <p class="text-default-400">Kelola dan pantau tugas terjadwal (cron jobs) berbasis Kernel Laravel dan tugas kustom.</p>
                </div>

                @can('settings-schedulers.create')
                    <div class="flex items-center gap-2">
                        <button type="button"
                            class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3.5 rounded inline-flex items-center gap-1.5 shadow-sm"
                            id="modal-add-toggle"
                            aria-haspopup="dialog"
                            aria-expanded="false"
                            aria-controls="modal-add"
                            data-hs-overlay="#modal-add">
                            <i class="iconify tabler--plus text-base"></i>
                            Tambah Scheduled Task
                        </button>
                    </div>
                @endcan
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Total Tasks --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Total Scheduled Tasks</span>
                            <div class="text-2xl font-bold text-default-800">{{ $stats['total_tasks'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <i class="iconify tabler--clock text-xl"></i>
                        </div>
                    </div>

                    {{-- Kernel Tasks --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">System Kernel Tasks</span>
                            <div class="text-xl font-bold text-default-800">{{ $stats['kernel_tasks_count'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                            <i class="iconify tabler--cpu text-xl"></i>
                        </div>
                    </div>

                    {{-- Custom UI Tasks --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Custom UI Tasks</span>
                            <div class="text-xl font-bold text-default-800">{{ $stats['db_tasks_count'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-info/10 text-info flex items-center justify-center">
                            <i class="iconify tabler--layout-grid text-xl"></i>
                        </div>
                    </div>

                    {{-- Heartbeat / Health Status --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Status Heartbeat Daemon</span>
                            <div>
                                @if ($monitoring['is_healthy'])
                                    <span class="badge bg-success/15 text-success font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--circle-check text-sm"></i> Berjalan Normal
                                    </span>
                                @else
                                    <span class="badge bg-warning/15 text-warning font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--alert-circle text-sm"></i> Menunggu Heartbeat
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full {{ $monitoring['is_healthy'] ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning' }} flex items-center justify-center">
                            <i class="iconify tabler--activity-heartbeat text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Overview Stats --}}

        {{-- START: Tasks & Execution Logs Tabs --}}
        <div class="card">
            <div class="card-header border-b border-default-200 p-0">
                <nav class="flex space-x-2 px-4" aria-label="Tabs" role="tablist">
                    <button type="button"
                        class="hs-tab-active:border-primary hs-tab-active:text-primary active py-3.5 px-3 inline-flex items-center gap-2 border-b-2 border-transparent text-sm font-semibold whitespace-nowrap text-default-500 hover:text-primary"
                        id="tab-tasks-item"
                        data-hs-tab="#tab-tasks"
                        aria-controls="tab-tasks"
                        role="tab">
                        <i class="iconify tabler--calendar-time text-lg"></i>
                        Daftar Scheduled Tasks
                        <span class="badge bg-primary/10 text-primary rounded-full text-xs px-2 py-0.5">{{ $stats['total_tasks'] }}</span>
                    </button>

                    <button type="button"
                        class="hs-tab-active:border-primary hs-tab-active:text-primary py-3.5 px-3 inline-flex items-center gap-2 border-b-2 border-transparent text-sm font-semibold whitespace-nowrap text-default-500 hover:text-primary"
                        id="tab-logs-item"
                        data-hs-tab="#tab-logs"
                        aria-controls="tab-logs"
                        role="tab">
                        <i class="iconify tabler--history text-lg"></i>
                        Riwayat Eksekusi (Execution Logs)
                        @if ($stats['failed_logs_count'] > 0)
                            <span class="badge bg-danger/15 text-danger rounded-full text-xs px-2 py-0.5">{{ $stats['failed_logs_count'] }} Gagal</span>
                        @endif
                    </button>
                </nav>
            </div>

            <div class="card-body">
                {{-- Content Tab 1: Tasks Table --}}
                <div id="tab-tasks" role="tabpanel" aria-labelledby="tab-tasks-item">
                    <div class="table-wrapper -mb-4">
                        <table id="tasks-table" class="table table-striped" style="width:100%">
                            <thead class="text-2xs font-semibold uppercase">
                                <tr>
                                    <th class="text-center" style="width: 5%">No.</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 40%">Nama & Perintah</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 25%">Interval (Cron)</th>
                                    <th class="text-center" style="width: 15%">Status</th>
                                    <th class="text-center" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">
                                    <td colspan="5">
                                        <div class="flex items-center justify-center py-6">
                                            <span class="text-gray-500">Memuat data scheduler...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Content Tab 2: Logs Table --}}
                <div id="tab-logs" class="hidden" role="tabpanel" aria-labelledby="tab-logs-item">
                    <div class="table-wrapper -mb-4">
                        <table id="logs-table" class="table table-striped" style="width:100%">
                            <thead class="text-2xs font-semibold uppercase">
                                <tr>
                                    <th class="text-center" style="width: 5%">No.</th>
                                    <th class="ltr:!text-left rtl:!text-right" style="width: 45%">Nama Task & Perintah</th>
                                    <th class="text-center" style="width: 15%">Status Eksekusi</th>
                                    <th class="text-center" style="width: 12%">Durasi</th>
                                    <th class="text-center" style="width: 15%">Waktu Eksekusi</th>
                                    <th class="text-center" style="width: 8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data-row">
                                    <td colspan="6">
                                        <div class="flex items-center justify-center py-6">
                                            <span class="text-gray-500">Memuat log scheduler...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Tasks & Logs Tabs --}}
    </div>

    {{-- Modals --}}
    @include('admin.settings.schedulers.partials.modal-add')
    @include('admin.settings.schedulers.partials.modal-edit')
    @include('admin.settings.schedulers.partials.modal-log-detail')

    {{-- Hidden Form for Immediate Execution --}}
    <form id="form-run-task" action="{{ route('settings.schedulers.run') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="source" id="input-run-source" value="">
        <input type="hidden" name="task_index" id="input-run-task-index" value="">
        <input type="hidden" name="task_id" id="input-run-task-id" value="">
    </form>

    {{-- Hidden Form for Delete --}}
    <form id="form-delete-task" action="" method="POST" class="hidden">
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
            // 1. Schedulers Table
            var tasksTable = $('#tasks-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ task",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 task",
                    infoFiltered: "(disaring dari total _MAX_ task)",
                    zeroRecords: "Tidak ada scheduled task ditemukan",
                    processing: "Memuat tasks..."
                },
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ route('settings.schedulers.index') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'id',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'task_name_view',
                        name: 'name'
                    },
                    {
                        data: 'interval_view',
                        name: 'expression'
                    },
                    {
                        data: 'status_badge',
                        name: 'is_active',
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

            // 2. Logs Table
            var logsTable = $('#logs-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ log eksekusi",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    zeroRecords: "Tidak ada riwayat eksekusi",
                    processing: "Memuat logs..."
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.schedulers.index') }}",
                    data: { type: 'logs' },
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'id',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'task_name_view',
                        name: 'task_name'
                    },
                    {
                        data: 'status_badge',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'duration_formatted',
                        name: 'duration_seconds',
                        className: 'text-center text-xs'
                    },
                    {
                        data: 'executed_at_formatted',
                        name: 'executed_at',
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

            $('#tab-logs-item').on('click', function() {
                setTimeout(function() {
                    logsTable.columns.adjust().draw();
                }, 150);
            });

            // Preset change helpers
            $('#add_expression_presets').on('change', function() {
                if ($(this).val()) {
                    $('#add_expression').val($(this).val());
                }
            });

            $('#edit_expression_presets').on('change', function() {
                if ($(this).val()) {
                    $('#edit_expression').val($(this).val());
                }
            });

            // Run task immediately
            $(document).on('click', '.btn-run-task', function(e) {
                e.preventDefault();
                const source = $(this).data('source');
                const id = $(this).data('id');
                const name = $(this).data('name');
                const command = $(this).data('command');

                Swal.fire({
                    title: 'Jalankan Task Ini Sekarang?',
                    html: `
                        <div class="text-left space-y-2">
                            <p class="text-sm text-gray-600">Task <strong class="text-gray-800">${name}</strong> akan segera dieksekusi secara manual.</p>
                            <div class="bg-gray-100 p-2 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <code>${command}</code>
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
                        $('#input-run-source').val(source);
                        if (source === 'db') {
                            $('#input-run-task-id').val(id);
                            $('#input-run-task-index').val('');
                        } else {
                            $('#input-run-task-index').val(id);
                            $('#input-run-task-id').val('');
                        }
                        $('#form-run-task').submit();
                    }
                });
            });

            // Edit Task (DB Tasks)
            $(document).on('click', '.btn-edit-task', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const urlShow = "{{ url('settings/schedulers') }}/" + id;
                const urlUpdate = "{{ url('settings/schedulers') }}/" + id;

                $.getJSON(urlShow, function(data) {
                    $('#form-edit-scheduler').attr('action', urlUpdate);
                    $('#edit_name').val(data.name);
                    $('#edit_command').val(data.command);
                    $('#edit_type').val(data.type ? (data.type.value || data.type) : 'artisan');
                    $('#edit_expression').val(data.expression);
                    $('#edit_description').val(data.description || '');

                    $('#edit_is_active').prop('checked', !!data.is_active);
                    $('#edit_without_overlapping').prop('checked', !!data.without_overlapping);
                    $('#edit_run_in_background').prop('checked', !!data.run_in_background);

                    $('#edit_notification_channel').val(data.notification_channel ? (data.notification_channel.value || data.notification_channel) : 'none');
                    $('#edit_notification_recipient').val(data.notification_recipient || '');

                    if (window.HSOverlay) {
                        HSOverlay.open('#modal-edit');
                    }
                }).fail(function() {
                    Swal.fire('Error', 'Gagal memuat data task scheduler.', 'error');
                });
            });

            // Delete Task (DB Tasks)
            $(document).on('click', '.btn-delete-task', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const name = $(this).data('name');
                const urlDelete = "{{ url('settings/schedulers') }}/" + id;

                Swal.fire({
                    title: 'Hapus Task Scheduler?',
                    html: `<p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus task <strong>${name}</strong>? Tindakan ini tidak dapat dibatalkan.</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-task').attr('action', urlDelete);
                        $('#form-delete-task').submit();
                    }
                });
            });

            // View Log Details in Modal
            $(document).on('click', '.btn-log-detail', function(e) {
                e.preventDefault();
                const name = $(this).data('name');
                const command = $(this).data('command');
                const status = $(this).data('status');
                const duration = $(this).data('duration');
                const time = $(this).data('time');
                const output = $(this).data('output') || '';
                const error = $(this).data('error') || '';

                $('#log-task-name').text(name);
                $('#log-command').text(command);
                $('#log-time-duration').text(`${time} (${duration})`);

                if (status === 'SUCCESS' || status === 'success') {
                    $('#log-status-badge').html('<span class="badge bg-success/15 text-success font-semibold text-xs py-1 px-2 rounded-full">Sukses</span>');
                } else {
                    $('#log-status-badge').html('<span class="badge bg-danger/15 text-danger font-semibold text-xs py-1 px-2 rounded-full">Gagal</span>');
                }

                $('#log-output').text(output || '(Tidak ada output yang dihasilkan)');

                if (error && error.trim() !== '') {
                    $('#log-error').text(error);
                    $('#log-error-section').removeClass('hidden');
                } else {
                    $('#log-error-section').addClass('hidden');
                }

                if (window.HSOverlay) {
                    HSOverlay.open('#modal-scheduler-log');
                }
            });
        });
    </script>
@endpush
