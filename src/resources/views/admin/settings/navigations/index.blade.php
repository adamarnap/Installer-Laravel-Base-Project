@extends('layouts.admin.master')

@section('title', 'Menu')

@section('breadcrumb')
    {{ Breadcrumbs::render('navigations') }}
@endsection

@section('content')
    @php
        $menuRows = collect();
        foreach ($navigations as $navigation) {
            $menuRows->push(['menu' => $navigation, 'level' => 0]);
            foreach ($navigation->child as $child) {
                $menuRows->push(['menu' => $child, 'level' => 1]);
                foreach ($child->subChild as $subChild) {
                    $menuRows->push(['menu' => $subChild, 'level' => 2]);
                }
            }
        }
    @endphp

    <div class="card border bg-white rounded">
        <div class="card-header py-4 px-5">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none"><i class="ti ti-search"></i></span>
                    <input type="text" id="navigation-table-search" placeholder="Search"
                        class="pl-8 pr-4 py-2 border outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary">
                </div>
                @can('settings-navs.create')
                    <button type="button"
                        class="flex items-center gap-1 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white"
                        data-modal-toggle="modalAdd" data-modal-target="modalAdd">
                        <i class="ti ti-circle-plus"></i>Tambah @yield('title')
                    </button>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border" id="data-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Nama</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Permission Identifier</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">URL</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Urutan</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Aktif</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Tampil</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @can('settings-navs.read')
                            @forelse ($menuRows as $row)
                                @php
                                    $menu = $row['menu'];
                                    $icon = trim($menu->icon ?? '');
                                    $menuIconClass = match (true) {
                                        $row['level'] > 0 => 'ti ti-corner-down-right',
                                        $icon === '' => 'ti ti-menu-2',
                                        str_contains($icon, ' ') => $icon,
                                        str_starts_with($icon, 'ti-') => 'ti ' . $icon,
                                        default => 'ti ti-' . $icon,
                                    };
                                @endphp
                                <tr>
                                    <td class="px-5 py-2.5 text-gray-500">
                                        <div class="flex items-center gap-2" style="padding-left: {{ $row['level'] * 20 }}px">
                                            <i class="{{ $menuIconClass }} text-[16px]"></i>
                                            <span class="{{ $row['level'] === 0 ? 'font-semibold text-gray-900' : '' }}">{{ $menu->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-2.5 text-gray-500">{{ $menu->slug ?? '-' }}</td>
                                    <td class="px-5 py-2.5 text-gray-500">{{ $menu->url ?? '-' }}</td>
                                    <td class="px-5 py-2.5 text-gray-500">{{ $menu->order ?? '-' }}</td>
                                    <td class="px-5 py-2.5">
                                        <span class="inline-flex items-center py-1 px-2 rounded-full text-xs leading-none font-semibold bg-white border {{ $menu->active ? 'border-success text-success' : 'border-danger text-danger' }}">
                                            {{ $menu->active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-2.5">
                                        <span class="inline-flex items-center py-1 px-2 rounded-full text-xs leading-none font-semibold bg-white border {{ $menu->display ? 'border-success text-success' : 'border-danger text-danger' }}">
                                            {{ $menu->display ? 'Tampil' : 'Tersembunyi' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-2.5">
                                        <div class="action-icon inline-flex gap-2 items-center">
                                            @can('settings-navs.update')
                                                <button type="button" title="Edit menu" class="btnModalEdit w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-warning hover:bg-light-900 hover:text-primary cursor-pointer"
                                                    data-url-action="{{ route('settings.navs.update', $menu->id) }}"
                                                    data-url-get="{{ route('settings.navs.edit', $menu->id) }}">
                                                    <i class="ti ti-edit text-[16px]"></i>
                                                </button>
                                            @endcan
                                            @can('settings-navs.delete')
                                                <form action="{{ route('settings.navs.destroy', $menu->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus menu" class="w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-danger hover:bg-light-900 hover:text-primary cursor-pointer"
                                                        onclick="confirmDelete(this);">
                                                        <i class="ti ti-trash text-[16px]"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        @endcan
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

    @can('settings-navs.create')
        @include('admin.settings.navigations.partials.modal-add')
    @endcan
    @can('settings-navs.update')
        @include('admin.settings.navigations.partials.modal-edit')
    @endcan
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({ width: '100%', allowClear: true });

            const table = $('#data-table').DataTable({
                searching: true,
                dom: 'lrtip',
                ordering: false,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    emptyTable: 'Tidak ada menu ditemukan',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    paginate: { next: '<i class="ti ti-chevron-right"></i>', previous: '<i class="ti ti-chevron-left"></i>' }
                },
                initComplete: function () {
                    $('.dt-length').appendTo('.datatable-length');
                    $('.dt-info').appendTo('.datatable-info');
                    $('.dt-paging').appendTo('.datatable-paginate');
                }
            });

            $('#navigation-table-search').on('input', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
