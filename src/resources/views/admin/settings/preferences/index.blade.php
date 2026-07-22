@extends('layouts.admin.master')

@section('title', 'Preferensi')

@section('breadcrumb')
    {{ Breadcrumbs::render('preferences') }}
@endsection

@section('content')
    <div class="card border bg-white rounded">
        <div class="card-header py-4 px-5">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none"><i class="ti ti-search"></i></span>
                    <input type="text" id="preference-table-search" placeholder="Search"
                        class="pl-8 pr-4 py-2 border outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border" id="data-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Key</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Grup</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Nilai</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($preferences as $preference)
                            <tr>
                                <td class="px-5 py-2.5 text-gray-500">{{ $preference->name ?? '-' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $preference->group ?? '-' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $preference->value ?? '-' }}</td>
                                <td class="px-5 py-2.5">
                                    @can('settings-preferences.update')
                                        <button type="button" title="Edit preferensi" class="btnModalEdit w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-warning hover:bg-light-900 hover:text-primary cursor-pointer"
                                            data-url-action="{{ route('settings.preferences.update', $preference->id) }}"
                                            data-url-get="{{ route('settings.preferences.edit', $preference->id) }}">
                                            <i class="ti ti-edit text-[16px]"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
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

    @can('settings-preferences.update')
        @include('admin.settings.preferences.partials.modal-edit')
    @endcan
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    <script>
        $(document).ready(function () {
            const table = $('#data-table').DataTable({
                searching: true,
                dom: 'lrtip',
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                columnDefs: [{ targets: 3, orderable: false }],
                language: {
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    emptyTable: 'Tidak ada preferensi ditemukan',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: { next: '<i class="ti ti-chevron-right"></i>', previous: '<i class="ti ti-chevron-left"></i>' }
                },
                initComplete: function () {
                    $('.dt-length').appendTo('.datatable-length');
                    $('.dt-info').appendTo('.datatable-info');
                    $('.dt-paging').appendTo('.datatable-paginate');
                }
            });

            $('#preference-table-search').on('input', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
