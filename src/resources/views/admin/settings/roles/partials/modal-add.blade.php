<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[500px] max-h-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAddLabel">Tambah Data @yield('title')</h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalAdd">
                        <i class="ti ti-x"></i><span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <form action="{{ route('settings.roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="role-name-add" class="form-label">Nama Peran <strong class="text-red-500">*</strong></label>
                            <input type="text" name="name" id="role-name-add" class="form-control"
                                placeholder="Masukkan nama peran" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalAdd">Batal</button>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
