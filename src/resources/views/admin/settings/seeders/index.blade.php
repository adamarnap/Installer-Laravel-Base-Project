@extends('layouts.admin.master')

@section('title', 'Seeders Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('seeders') }}
@endsection

@push('styles')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/dataTables.tailwindcss.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <!-- START: Overview Card -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-5">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-primary-50 text-primary flex items-center justify-center text-2xl">
                    <i class="ti ti-database-import"></i>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-800">Database Seeders</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola dan jalankan file seeder aplikasi untuk mengisi data master, konfigurasi, atau data pengujian.</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" class="btn bg-primary border border-primary text-white hover:bg-primary-hover py-2 px-4 rounded text-sm inline-flex items-center gap-1.5"
                    data-modal-toggle="modalManualSeeder" data-modal-target="modalManualSeeder">
                    <i class="ti ti-terminal text-base"></i> Jalankan Manual Seeder
                </button>
            </div>
        </div>
    </div>
    <!-- END: Overview Card -->

    <!-- START: Seeders Table Card -->
    <div class="card border border-borderColor bg-white rounded-[5px] shadow-xs">
        <div class="card-header py-4 px-5 border-b border-borderColor">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="relative me-3">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 pointer-events-none">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" id="seeder-table-search" placeholder="Cari nama seeder..." class="pl-8 pr-4 py-2 border border-borderColor outline-none rounded-md text-sm placeholder:text-gray-400 focus:outline-none bg-white focus:ring-0 focus:outline-primary"/>
                </div>
                <div class="text-xs text-gray-500">
                    <i class="ti ti-folder mr-1"></i> Direktori: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-700">database/seeders/</code>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive custom-table">
                <table class="table table-nowrap border w-full border-borderColor" id="data-table-seeders">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">No.</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Nama Class Seeder</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Keterangan / Fungsi</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Terakhir Diubah</th>
                            <th class="text-left text-sm leading-normal px-5 py-2.5 bg-light text-gray-900 border-b border-borderColor font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer p-4 border-t border-borderColor">
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
    <!-- END: Seeders Table Card -->
</div>

{{-- Hidden Form for Running Seeders --}}
<form id="form-run-seeder" action="{{ route('settings.seeders.run') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="seeder_class" id="input-seeder-class" value="">
    <input type="hidden" name="password" id="input-seeder-password" value="">
</form>

@include('admin.settings.seeders.partials.modal-manual')
@endsection

@push('scripts')
    {{-- Start: Load DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dataTables.tailwindcss.js') }}"></script>
    {{-- End: Load DataTables JS --}}

    <script>
        $(document).ready(function () {
            const dataTable = $('#data-table-seeders').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                dom: 'lrtip',
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: 'Search',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ seeder',
                    infoEmpty: 'Tidak ada seeder yang ditemukan',
                    infoFiltered: '(difilter dari _MAX_ total seeder)',
                    lengthMenu: 'Tampilkan _MENU_ seeder',
                    paginate: {
                        next: '<i class="ti ti-chevron-right"></i>',
                        previous: '<i class="ti ti-chevron-left"></i>',
                    },
                },
                ajax: {
                    url: "{{ route('settings.seeders.index') }}",
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
                        data: 'class_name',
                        name: 'class',
                        searchable: true,
                        orderable: true,
                        className: 'px-5 py-2.5 text-left'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: true,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-600 text-sm text-left'
                    },
                    {
                        data: 'modified_at',
                        name: 'modified_at',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-gray-500 text-xs text-left'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'px-5 py-2.5 text-left'
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

            $('#seeder-table-search').on('input', function () {
                dataTable.search(this.value).draw();
            });

            // 1. Run Seeder from Table List with SweetAlert password prompt
            $(document).on('click', '.btn-run-seeder', function (e) {
                e.preventDefault();
                const seederClass = $(this).data('class');

                Swal.fire({
                    title: 'Jalankan Seeder?',
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">Sistem akan mengeksekusi seeder <strong class="font-mono text-gray-800">${seederClass}</strong>.</p>
                            <div class="p-3 bg-gray-100 rounded-md border border-gray-200">
                                <span class="text-xs text-gray-500 block mb-1">Command Artisan:</span>
                                <code class="text-xs font-mono font-bold text-primary">php artisan db:seed --class=${seederClass}</code>
                            </div>
                            <p class="text-xs text-gray-500">Masukkan password akun login Anda untuk otorisasi:</p>
                        </div>
                    `,
                    input: 'password',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocorrect: 'off',
                        placeholder: 'Masukkan password Anda...'
                    },
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="ti ti-player-play mr-1"></i> Jalankan Seeder',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Password wajib diisi!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        $('#input-seeder-class').val(seederClass);
                        $('#input-seeder-password').val(result.value);
                        $('#form-run-seeder').submit();
                    }
                });
            });

            // 2. Submit Manual Seeder Modal Form
            $('#form-manual-seeder-modal').on('submit', function (e) {
                const seederClass = $('#manual-seeder-input-class').val().trim();
                $('#input-modal-seeder-class').val(seederClass);
            });
        });
    </script>
@endpush
