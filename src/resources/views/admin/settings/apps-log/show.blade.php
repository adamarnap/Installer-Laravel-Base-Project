@extends('layouts.admin.master')

@section('title', 'Detail Log: ' . $filename)

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log.show', $filename) }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Metadata Card -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-5">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-primary-50 text-primary flex items-center justify-center text-2xl">
                    <i class="ti ti-file-code"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-800">{{ $filename }}</h4>
                    <div class="flex items-center gap-4 text-xs text-gray-500 mt-1">
                        <span><i class="ti ti-database mr-1"></i> Ukuran: <strong>{{ $logDetail['file_size'] }}</strong></span>
                        <span><i class="ti ti-calendar mr-1"></i> Terakhir Diperbarui: <strong>{{ $logDetail['updated_at'] }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('settings.apps-log.index') }}" class="btn bg-white border border-borderColor text-gray-700 hover:bg-gray-100 py-2 px-4 rounded text-sm inline-flex items-center gap-1.5">
                    <i class="ti ti-arrow-left"></i> Kembali ke Daftar Log
                </a>
            </div>
        </div>
    </div>
    <!-- END: Metadata Card -->

    <!-- START: Log Entries Card -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="card-header py-4 px-5 border-b border-borderColor">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" id="log-entry-search" placeholder="Cari pesan log..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary"/>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="level-filter" class="text-xs font-semibold text-gray-600">Level:</label>
                        <select id="level-filter" class="border border-borderColor rounded-md py-2 px-3 text-sm focus:outline-none focus:outline-primary bg-white">
                            <option value="ALL">Semua Level</option>
                            <option value="EMERGENCY">EMERGENCY</option>
                            <option value="ALERT">ALERT</option>
                            <option value="CRITICAL">CRITICAL</option>
                            <option value="ERROR">ERROR</option>
                            <option value="WARNING">WARNING</option>
                            <option value="NOTICE">NOTICE</option>
                            <option value="INFO">INFO</option>
                            <option value="DEBUG">DEBUG</option>
                        </select>
                    </div>
                </div>

                <div class="text-xs text-gray-500">
                    <i class="ti ti-info-circle mr-1"></i> Menampilkan hingga 500 baris event terbaru (Default 100 per halaman).
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-log-entries">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Waktu Kejadian</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Level</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Env</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Pesan Log</th>
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
    <!-- END: Log Entries Card -->
</div>

@include('admin.settings.apps-log.partials.modal-detail')
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            const dataTable = $('#data-table-log-entries').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ event log',
                    infoEmpty: 'Tidak ada event log yang sesuai',
                    infoFiltered: '(difilter dari _MAX_ total log)',
                    lengthMenu: 'Tampilkan _MENU_ log',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.apps-log.show', $filename) }}",
                    type: 'GET',
                    data: function (d) {
                        d.level = $('#level-filter').val();
                    }
                },
                pageLength: 100,
                lengthMenu: [25, 50, 100, 250, 500],
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'datetime',
                        name: 'datetime',
                        searchable: true,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-600 text-xs text-left whitespace-nowrap'
                    },
                    {
                        data: 'level_badge',
                        name: 'level',
                        searchable: true,
                        orderable: false,
                        className: 'px-5 py-2.5 text-left'
                    },
                    {
                        data: 'environment',
                        name: 'environment',
                        searchable: true,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-xs text-left uppercase'
                    },
                    {
                        data: 'message_view',
                        name: 'message',
                        searchable: true,
                        orderable: false,
                        className: 'px-5 py-2.5 text-left max-w-md'
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

            $('#log-entry-search').on('input', function () {
                dataTable.search(this.value).draw();
            });

            $('#level-filter').on('change', function () {
                dataTable.draw();
            });

            // Detail Modal Action
            let currentLogData = {};

            $(document).on('click', '.btn-log-detail', function (e) {
                e.preventDefault();
                let rawLog = $(this).attr('data-log') || $(this).data('log');
                if (typeof rawLog === 'string') {
                    try {
                        currentLogData = JSON.parse(rawLog);
                    } catch (err) {
                        currentLogData = {
                            datetime: $(this).data('datetime') || '-',
                            level: $(this).data('level') || 'INFO',
                            environment: $(this).data('env') || 'local',
                            message: $(this).data('message') || '',
                            stacktrace: $(this).data('stacktrace') || ''
                        };
                    }
                } else if (typeof rawLog === 'object' && rawLog !== null) {
                    currentLogData = rawLog;
                } else {
                    currentLogData = {
                        datetime: $(this).data('datetime') || '-',
                        level: $(this).data('level') || 'INFO',
                        environment: $(this).data('env') || 'local',
                        message: $(this).data('message') || '',
                        stacktrace: $(this).data('stacktrace') || ''
                    };
                }

                const level = (currentLogData.level || 'INFO').toUpperCase();
                let badgeClass = 'bg-secondary/10 text-secondary border-secondary/20';
                if (['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR'].includes(level)) {
                    badgeClass = 'bg-danger/10 text-danger border-danger/20';
                } else if (level === 'WARNING') {
                    badgeClass = 'bg-warning/10 text-warning border-warning/20';
                } else if (['NOTICE', 'INFO'].includes(level)) {
                    badgeClass = 'bg-info/10 text-info border-info/20';
                } else if (level === 'DEBUG') {
                    badgeClass = 'bg-gray-100 text-gray-700 border-gray-200';
                }

                $('#modal-level-badge').html('<span class="inline-flex items-center py-0.5 px-2.5 rounded-full text-xs font-semibold border ' + badgeClass + '">' + level + '</span>');
                $('#modal-timestamp').text(currentLogData.datetime || '-');
                $('#modal-env').text((currentLogData.environment || 'local') + ' • ' + level);
                $('#modal-message').text(currentLogData.message || '-');

                if (currentLogData.stacktrace && currentLogData.stacktrace.trim() !== '') {
                    $('#modal-stacktrace').text(currentLogData.stacktrace).removeClass('hidden');
                    $('#modal-no-stacktrace').addClass('hidden');
                    $('#btn-copy-stacktrace').removeClass('hidden');
                } else {
                    $('#modal-stacktrace').text('').addClass('hidden');
                    $('#modal-no-stacktrace').removeClass('hidden');
                    $('#btn-copy-stacktrace').addClass('hidden');
                }

                $('#modalDetailToggle').click();
            });

            // Helper function to copy text to clipboard
            function copyToClipboard(text, $btn, successText) {
                if (!navigator.clipboard) {
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                } else {
                    navigator.clipboard.writeText(text);
                }

                const originalHtml = $btn.html();
                $btn.html('<i class="ti ti-check text-success"></i> ' + successText);
                setTimeout(function () {
                    $btn.html(originalHtml);
                }, 2000);
            }

            $('#btn-copy-message').on('click', function () {
                if (currentLogData.message) {
                    copyToClipboard(currentLogData.message, $(this), 'Tersalin!');
                }
            });

            $('#btn-copy-stacktrace').on('click', function () {
                if (currentLogData.stacktrace) {
                    copyToClipboard(currentLogData.stacktrace, $(this), 'Tersalin!');
                }
            });

            $('#btn-copy-all-log').on('click', function () {
                const fullText = `[${currentLogData.datetime || '-'}] ${currentLogData.environment || 'local'}.${currentLogData.level || 'INFO'}: ${currentLogData.message || ''}` +
                    (currentLogData.stacktrace ? `\n\nStack Trace:\n${currentLogData.stacktrace}` : '');
                copyToClipboard(fullText, $(this), 'Seluruh Log Tersalin!');
            });
        });
    </script>
@endpush
