<button type="button" id="modalEditToggle" class="hidden" data-modal-toggle="modalEdit" data-modal-target="modalEdit"></button>

<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-full modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditLabel">Edit Data @yield('title')</h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalEdit">
                        <i class="ti ti-x"></i><span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <form action="" method="POST" id="form-edit-preference" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_asset" id="is_asset">
                    <div class="modal-body">
                        <div id="content-asset" class="hidden">
                            <div class="flex flex-col items-center mb-5" id="content-asset-preview">
                                <img src="" alt="Preview asset" class="max-w-[300px] max-h-[180px] object-contain mb-2"
                                    id="content-asset-preview--image">
                                <p class="text-center text-sm text-gray-500" id="content-asset-preview--text"></p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-4 mb-3">
                                    <label for="path" class="form-label">Path</label>
                                    <input type="text" name="path" id="path" class="form-control" readonly>
                                </div>
                                <div class="md:col-span-4 mb-3">
                                    <label for="file_name" class="form-label">Nama File</label>
                                    <input type="text" name="file_name" id="file_name" class="form-control" readonly>
                                </div>
                                <div class="md:col-span-4 mb-3">
                                    <label for="file_asset" class="form-label">Upload File <strong class="text-red-500">*</strong></label>
                                    <input type="file" name="file_asset" id="file_asset" class="form-control file-input">
                                </div>
                            </div>
                        </div>
                        <div id="content-form-value">
                            <div class="mb-3">
                                <label for="preference-value" class="form-label">Nilai <strong class="text-red-500">*</strong></label>
                                <textarea name="value" id="preference-value" class="form-control" rows="5"
                                    placeholder="Masukkan nilai preferensi" required></textarea>
                            </div>
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
                    const form = $('#form-edit-preference');
                    $('#modalEditLabel').text('Edit Data Preferensi - ' + response.name);
                    form.attr('action', button.data('url-action'));
                    form.find('#preference-value').val(response.value);
                    form.find('#file_asset').val('').prop('required', false);

                    if (response.is_asset) {
                        const filepath = response.value;
                        const filename = filepath.substring(filepath.lastIndexOf('/') + 1);
                        const directory = filepath.substring(0, filepath.lastIndexOf('/'));

                        $('#content-asset').show();
                        $('#content-form-value').hide();
                        form.find('#preference-value').prop('required', false);
                        form.find('#file_asset').prop('required', true);
                        form.find('#is_asset').val('1');
                        form.find('#path').val(directory + '/');
                        form.find('#file_name').val(filename);
                        $('#content-asset-preview--image').attr('src', "{{ asset('') }}" + filepath);
                        $('#content-asset-preview--text').text(filename);
                    } else {
                        $('#content-asset').hide();
                        $('#content-form-value').show();
                        form.find('#preference-value').prop('required', true);
                        form.find('#is_asset').val('0');
                    }

                    $('#modalEditToggle').trigger('click');
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memuat data.' });
                }
            });
        });
    </script>
@endpush
