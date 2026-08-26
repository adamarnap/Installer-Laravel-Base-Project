@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
<!-- START: Data Table -->
<div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
    <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
        <div class="trezo-card-title">
            <h5 class="mb-0">
                Daftar @yield('title')
            </h5>
        </div>
        {{-- START: Add New Data --}}
        @can('settings-users.create')
            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <div class="trezo-card-dropdown relative">
                    <button class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400" id="dropdownToggleBtn" type="button">
                        <i class="ri-menu-add-line"></i>
                        Add New @yield('title')
                    </button>
                </div>
            </div>
        @endcan
        {{-- END: Add New Data --}}
    </div>
    {{-- START: Data Table --}}
    <div class="trezo-card-content" id="dataTable">
        <div class="table-responsive overflow-x-auto p-2">
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-2 py-1 !text-center">No.</th>
                        <th class="px-2 py-1 !text-center">Nama</th>
                        <th class="px-2 py-1 !text-center">Username</th>
                        <th class="px-2 py-1 !text-center">Email</th>
                        <th class="px-2 py-1 !text-center">Peran</th>
                        <th class="px-2 py-1 !text-center">Status</th>
                        <th class="px-2 py-1 !text-center">Dibuat Pada</th>
                        <th class="px-2 py-1 !text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="6">
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
<!-- END: Data Table -->
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    {{-- Start Implement datatable --}}
    <script>
        // -- Start Load Datatable
        var filter = {
            status: '',
            pilar: '',
            keyword: ''
        }
        loadTable(filter);

        function loadTable(filter) {
            var tbl = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.users.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'username',
                        name: 'username',
                        searchable: true,
                        orderable: true,
                        className: 'text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        className: 'text-center'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        searchable: true,
                        orderable: true,
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: true,
                        orderable: true,
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: true,
                        orderable: true,
                        className: 'text-center'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'text-center'
                    },
                    // etc ...
                ],
            })
        }
        // -- End Load Datatable
    </script>
    {{-- End Implement datatable --}}
@endpush
