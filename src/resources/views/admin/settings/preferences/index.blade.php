@extends('layouts.admin.master')

@section('title', 'Preferensi')

@section('breadcrumb')
    {{ Breadcrumbs::render('preferences') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header  ">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Preferensi</h4>
                    <p class="text-default-400">Kelola konfigurasi aplikasi dan nilai yang tersimpan di sistem.</p>
                </div>
                <span class="badge bg-info/15 text-info">Editable settings</span>
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4 overflow-x-auto">
                    <table id="data-table" class="display" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center">Key</th>
                                <th class="text-center">Group</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($preferences as $preference)
                                <tr>
                                    <td class="align-middle">{{ $preference->name ?? '-' }}</td>
                                    <td class="align-middle">{{ $preference->group ?? '-' }}</td>
                                    <td class="align-middle text-center">
                                        <span class="badge {{ $preference->is_asset ? 'bg-success/15 text-success' : 'bg-secondary/15 text-secondary' }}">
                                            {{ $preference->is_asset ? 'Asset' : 'Value' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="break-all">{{ $preference->value ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @can('settings-preferences.update')
                                            <div class="flex items-center justify-center gap-[9px]">
                                                <button type="button" class="btn-modal-edit-pref btn border-danger text-warning hover:bg-danger hover:text-white"
                                                    id="customTooltip" data-text="Edit"
                                                    data-id="{{ $preference->id }}"
                                                    data-url-action="{{ route('settings.preferences.update', $preference->id) }}"
                                                    data-url-get="{{ route('settings.preferences.edit', $preference->id) }}">
                                                    <i class="iconify tabler--edit text-xs"></i>
                                                </button>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Not found preferences</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('settings-preferences.update')
        @include('admin.settings.preferences.partials.modal-edit')
    @endcan

    <form action="" id="form-delete" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <!-- Jquery for Datatables-->
    <script src="{{ URL::asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <!-- Page js -->
    <script src="{{ URL::asset('assets/admin/js/pages/datatables-column-search.js') }}"></script>
    
    <script>
        $('#data-table').DataTable({
            responsive: true,
            // "ordering": false,
            "pageLength": 100
        });
    </script>
    {{-- End: Data Table --}}

    {{-- Start: Select 2 --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- End: Select 2 --}}
@endpush
