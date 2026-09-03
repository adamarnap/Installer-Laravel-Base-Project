@extends('layouts.admin.master')

@section('title', 'Detail Log: ' . $filename)

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log.show', $filename) }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    {{-- START: Log Detail Overview Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('settings.apps-log.index') }}" class="inline-flex items-center justify-center w-[36px] h-[36px] rounded-md border border-gray-200 dark:border-[#172036] text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#15203c] transition-all shadow-sm" title="Kembali ke daftar log">
                        <i class="ti ti-arrow-left text-base"></i>
                    </a>
                    <h5 class="mb-0 font-mono text-base md:text-lg">
                        {{ $filename }}
                    </h5>
                </div>
                <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-gray-500">
                    <span>Ukuran: <strong class="text-gray-800 dark:text-white">{{ $logDetail['file_size'] ?? '0 B' }}</strong></span>
                    <span>•</span>
                    <span>Terakhir Diperbarui: <strong class="text-gray-800 dark:text-white">{{ $logDetail['updated_at'] ?? '-' }}</strong></span>
                </div>
            </div>

            <div class="mt-3 sm:mt-0 flex items-center gap-2">
                @can('settings-apps-log.delete')
                    <button type="button" title="Hapus file log ini" id="btn-delete"
                        data-id="{{ $filename }}" data-url-action="{{ route('settings.apps-log.destroy', $filename) }}"
                        class="trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[20px] bg-danger-500 text-white hover:bg-danger-400 transition-all rounded-md border border-danger-500 hover:border-danger-400 font-medium text-xs md:text-sm inline-flex items-center gap-2 shadow-sm">
                        <i class="ti ti-trash text-base"></i>
                        <span>Hapus Log</span>
                    </button>
                @endcan
            </div>
        </div>

        {{-- START: Filter by Level --}}
        <div class="mb-[20px] p-[15px] bg-gray-50 dark:bg-[#15203c] rounded-md flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Filter Level Log:</label>
                <select id="filter-level" class="h-[36px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[10px] text-xs outline-0 cursor-pointer">
                    <option value="">Semua Level (ALL)</option>
                    <option value="ERROR">ERROR</option>
                    <option value="WARNING">WARNING</option>
                    <option value="INFO">INFO</option>
                    <option value="DEBUG">DEBUG</option>
                    <option value="CRITICAL">CRITICAL</option>
                    <option value="ALERT">ALERT</option>
                    <option value="EMERGENCY">EMERGENCY</option>
                </select>
            </div>
            <div class="text-xs text-gray-500">
                Menampilkan maksimal 500 entri log terbaru (urutan waktu terkini di atas)
            </div>
        </div>
        {{-- END: Filter by Level --}}

        {{-- START: Data Table --}}
        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="log-entries-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 !text-center">Waktu</th>
                            <th class="px-2 py-1 !text-center">Level</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Pesan Log</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="5">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat entri log...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    {{-- END: Log Detail Overview Card --}}

    {{-- START: Modal Stacktrace Detail --}}
    <button id="modal-log-toggle" type="button" class="hidden"></button>
    <div class="modal-edit z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-log-detail">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[900px] lg:max-w-[1000px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0 text-base" id="modal-entry-title">
                            Detail Log Entry
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500" id="btn-close-log-modal">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-3 bg-gray-50 dark:bg-[#15203c] rounded-md text-xs">
                        <div>
                            <span class="text-gray-500 block">Waktu:</span>
                            <strong id="modal-log-datetime" class="font-mono text-gray-800 dark:text-white">-</strong>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Environment:</span>
                            <strong id="modal-log-env" class="font-mono text-gray-800 dark:text-white">-</strong>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Level:</span>
                            <strong id="modal-log-level" class="font-mono">-</strong>
                        </div>
                    </div>

                    <div>
                        <label class="font-medium text-xs text-gray-700 dark:text-gray-300 block mb-1">Pesan Utama:</label>
                        <div id="modal-log-message" class="p-3 bg-gray-100 dark:bg-[#172036] rounded-md font-mono text-xs text-gray-900 dark:text-gray-100 break-all max-h-[150px] overflow-y-auto"></div>
                    </div>

                    <div id="modal-stacktrace-wrapper">
                        <label class="font-medium text-xs text-gray-700 dark:text-gray-300 block mb-1">Stack Trace:</label>
                        <pre id="modal-log-stacktrace" class="p-3 bg-gray-900 text-gray-100 rounded-md font-mono text-[11px] overflow-x-auto max-h-[350px] leading-relaxed whitespace-pre-wrap"></pre>
                    </div>
                </div>

                <div class="trezo-card-footer flex items-center justify-end -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="py-[8px] px-[24px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md text-xs font-medium" type="button" id="btn-close-log-modal-footer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Modal Stacktrace Detail --}}

    {{-- START: Form Delete --}}
    @can('settings-apps-log.delete')
        <form action="" id="form-delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endcan
    {{-- END: Form Delete --}}
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#log-entries-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.apps-log.show', $filename) }}",
                    type: 'GET',
                    data: function(d) {
                        d.level = $('#filter-level').val();
                    }
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
                        data: 'datetime',
                        name: 'datetime',
                        searchable: false,
                        orderable: false,
                        className: '!text-center font-mono text-xs',
                        width: '18%'
                    },
                    {
                        data: 'level_badge',
                        name: 'level_badge',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '12%'
                    },
                    {
                        data: 'message_view',
                        name: 'message_view',
                        searchable: false,
                        orderable: false,
                        width: '55%'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '10%'
                    },
                ],
            });

            $('#filter-level').on('change', function() {
                table.ajax.reload();
            });

            // Modal detail handler
            const modalEl = document.getElementById('modal-log-detail');

            $(document).on('click', '.btn-log-detail', function() {
                var datetime = $(this).data('datetime');
                var level = $(this).data('level');
                var env = $(this).data('env');
                var message = $(this).data('message');
                var stacktrace = $(this).data('stacktrace');

                $('#modal-log-datetime').text(datetime);
                $('#modal-log-env').text(env);
                $('#modal-log-level').text(level);
                $('#modal-log-message').text(message);

                if (stacktrace && stacktrace.trim() !== '') {
                    $('#modal-log-stacktrace').text(stacktrace);
                    $('#modal-stacktrace-wrapper').show();
                } else {
                    $('#modal-stacktrace-wrapper').hide();
                }

                modalEl.classList.add('active');
            });

            $('#btn-close-log-modal, #btn-close-log-modal-footer').on('click', function() {
                modalEl.classList.remove('active');
            });
        });
    </script>
@endpush
