@extends('layouts.admin.master')

@section('title', 'Impersonate')

@section('breadcrumb')
    {{ Breadcrumbs::render('impersonate') }}
@endsection

@section('content')
    <div class="card border bg-white rounded">
        <div class="card-header py-4 px-5">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="impersonate-table-search" placeholder="Search"
                        class="pl-8 pr-4 py-2 border outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border" id="data-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Nama</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Email</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Peran</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor"></tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div class="w-full md:w-1/2"><div class="datatable-length"></div></div>
                <div class="w-full md:w-1/2 text-center"><div class="datatable-info text-sm text-gray-500"></div></div>
                <div class="w-full md:w-1/2 mt-4 md:mt-0 text-end"><div class="datatable-paginate"></div></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    <script>
        $(document).ready(function () {
            const table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>'
                    }
                },
                ajax: {
                    url: "{{ route('settings.impersonate.index') }}",
                    type: 'GET'
                },
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'name', name: 'name', className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'email', name: 'email', className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'role', name: 'role', className: 'px-5 py-2.5 text-gray-500 text-left' },
                    { data: 'aksi', name: 'aksi', searchable: false, orderable: false, className: 'px-5 py-2.5' }
                ],
                initComplete: function () {
                    $('.dt-length').appendTo('.datatable-length');
                    $('.dt-info').appendTo('.datatable-info');
                    $('.dt-paging').appendTo('.datatable-paginate');
                }
            });

            $('#impersonate-table-search').on('input', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
