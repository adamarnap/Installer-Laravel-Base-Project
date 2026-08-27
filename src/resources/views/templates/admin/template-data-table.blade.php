@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
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
                        <a href="add-product.html" class="flex items-center gap-1 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">
                            <i class="ti ti-circle-plus"></i>Add Product
                        </a>
                    </div>
                    {{-- End: Custom Button --}}

                    {{-- Start: Custom Filter --}}
                    <div>
                        <a href="javascript:void(0);" class="border border-borderColor rounded py-2 px-3 bg-white inline-flex items-center text-[13px] font-semibold focus:bg-primary focus:border-primary focus:text-white text-gray-900" data-dropdown-toggle="call-duration">
                            Brand<i class="ti ti-chevron-down ml-1"></i>
                        </a>
                        <ul id="call-duration" class="hidden p-2 z-[1] border border-borderColor rounded bg-white shadow-lg w-[150px]">
                            <li>
                                <a href="javascript:void(0);" class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Lenovo</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Beats</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Nike</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Apple</a>
                            </li>
                        </ul>
                    </div>
                    {{-- End: Custom Filter --}}
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive  custom-table">
                <table class="table table-nowrap border w-full border" id="data-table">
                    <thead class="bg-light">
                        <tr >
                            {{-- Start : Checkbox --}}
                            <th class="text-left no-sort text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b hover:outline-none">
                                <div class="flex items-center">
                                    <input type="checkbox" id="select-all" class="w-4 h-4 bg-white border rounded text-primary focus:ring-0 focus:outline-none"/>
                                </div>
                            </th>
                            {{-- End : Checkbox --}}
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
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    {{-- Start: Implement serverside datatable --}}
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
                        className: 'action-icon inline-flex gap-2 items-center  '
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
    {{-- End: Implement serverside datatable --}}
@endpush

{{-- Start : Contoh td yang digunakan di server side (Hanya sebagai referensi di serverside, jika diperlukan) --}}

{{-- Start: Input Checkbox in table --}}
<div class="flex items-center">
    <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0" type="checkbox">
</div>
{{-- End: Input Checkbox in table --}}

{{-- Start: Image in table --}}
<div class="flex items-center">
    <a href="#" class="avatar size-8" data-bs-toggle="modal" data-bs-target="#view_details">
        <img src="assets/img/products/stock-img-01.png" class="rounded size-8 img-fluid" alt="img">
    </a>
    <div class="ms-2">
        <p class="text-dark font-medium mb-0"><a class="hover:text-primary" href="#" data-bs-toggle="modal"  data-bs-target="#view_details">Lenovo IdeaPad 3</a></p>
    </div>
</div>
{{-- End: Image in table --}}

{{-- End : Contoh td yang digunakan di server side (Hanya sebagai referensi di serverside, jika diperlukan) --}}