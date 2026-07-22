@extends('layouts.admin.master')

@section('title', 'Pengguna')

@section('breadcrumb')
    {{ Breadcrumbs::render('users') }}
@endsection

@push('styles')
@endpush

@section('content')
<!-- START: Data Table -->
    <div class="card border bg-white rounded">
        <div class="card-header py-4 px-5">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="user-table-search" placeholder="Search" class="pl-8 pr-4 py-2 border outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary"/>
                </div>
                <div class="flex items-center gap-2">
                    {{-- Start: Custom Button --}}
                    <div>
                        <button type="button" class="flex items-center gap-1 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white"
                            data-modal-toggle="modalAdd" data-modal-target="modalAdd">
                            <i class="ti ti-circle-plus"></i>Tambah @yield('title')
                        </button>
                    </div>
                    {{-- End: Custom Button --}}
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive  custom-table">
                <table class="table table-nowrap border w-full border" id="data-table">
                    <thead class="bg-light">
                        <tr >
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Nama</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Email</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Peran</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Status</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Dibuat Pada</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody  class="bg-white divide-y divide-borderColor">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
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
<!-- END: Data Table -->

{{-- Start: Modal Add --}}
@include('admin.settings.user.partials.modal-add')
{{-- End: Modal Add --}}

{{-- Start: Modal Edit --}}
@include('admin.settings.user.partials.modal-edit')
{{-- End: Modal Edit --}}
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: '- Select This Choice -',
                allowClear: true
            });
        });
    </script>
    {{-- End: Select 2 For Modal Add --}}

    {{-- Start: Select2 for Modal Edit --}}
    <script>
        $(document).ready(function() {
            $('#roles').select2({
                width: '100%',
                placeholder: '- Select This Choice -',
                allowClear: true,
            });
        });
    </script>
    {{-- End: Select2 for Modal Edit --}}
    {{-- End: Select 2 --}}

    {{-- Start: Implement datatable --}}
    <script>
        $(document).ready(function () {
            var tbl = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.users.index') }}",
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
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-gray-500 text-left'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: ''
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

            $('#user-table-search').on('input', function () {
                tbl.search(this.value).draw();
            });
        });
    </script>
    {{-- End: Implement datatable --}}
@endpush
