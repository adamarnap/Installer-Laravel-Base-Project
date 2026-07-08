@extends('layouts.admin.master')

@section('title', 'Menu')

@section('breadcrumb')
    {{ Breadcrumbs::render('navigations') }}
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header  ">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Menu</h4>
                    <p class="text-default-400">Kelola struktur menu, permission identifier, status, dan urutan tampilan.</p>
                </div>

                @can('settings-navs.create')
                    <button type="button"
                        class="btn bg-primary hover:bg-primary-hover rounded text-white"
                        id="modal-add-toggle"
                        aria-haspopup="dialog"
                        aria-expanded="false"
                        aria-controls="modal-add"
                        data-hs-overlay="#modal-add">
                        <i class="iconify tabler--plus text-xs"></i>
                        Tambah @yield('title')
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4 overflow-x-auto">
                    <table id="data-table" class="display stripe group" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Permission Identifier</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Order</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Display</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @can('settings-navs.read')
                            @foreach ($navigations as $nav)
                                <tr>
                                    <td class="text-left align-middle">
                                        <div class="flex items-center gap-2">
                                            <i class="iconify tabler--{{ str_replace('_', '-', $nav['icon']) }} transition-all text-gray-500 dark:text-gray-400 text-xs leading-none relative -top-px"></i>
                                            <span class="title leading-none text-left font-bold">
                                                {{ $nav['name'] }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-0 py-1 text-start">{{ $nav->slug }}</td>
                                    <td class="px-0 py-1 text-start">{{ $nav->url }}</td>
                                    <td class="px-2 py-1 text-start">
                                        {{ $nav->order }}
                                    </td>
                                    <td class="px-3 py-1 text-start">
                                        <small>
                                            <span class="badge bg-{{ $nav->active == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $nav->active == 1 ? 'Active' : 'Deactive' }}</span>
                                        </small>
                                    </td>
                                    <td class="px-3 py-1 text-start">
                                        <small>
                                            <span class="badge bg-{{ $nav->display == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $nav->display == 1 ? 'Display' : 'Hidden' }}</span>
                                        </small>
                                    </td>
                                    <td class="px-4 py-1 text-center">
                                        <div class="flex items-center gap-[9px]">
                                            @can('settings-navs.update')
                                                <button type="button" class="btn-modal-edit-nav btn border-warning text-warning hover:bg-warning hover:text-white me-2" id="customTooltip" data-text="Edit"
                                                    data-id="{{ $nav->id }}"
                                                    data-url-action="{{ route('settings.navs.update', $nav->id) }}"
                                                    data-url-get="{{ route('settings.navs.edit', $nav->id) }}">
                                                    <i class="iconify tabler--edit text-xs"></i>
                                                </button>
                                            @endcan
                                            @can('settings-navs.delete')
                                                <form action="{{ route('settings.navs.destroy', $nav->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="confirmDelete(this);" class="btn border-danger text-danger hover:bg-danger hover:text-white" id="customTooltip" data-text="Delete">
                                                        <i class="iconify tabler--trash text-xs"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                {{-- START: Menu Level 2 & 3 --}}
                                @if ($nav->child->count() > 0)
                                    @foreach ($nav->child as $child)
                                        <tr class="">
                                            <td class="px-5 py-1 text-start border-l-4 border-blue-500">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="col-span">
                                                            <i class="iconify tabler--dots text-blue-500 text-xs"></i>
                                                        </div> 
                                                        <div class="title leading-none text-left font-medium">
                                                            {{ $child->name ?? '-' }}
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td class="px-1 py-1 text-start">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="title leading-none text-left">
                                                            {{ $child->slug ?? '-' }}
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td class="px-1 py-1 text-start">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="title leading-none text-left">
                                                            {{ $child->url ?? '-' }}
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td class="px-5 py-1 text-center">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="title leading-none text-left">
                                                            {{ $child->order ?? '-' }}
                                                        </div>
                                                    </div>    
                                                </small>
                                            </td>
                                            <td class="px-4 py-1 text-center {{ $child->active == 1 ? 'text-success' : 'text-danger' }}">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="title leading-none text-left">
                                                            <span class="badge bg-{{ $child->active == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $child->active == 1 ? 'Active' : 'Deactive' }}</span>
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td class="px-4 py-1 text-center {{ $child->display == 1 ? 'text-success' : 'text-danger' }}">
                                                <small>
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="title leading-none text-left">
                                                            <span class="badge bg-{{ $child->display == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $child->display == 1 ? 'Display' : 'Hidden' }}</span>
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td class="px-5 py-1 text-center">
                                                <div class="flex items-center gap-[9px]">
                                                    @can('settings-navs.update')
                                                        <button type="button" class="btn-modal-edit-nav btn border-warning text-warning hover:bg-warning hover:text-white me-2" id="customTooltip" data-text="Edit"
                                                        data-id="{{ $child->id }}"
                                                        data-url-action="{{ route('settings.navs.update', $child->id) }}"
                                                        data-url-get="{{ route('settings.navs.edit', $child->id) }}">
                                                                <i class="iconify tabler--edit text-xs"></i>
                                                        </button>
                                                    @endcan
                                                    @can('settings-navs.delete')
                                                        <form action="{{ route('settings.navs.destroy', $child->id) }}" method="post"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" onclick="confirmDelete(this);" class="btn border-danger text-danger hover:bg-danger hover:text-white" id="customTooltip" data-text="Delete">
                                                                    <i class="iconify tabler--trash text-xs"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        {{-- START: Menu Level 3 --}}
                                        @if ($child->subChild->count() > 0)
                                            @foreach ($child->subChild as $subChild)
                                                <tr class="">
                                                    <td class="px-5 py-1 text-start border-l-4 border-green-500">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="col-span">
                                                                    <i class="iconify tabler--dots text-green-500 text-xs"></i><i class="iconify tabler--dots text-green-500 text-xs"></i>
                                                                </div> 
                                                                <div class="title leading-none text-left">
                                                                    {{ $subChild->name ?? '-' }}
                                                                </div>
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td class="px-5 py-1 text-center">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="title leading-none text-left">
                                                                    {{ $subChild->slug ?? '-' }}
                                                                </div>
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td class="px-1 py-1 text-start">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="title leading-none text-left">
                                                                    {{ $subChild->url ?? '-' }}
                                                                </div>
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td class="px-5 py-1 text-center">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="title leading-none text-left">
                                                                    {{ $subChild->order ?? '-' }}
                                                                </div>
                                                            </div>    
                                                        </small>
                                                    </td>
                                                    <td class="px-4 py-1 text-center {{ $subChild->active == 1 ? 'text-success' : 'text-danger' }}">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="title leading-none text-left">
                                                                    <span class="badge bg-{{ $subChild->active == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $subChild->active == 1 ? 'Active' : 'Deactive' }}</span>
                                                                </div>
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td class="px-4 py-1 text-center {{ $subChild->display == 1 ? 'text-success' : 'text-danger' }}">
                                                        <small>
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="title leading-none text-left">
                                                                    <span class="badge bg-{{ $subChild->display == 1 ? 'success' : 'danger' }} text-white font-medium text-xs">{{ $subChild->display == 1 ? 'Display' : 'Hidden' }}</span>
                                                                </div>
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td class="px-5 py-1 text-center">
                                                        <div class="flex items-center gap-[9px]">
                                                            @can('settings-navs.update')
                                                                <button type="button" class="btn-modal-edit-nav btn border-warning text-warning hover:bg-warning hover:text-white me-2" id="customTooltip" data-text="Edit"
                                                                data-id="{{ $subChild->id }}"
                                                                data-url-action="{{ route('settings.navs.update', $subChild->id) }}"
                                                                data-url-get="{{ route('settings.navs.edit', $subChild->id) }}">
                                                                        <i class="iconify tabler--edit text-xs"></i>
                                                                </button>
                                                            @endcan
                                                            @can('settings-navs.delete')
                                                                <form action="{{ route('settings.navs.destroy', $subChild->id) }}" method="post"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" onclick="confirmDelete(this);" class="btn border-danger text-danger hover:bg-danger hover:text-white" id="customTooltip" data-text="Delete">
                                                                            <i class="iconify tabler--trash text-xs"></i>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        {{-- END: Menu Level 3 --}}
                                    @endforeach
                                @endif
                                {{-- END: Menu Level 2 & 3 --}}
                            @endforeach
                        @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('settings-navs.create')
        @include('admin.settings.navigations.partials.modal-add')
    @endcan

    @can('settings-navs.update')
        @include('admin.settings.navigations.partials.modal-edit')
    @endcan

    @can('settings-navs.update')
        <form action="" id="form-delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endcan
@endsection

@push('scripts')
    {{-- Start: Data Table --}}
    <!-- Jquery for Datatables-->
    <script src="{{ URL::asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <!-- Page js -->
    <script src="{{ URL::asset('assets/admin/js/pages/datatables-column-search.js') }}"></script>
    
    <!-- Select2 Plugin Js -->
    <script src="{{ URL::asset('assets/admin/plugins/select2/select2.min.js') }}"></script>

    <script>
        $('#data-table').DataTable({
            responsive: true,
            "ordering": false,
            "pageLength": 100
        });
    </script>
    {{-- End: Data Table --}}

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
@endpush
