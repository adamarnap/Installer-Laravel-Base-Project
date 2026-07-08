@extends('layouts.admin.master')

@section('title', 'Pengguna')

@section('breadcrumb')
    {{ Breadcrumbs::render('users') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Pengguna</h4>
                    <p class="text-default-400">Kelola pengguna, peran, status, dan aksi impersonate dari satu halaman.</p>
                </div>

                @can('settings-users.create')
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
                    <table id="data-table" class="table table-striped" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="ltr:!text-left rtl:!text-right">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Peran</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Dibuat Pada</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="7">
                                    <div class="flex items-center justify-center py-6">
                                        <span class="text-gray-500 dark:text-zink-300">Data loading ...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.settings.user.partials.modal-add')
    @include('admin.settings.user.partials.modal-edit')

    @can('settings-users.delete')
        <form action="" id="form-delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @endcan
@endsection

@push('scripts')

    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    {{-- <script src="{{ URL::asset('assets/admin/js/pages/datatables-basic.js') }}"></script> --}}

    <!-- Select2 Plugin Js -->
    <script src="{{ URL::asset('assets/admin/plugins/select2/select2.min.js') }}"></script>

    <!--Select 2 Demo js-->
    <script src="{{ URL::asset('assets/admin/js/pages/form-select2.js') }}"></script>


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
        // -- Start Load Datatable
        var filter = {
            status: '',
            pilar: '',
            keyword: ''
        }
        loadTable(filter);

        function loadTable(filter) {
            var tbl = $('#data-table').DataTable({
                language: {
                    paginate: {
                        first: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7l-5 5l5 5" /><path d="M17 7l-5 5l5 5" /></svg>',
                        previous:
                            '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>',
                        next: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>',
                        last: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7l5 5l-5 5" /><path d="M13 7l5 5l-5 5" /></svg>',
                    },
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.users.index') }}",
                    type: 'GET',
                },
                drawCallback: function() {
                    if (window.HSStaticMethods) {
                        window.HSStaticMethods.autoInit();
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
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
    {{-- End: Implement datatable --}}
@endpush
