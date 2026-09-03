@extends('layouts.admin.master')

@section('title', 'App Logs')

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log') }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    <!-- START: Log Files Data Table -->
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar File Log Aplikasi
                </h5>
            </div>
            <div class="trezo-card-subtitle">
                <span class="text-sm text-gray-500">
                    Total: {{ $logFiles->count() }} File Log
                </span>
            </div>
        </div>

        {{-- START: Data Table --}}
        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Nama File</th>
                            <th class="px-2 py-1 !text-center">Ukuran</th>
                            <th class="px-2 py-1 !text-center">Terakhir Diperbarui</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="5">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Data loading ...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    <!-- END: Log Files Data Table -->

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
            $('#data-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.apps-log.index') }}",
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
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        render: function(data) {
                            return '<div class="flex items-center gap-2 font-mono text-sm font-semibold text-gray-800 dark:text-white"><i class="ti ti-file-text text-primary text-base"></i> ' + data + '</div>';
                        }
                    },
                    {
                        data: 'size',
                        name: 'size',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '15%'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '20%'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '15%'
                    },
                ],
            });
        });
    </script>
@endpush
