@extends('layouts.admin.master')

@section('title', 'App Logs')

@section('breadcrumb')
    {{ Breadcrumbs::render('apps-log') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1.25">Daftar File Log Aplikasi</h4>
                    <p class="text-default-400">Pantau dan kelola berkas log aplikasi (storage/logs) yang dihasilkan sistem.</p>
                </div>
            </div>

            <div class="card-body">
                <div class="table-wrapper -mb-4">
                    <table id="data-table" class="table table-striped" style="width:100%">
                        <thead class="text-2xs font-semibold uppercase">
                            <tr>
                                <th class="text-center" style="width: 5%">No.</th>
                                <th class="ltr:!text-left rtl:!text-right">Nama File Log</th>
                                <th class="text-center" style="width: 15%">Ukuran File</th>
                                <th class="text-center" style="width: 20%">Terakhir Diperbarui</th>
                                <th class="text-center" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="data-row">
                                <td colspan="5">
                                    <div class="flex items-center justify-center py-6">
                                        <span class="text-gray-500">Memuat data log...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Delete --}}
    <form id="form-delete" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <!-- Datatables js -->
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatables-dt/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                language: {
                    paginate: {
                        first: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7l-5 5l5 5" /><path d="M17 7l-5 5l5 5" /></svg>',
                        previous: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>',
                        next: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>',
                        last: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7l5 5l-5 5" /><path d="M13 7l5 5l-5 5" /></svg>',
                    },
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari total _MAX_ data)",
                    zeroRecords: "Tidak ada file log ditemukan",
                    processing: "Memproses data..."
                },
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('settings.apps-log.index') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center font-medium'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return `<div class="flex items-center gap-2">
                                <i class="iconify tabler--file-text text-primary text-lg"></i>
                                <span class="font-mono font-semibold text-default-800 text-sm">${data}</span>
                            </div>`;
                        }
                    },
                    {
                        data: 'size',
                        name: 'size',
                        className: 'text-center font-mono text-sm'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        className: 'text-center text-sm'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                drawCallback: function() {
                    if (window.HSStaticMethods) {
                        window.HSStaticMethods.autoInit();
                    }
                }
            });

            // Delete Log Confirmation
            $(document).on('click', '#btn-delete', function(e) {
                e.preventDefault();
                const logName = $(this).data('id');
                const urlAction = $(this).data('url-action');

                Swal.fire({
                    title: 'Hapus File Log?',
                    html: `<p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus file log <strong>${logName}</strong>? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--trash mr-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete').attr('action', urlAction);
                        $('#form-delete').submit();
                    }
                });
            });
        });
    </script>
@endpush
