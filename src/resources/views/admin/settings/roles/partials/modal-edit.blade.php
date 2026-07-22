<button type="button" id="modalEditToggle" class="hidden" data-modal-toggle="modalEdit" data-modal-target="modalEdit"></button>

<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[500px] max-h-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditLabel">Edit Data @yield('title')</h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalEdit">
                        <i class="ti ti-x"></i><span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <form action="" method="POST" id="form-edit-role">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="role-name-edit" class="form-label">Nama Peran <strong class="text-red-500">*</strong></label>
                            <input type="text" name="name" id="role-name-edit" class="form-control"
                                placeholder="Masukkan nama peran" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalEdit">Batal</button>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '.btnModalEdit', function (event) {
            event.preventDefault();
            const button = $(this);

            $.ajax({
                url: button.data('url-get'),
                type: 'GET',
                success: function (response) {
                    $('#modalEditLabel').text('Edit Data Peran - ' + response.name);
                    $('#form-edit-role').attr('action', button.data('url-action'));
                    $('#role-name-edit').val(response.name);
                    $('#modalEditToggle').trigger('click');
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memuat data.' });
                }
            });
        });
    </script>
@endpush
