@extends('layouts.admin.master')

@section('title', 'Peran')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles') }}
@endsection

@push('styles')
@endpush


@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header  ">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Peran</h4>
                    <p class="text-default-400">Atur role, akses permission, dan tindakan pengelolaan peran.</p>
                </div>

                @can('settings-roles.create')
                    <button type="button"
                        class="btn bg-primary hover:bg-primary-hover rounded text-white"
                        id="modal-add-toggle"
                        aria-haspopup="dialog"
                        aria-expanded="false"
                        aria-controls="modal-add"
                        data-hs-overlay="#modal-add">
                        <i class="iconify tabler--plus text-xs"></i>
                        Add New @yield('title')
                    </button>
                @endcan
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4">
                    <table id="data-table" class="display stripe group" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('settings-roles.read')
                                @forelse ($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-left">
                                            {{ $role->name ?? '-' }}
                                        </td>
                                        <td class="text-left">
                                            @can('settings-roles.read')
                                                <a href="{{ route('settings.roles.show', $role->id) }}" class="btn border-primary text-primary hover:bg-primary hover:text-white">
                                                    <i class="iconify tabler--lock text-xs"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            <div class="flex flex-wrap justify-center gap-2">
                                                @can('settings-roles.update')
                                                    <button type="button"
                                                        data-id="{{ $role->id }}"
                                                        data-url-action="{{ route('settings.roles.update', $role->id) }}"
                                                        data-url-get="{{ route('settings.roles.edit', $role->id) }}"
                                                        class="btn-modal-edit-role btn border-warning text-warning hover:bg-warning hover:text-white">
                                                        <i class="iconify tabler--edit text-xs"></i>
                                                    </button>
                                                @endcan
                                                @can('settings-roles.delete')
                                                    <form action="{{ route('settings.roles.destroy', $role->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn border-danger text-danger hover:bg-danger hover:text-white" onclick="confirmDelete(this);">
                                                            <i class="iconify tabler--trash text-xs"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada menu ditemukan</td>
                                    </tr>
                                @endforelse
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('settings-roles.create')
        @include('admin.settings.roles.partials.modal-add')
    @endcan

    @can('settings-roles.update')
        @include('admin.settings.roles.partials.modal-edit')
    @endcan

    @can('settings-roles.delete')
        <form action="" id="form-delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endcan
@endsection

@push('scripts')
    <!-- Jquery for Datatables-->
    <script src="{{ URL::asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <!-- Page js -->
    <script src="{{ URL::asset('assets/admin/js/pages/datatables-column-search.js') }}"></script>
    {{-- Start: Implement datatable --}}
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "columnDefs": [
                    { "targets": [2], "className": "text-center" }
                ],
                columns: [
                    { width: "5%" },
                    { width: "75%" },
                    { width: "5%" },
                    { width: "15%" }
                ],
                autoWidth: false
            });
        });
    </script>
    {{-- End: Implement datatable --}}
@endpush
