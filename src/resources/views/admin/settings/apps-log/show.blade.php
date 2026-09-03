@extends('layouts.admin.master')

@section('title', 'Detail Log: ' . $filename)

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log.show', $filename) }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- Metadata & Actions Header --}}
        <div class="card">
            <div class="card-header flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <i class="iconify tabler--file-code text-primary text-xl"></i>
                        <h4 class="card-title font-mono">{{ $filename }}</h4>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-default-500">
                        <span><strong class="text-default-700">Ukuran:</strong> {{ $logDetail['file_size'] }}</span>
                        <span>&bull;</span>
                        <span><strong class="text-default-700">Terakhir Diperbarui:</strong> {{ $logDetail['updated_at'] }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('settings.apps-log.index') }}" class="btn border border-default-300 hover:bg-default-100 text-default-700 text-xs py-2 px-3 rounded inline-flex items-center gap-1.5">
                        <i class="iconify tabler--arrow-left text-sm"></i>
                        Kembali ke Daftar
                    </a>

                    @can('settings-apps-log.delete')
                        <button type="button" id="btn-delete-file" class="btn bg-danger hover:bg-danger-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5">
                            <i class="iconify tabler--trash text-sm"></i>
                            Hapus File Log
                        </button>
                    @endcan
                </div>
            </div>

            <div class="card-body">
                {{-- Filter by Level --}}
                <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-default-50/70 p-3 rounded-lg border border-default-200">
                    <div class="flex items-center gap-2">
                        <i class="iconify tabler--filter text-default-500"></i>
                        <span class="text-xs font-semibold text-default-700 uppercase">Filter Level Log:</span>
                    </div>
                    <div class="w-full sm:w-64">
                        <select id="level-filter" class="form-select text-xs py-1.5">
                            <option value="ALL" selected>Semua Level (All)</option>
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

                {{-- Table of Log Entries --}}
                <div class="table-wrapper -mb-4">
                    <table id="log-entries-table" class="table table-striped" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center" style="width: 5%">No.</th>
                                <th class="text-center" style="width: 15%">Waktu</th>
                                <th class="text-center" style="width: 10%">Level</th>
                                <th class="ltr:!text-left rtl:!text-right">Pesan Log</th>
                                <th class="text-center" style="width: 8%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="5">
                                    <div class="flex items-center justify-center py-6">
                                        <span class="text-gray-500">Memuat entri log...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- START: Log Detail Modal --}}
    <div id="modal-log-detail" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-log-title">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all max-w-4xl w-full m-3 sm:mx-auto">
            <div class="flex flex-col bg-white border border-default-200 shadow-sm rounded-xl pointer-events-auto dark:bg-default-800 dark:border-default-700">
                <div class="flex justify-between items-center py-3 px-4 border-b border-default-200 dark:border-default-700">
                    <div class="flex items-center gap-2">
                        <i class="iconify tabler--file-search text-primary text-xl"></i>
                        <h3 id="modal-log-title" class="font-bold text-default-800 dark:text-white">
                            Detail Entri Log
                        </h3>
                    </div>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-default-100 text-default-800 hover:bg-default-200 focus:outline-none focus:bg-default-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-default-700 dark:hover:bg-default-600 dark:text-default-400" data-hs-overlay="#modal-log-detail">
                        <span class="sr-only">Close</span>
                        <i class="iconify tabler--x text-base"></i>
                    </button>
                </div>

                <div class="p-4 overflow-y-auto max-h-[75vh] space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 bg-default-50 p-3 rounded-lg border border-default-200 dark:bg-default-900/50">
                        <div>
                            <span class="text-2xs text-default-500 font-semibold uppercase block">Waktu Pencatatan</span>
                            <span id="detail-datetime" class="font-mono text-xs font-bold text-default-800"></span>
                        </div>
                        <div>
                            <span class="text-2xs text-default-500 font-semibold uppercase block">Lingkungan (Env)</span>
                            <span id="detail-env" class="font-mono text-xs font-bold text-default-800"></span>
                        </div>
                        <div>
                            <span class="text-2xs text-default-500 font-semibold uppercase block">Level</span>
                            <span id="detail-level-badge"></span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label font-bold text-xs uppercase text-default-700">Pesan Log:</label>
                        <div id="detail-message" class="bg-default-100 p-3 rounded text-xs font-mono text-default-900 break-words border border-default-200 max-h-40 overflow-y-auto"></div>
                    </div>

                    <div id="detail-stacktrace-wrapper">
                        <label class="form-label font-bold text-xs uppercase text-default-700">Stack Trace / Payload:</label>
                        <pre id="detail-stacktrace" class="bg-slate-900 text-slate-100 p-3 rounded text-xs font-mono break-all whitespace-pre-wrap max-h-80 overflow-y-auto border border-slate-800"></pre>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200 dark:border-default-700">
                    <button type="button" class="btn border border-default-300 hover:bg-default-100 text-default-700 text-xs py-2 px-4 rounded inline-flex items-center gap-1" data-hs-overlay="#modal-log-detail">
                        <i class="iconify tabler--x text-sm"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Log Detail Modal --}}

    {{-- Form Delete --}}
    <form id="form-delete" action="{{ route('settings.apps-log.destroy', $filename) }}" method="POST" class="hidden">
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
            var table = $('#log-entries-table').DataTable({
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
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    zeroRecords: "Tidak ada entri log yang cocok",
                    processing: "Memproses log..."
                },
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ route('settings.apps-log.show', $filename) }}",
                    type: 'GET',
                    data: function(d) {
                        d.level = $('#level-filter').val();
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'datetime',
                        name: 'datetime',
                        className: 'text-center font-mono text-xs'
                    },
                    {
                        data: 'level_badge',
                        name: 'level_badge',
                        className: 'text-center'
                    },
                    {
                        data: 'message_view',
                        name: 'message_view'
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

            // Filter on level change
            $('#level-filter').on('change', function() {
                table.ajax.reload();
            });

            // View Log Details in Modal
            $(document).on('click', '.btn-log-detail', function(e) {
                e.preventDefault();
                const logDataStr = $(this).attr('data-log');
                if (!logDataStr) return;

                const log = JSON.parse(logDataStr);
                $('#detail-datetime').text(log.datetime || '-');
                $('#detail-env').text(log.environment || '-');
                
                const level = (log.level || '').toUpperCase();
                let badgeColor = 'bg-secondary/15 text-secondary';
                if (['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR'].includes(level)) {
                    badgeColor = 'bg-danger/15 text-danger';
                } else if (level === 'WARNING') {
                    badgeColor = 'bg-warning/15 text-warning';
                } else if (['NOTICE', 'INFO'].includes(level)) {
                    badgeColor = 'bg-info/15 text-info';
                }
                $('#detail-level-badge').html(`<span class="badge ${badgeColor} font-semibold text-xs py-1 px-2.5 rounded-full">${level}</span>`);

                $('#detail-message').text(log.message || '-');

                if (log.stacktrace && log.stacktrace.trim() !== '') {
                    $('#detail-stacktrace').text(log.stacktrace);
                    $('#detail-stacktrace-wrapper').show();
                } else {
                    $('#detail-stacktrace-wrapper').hide();
                }

                if (window.HSOverlay) {
                    HSOverlay.open('#modal-log-detail');
                }
            });

            // Delete File Confirmation
            $('#btn-delete-file').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus File Log Ini?',
                    html: `<p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus file log <strong>{{ $filename }}</strong> secara permanen?</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Hapus File!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete').submit();
                    }
                });
            });
        });
    </script>
@endpush
