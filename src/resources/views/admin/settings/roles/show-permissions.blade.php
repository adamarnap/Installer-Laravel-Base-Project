@extends('layouts.admin.master')

@section('title', 'Hak Akses Peran')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles-permissions', $role->id, $role->name) }}
@endsection

@section('content')
    @php
        $permissionRows = collect();
        foreach ($navigations as $navigation) {
            $permissionRows->push(['menu' => $navigation, 'level' => 0]);
            foreach ($navigation->child as $child) {
                $permissionRows->push(['menu' => $child, 'level' => 1]);
                foreach ($child->subChild as $subChild) {
                    $permissionRows->push(['menu' => $subChild, 'level' => 2]);
                }
            }
        }
    @endphp

    <div class="card border bg-white rounded">
        <div class="card-header py-4 px-5">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none"><i class="ti ti-search"></i></span>
                    <input type="text" id="permission-table-search" placeholder="Search"
                        class="pl-8 pr-4 py-2 border outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary">
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('settings.roles.index') }}" class="flex items-center gap-1 btn btn-light">
                        <i class="ti ti-arrow-left"></i>Kembali
                    </a>
                    @can('settings-roles.update')
                        <button type="submit" form="permissions-form"
                            class="flex items-center gap-1 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">
                            <i class="ti ti-device-floppy"></i>Simpan
                        </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <form action="{{ route('settings.roles.permissions', $role->id) }}" id="permissions-form" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-nowrap border w-full border" id="data-table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Menu</th>
                                <th class="text-center text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Semua</th>
                                <th class="text-center text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Read</th>
                                <th class="text-center text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Create</th>
                                <th class="text-center text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Update</th>
                                <th class="text-center text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b font-semibold">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-borderColor">
                            @can('settings-roles.read')
                                @forelse ($permissionRows as $row)
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
                                        <td class="px-5 py-2.5 text-center">
                                            <input type="checkbox" class="check-all form-check-input border-borderColor rounded" data-id="{{ $menu->id }}"
                                                aria-label="Pilih semua hak akses {{ $menu->name }}">
                                        </td>
                                        @foreach (['read', 'create', 'update', 'delete'] as $action)
                                            @php($permissionName = strtolower($menu->slug) . '.' . $action)
                                            <td class="px-5 py-2.5 text-center">
                                                <input id="checkbox_{{ $menu->id }}_{{ $action }}" name="permissions[]" type="checkbox"
                                                    value="{{ $permissionName }}" class="form-check-input border-borderColor rounded"
                                                    aria-label="{{ ucfirst($action) }} {{ $menu->name }}"
                                                    {{ in_array($permissionName, $permissions) ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                @endforelse
                            @endcan
                        </tbody>
                    </table>
                </form>
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

            $('#permission-table-search').on('input', function () {
                table.search(this.value).draw();
            });

            $('#permissions-form').on('submit', function () {
                $(table.rows().nodes()).appendTo('#data-table tbody');
            });

            $('.check-all').each(function () {
                updateCheckAll($(this).data('id'));
            });
        });

        $(document).on('change', '.check-all', function () {
            const menuId = $(this).data('id');
            ['read', 'create', 'update', 'delete'].forEach(function (action) {
                $('#checkbox_' + menuId + '_' + action).prop('checked', $('.check-all[data-id="' + menuId + '"]').prop('checked'));
            });
        });

        $(document).on('change', 'input[id^="checkbox_"]', function () {
            const matches = this.id.match(/checkbox_(\d+)_/);
            if (matches) updateCheckAll(matches[1]);
        });

        function updateCheckAll(menuId) {
            const allChecked = ['read', 'create', 'update', 'delete'].every(function (action) {
                return $('#checkbox_' + menuId + '_' + action).prop('checked');
            });
            $('.check-all[data-id="' + menuId + '"]').prop('checked', allChecked);
        }
    </script>
@endpush
