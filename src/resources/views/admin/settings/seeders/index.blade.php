@extends('layouts.admin.master')

@section('title', 'Seeders Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('seeders') }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    {{-- START: Manual Seeder Execution Form Card --}}
    @can('settings-seeders.update')
        <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-header mb-[20px] md:mb-[25px] flex items-center justify-between">
                <div class="trezo-card-title">
                    <h5 class="mb-0">
                        Jalankan Seeder Manual / Eksternal
                    </h5>
                </div>
                <div class="trezo-card-subtitle">
                    <button type="button" class="btn-open-seeder-modal trezo-card-dropdown-btn py-[7px] md:py-[9px] px-[16px] md:px-[22px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium text-xs md:text-sm inline-flex items-center gap-2 shadow-sm"
                        data-class="DatabaseSeeder" data-name="DatabaseSeeder (Semua Seeder)">
                        <i class="ri-restart-line text-lg leading-none"></i>
                        <span>Jalankan Ulang Semua Seeder (DatabaseSeeder)</span>
                    </button>
                </div>
            </div>

            <div class="trezo-card-content">
                <form action="{{ route('settings.seeders.run') }}" method="POST" id="form-manual-seeder">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-[20px] md:gap-[25px]">
                        {{-- Class Seeder Input --}}
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm text-black dark:text-white">
                                Nama Class Seeder
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="seeder_class" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 font-mono text-xs md:text-sm" placeholder="e.g. NavigationSeeder atau Database\Seeders\UserSeeder">
                        </div>

                        {{-- Password Input --}}
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm text-black dark:text-white">
                                Password Akun Admin
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-xs md:text-sm" placeholder="Masukkan password akun login Anda">
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-end">
                            <button type="submit" class="h-[45px] w-full trezo-card-dropdown-btn inline-flex items-center justify-center gap-2 py-[10px] px-[22px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 text-xs md:text-sm font-medium shadow-sm">
                                <i class="ri-play-circle-line text-lg leading-none"></i>
                                <span>Eksekusi Seeder Manual</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan
    {{-- END: Manual Seeder Execution Form Card --}}

    <!-- START: Seeders Data Table Card -->
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar Seeder Database Terdaftar
                </h5>
            </div>
            <div class="trezo-card-subtitle">
                <span class="text-sm text-gray-500">
                    Total: {{ $seeders->count() }} Seeder Tersedia
                </span>
            </div>
        </div>

        {{-- START: Data Table --}}
        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="seeders-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 !text-center">No.</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Class Seeder</th>
                            <th class="px-2 py-1 ltr:!text-left rtl:!text-right">Deskripsi Data</th>
                            <th class="px-2 py-1 !text-center">Terakhir Diperbarui</th>
                            <th class="px-2 py-1 !text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="data-row">
                            <td colspan="5">
                                <div class="flex justify-center items-center">
                                    <span class="text-gray-500 dark:text-zink-300">Memuat daftar seeder...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    <!-- END: Seeders Data Table Card -->

    {{-- START: Modal Run Seeder --}}
    <div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-run-seeder">
        <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
            <div class="trezo-card w-full max-w-[95%] sm:max-w-[550px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
                
                {{-- START: Modal Header --}}
                <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                    <div class="trezo-card-title">
                        <h5 class="mb-0">
                            Konfirmasi Eksekusi Seeder
                        </h5>
                    </div>
                    <div class="trezo-card-subtitle">
                        <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500 btn-close-modal-seeder">
                            <i class="ri-close-fill"></i>
                        </button>
                    </div>
                </div>
                {{-- END: Modal Header --}}

                {{-- START: Form --}}
                <form action="{{ route('settings.seeders.run') }}" method="POST">
                    @csrf
                    <input type="hidden" name="seeder_class" id="modal-seeder-class-input">
                    
                    {{-- START: Modal Body --}}
                    <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                        <div class="p-3 bg-gray-50 dark:bg-[#15203c] rounded-md">
                            <span class="text-xs text-gray-500 block mb-1">Class Seeder:</span>
                            <code id="modal-seeder-class-name" class="font-mono text-xs font-semibold text-primary-600 dark:text-primary-400 break-all">-</code>
                        </div>

                        <div>
                            <label class="mb-[12px] font-medium block text-black dark:text-white">
                                Password Akun Admin
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-sm" placeholder="Masukkan password akun Anda untuk konfirmasi">
                        </div>
                    </div>
                    {{-- END: Modal Body --}}

                    {{-- START: Modal Footer --}}
                    <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                        <button class="inline-block py-[10px] px-[30px] bg-secondary-500 text-white transition-all hover:bg-secondary-400 rounded-md border border-secondary-500 hover:border-secondary-400 btn-close-modal-seeder" type="button">
                            Batal
                        </button>
                        <button type="submit" class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 font-medium">
                            <i class="ri-play-circle-line align-middle mr-1"></i>
                            Jalankan Seeder Ini
                        </button>
                    </div>
                    {{-- END: Modal Footer --}}
                </form>
            </div>
        </div>
    </div>
    {{-- END: Modal Run Seeder --}}
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $(document).ready(function() {
            var seedersTable = $('#seeders-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/admin/js/datatables-2.3.4/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('settings.seeders.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '5%'
                    },
                    {
                        data: 'class_name',
                        name: 'class_name',
                        searchable: true,
                        orderable: true,
                        width: '35%'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: false,
                        orderable: false,
                        width: '30%',
                        render: function(data) {
                            return '<span class="text-xs text-gray-600 dark:text-gray-300">' + (data || '-') + '</span>';
                        }
                    },
                    {
                        data: 'modified_at',
                        name: 'modified_at',
                        searchable: false,
                        orderable: false,
                        className: '!text-center font-mono text-xs',
                        width: '15%'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: '!text-center',
                        width: '15%'
                    },
                ],
            });

            // Modal Run Seeder Logic
            const modalSeeder = document.getElementById('modal-run-seeder');

            $(document).on('click', '.btn-run-seeder, .btn-open-seeder-modal', function(e) {
                e.preventDefault();
                var seederClass = $(this).data('class');
                var seederName = $(this).data('name') || seederClass;

                $('#modal-seeder-class-input').val(seederClass);
                $('#modal-seeder-class-name').text(seederName);
                modalSeeder.classList.add('active');
            });

            $('.btn-close-modal-seeder').on('click', function() {
                modalSeeder.classList.remove('active');
            });
        });
    </script>
@endpush
