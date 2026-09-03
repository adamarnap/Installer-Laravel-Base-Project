@extends('layouts.admin.master')

@section('title', 'App Logs')

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log') }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Data Table Card -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="card-header py-4 px-5 border-b border-borderColor">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="log-table-search" placeholder="Cari file log..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary"/>
                </div>
                <div class="text-xs text-gray-500">
                    <i class="ti ti-folder mr-1"></i> Direktori: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-700">storage/logs/</code>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama File Log</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Ukuran File</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Terakhir Diperbarui</th>
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
    <!-- END: Data Table Card -->
</div>

{{-- Hidden form for delete action with SweetAlert --}}
<form id="form-delete" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            const dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada file log yang ditemukan',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.apps-log.index') }}",
                    type: 'GET',
                },
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-gray-800 font-semibold text-left',
                        render: function (data, type, row) {
                            return '<div class="flex items-center gap-2"><i class="ti ti-file-text text-primary text-lg"></i><span>' + data + '</span></div>';
                        }
                    },
                    {
                        data: 'size',
                        name: 'size',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-600 text-left'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
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

            $('#log-table-search').on('input', function () {
                dataTable.search(this.value).draw();
            });
        });
    </script>
@endpush
