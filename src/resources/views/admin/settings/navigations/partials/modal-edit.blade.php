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
                <form action="" method="POST" id="form-edit-navigation">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-name-edit" class="form-label">Nama Menu <strong class="text-red-500">*</strong></label>
                                <input type="text" name="name" id="nav-name-edit" class="form-control" placeholder="Masukkan nama menu" required>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-slug-edit" class="form-label">Permission Identifier <strong class="text-red-500">*</strong></label>
                                <input type="text" name="slug" id="nav-slug-edit" class="form-control" placeholder="Masukkan permission identifier" required>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-parent-edit" class="form-label">Parent Menu</label>
                                <select name="parent_id" id="nav-parent-edit" class="select2 form-control">
                                    <option value="">- Pilih Parent Menu -</option>
                                    @foreach ($parentNavigations as $nav)
                                        <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-url-edit" class="form-label">URL <strong class="text-red-500">*</strong></label>
                                <input type="text" name="url" id="nav-url-edit" class="form-control" placeholder="Masukkan route menu" required>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-icon-edit" class="form-label">Icon</label>
                                <input type="text" name="icon" id="nav-icon-edit" class="form-control" placeholder="Masukkan nama icon">
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-order-edit" class="form-label">Urutan <strong class="text-red-500">*</strong></label>
                                <input type="number" name="order" id="nav-order-edit" class="form-control" placeholder="Masukkan urutan menu" required>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-active-edit" class="form-label">Status <strong class="text-red-500">*</strong></label>
                                <select name="active" id="nav-active-edit" class="form-control" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="md:col-span-6 mb-3">
                                <label for="nav-display-edit" class="form-label">Tampilan <strong class="text-red-500">*</strong></label>
                                <select name="display" id="nav-display-edit" class="form-control" required>
                                    <option value="1">Tampil</option>
                                    <option value="0">Tersembunyi</option>
                                </select>
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
                    $('#modalEditLabel').text('Edit Data Menu - ' + response.name);
                    $('#form-edit-navigation').attr('action', button.data('url-action'));
                    $('#nav-name-edit').val(response.name);
                    $('#nav-slug-edit').val(response.slug);
                    $('#nav-parent-edit').val(response.parent_id).trigger('change');
                    $('#nav-url-edit').val(response.url);
                    $('#nav-icon-edit').val(response.icon);
                    $('#nav-order-edit').val(response.order);
                    $('#nav-active-edit').val(response.active);
                    $('#nav-display-edit').val(response.display);
                    $('#modalEditToggle').trigger('click');
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memuat data.' });
                }
            });
        });
    </script>
@endpush
