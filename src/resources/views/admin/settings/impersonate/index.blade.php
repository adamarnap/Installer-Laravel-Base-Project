@extends('layouts.admin.master')

@section('title', 'Pengguna')

@section('breadcrumb')
    {{ Breadcrumbs::render('impersonate') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header  ">
                <div>
                    <h4 class="card-title mb-1.25">Daftar Pengguna untuk Impersonate</h4>
                    <p class="text-default-400">Pilih pengguna aktif untuk masuk sementara sebagai akun tersebut.</p>
                </div>
                <span class="badge bg-primary/15 text-primary">DataTable AJAX</span>
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4">
                    <table id="data-table" class="display stripe group" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="ltr:!text-left rtl:!text-right">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Peran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="5">
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
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <!-- Jquery for Datatables-->
    <script src="{{ URL::asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <!-- Page js -->
    <script src="{{ URL::asset('assets/admin/js/pages/datatables-column-search.js') }}"></script>
    {{-- Start: Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Start: Select2 For Modal Add --}}
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
                pageLength: 100,
                processing: true,
                serverSide: true,
                // language: {
                //     url: "{{ asset('assets/admin/js/datatables/lang/id.json') }}",
                // },
                ajax: {
                    url: "{{ route('settings.impersonate.index') }}",
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
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        className: 'text-start'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        searchable: true,
                        orderable: true,
                        className: 'text-start'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'text-left'
                    },
                    // etc ...
                ],
            })
        }
        // -- End Load Datatable
    </script>
    {{-- End: Implement datatable --}}
@endpush
