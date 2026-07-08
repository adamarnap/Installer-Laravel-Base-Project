<button id="modal-edit-toggle" type="button" class="hidden" data-hs-overlay="#modal-edit"></button>

<div id="modal-edit" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-title">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-xl lg:max-w-4xl">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-title" class="text-base font-semibold">Edit Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Perbarui menu dan atribut akses dari modal ini.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-edit">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="overflow-y-auto card-body">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <label class="mb-[12px] block font-medium">
                                Menu Name
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="Fill menu name ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Permission Identifier
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="slug" id="slug" class="form-input" placeholder="Fill permission identifier ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Parent Menu</label>
                            <select name="parent_id" id="parent_id" class="form-select select2">
                                <option value="">- Select Parent Menu -</option>
                                @foreach ($parentNavigations as $nav)
                                    <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                URL
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="url" id="url" class="form-input" placeholder="Route name menu ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-input" placeholder="Fill icon name, here use Material Icons ...">
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Order
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="number" name="order" id="order" class="form-input" placeholder="Number of order menu ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Is Active
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="active" id="active" class="form-select select2" required>
                                <option value="">- Select Status Active -</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Is Display
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="display" id="display" class="form-select select2" required>
                                <option value="">- Select Status Display -</option>
                                <option value="1">Display</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-default-300 flex items-center justify-end border-t p-4">
                    <button type="button" class="btn bg-light hover:text-primary m-1" data-hs-overlay="#modal-edit">Close</button>
                    <button type="submit" class="btn bg-primary hover:bg-primary-hover m-1 rounded text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).on('click', '.btn-modal-edit-nav', function(e) {
        e.preventDefault();

        $('#modal-edit-toggle').trigger('click');

        var urlFormAction = $(this).data('url-action');
        var urlGetData = $(this).data('url-get');

        $.ajax({
            url: urlGetData,
            type: 'GET',
            success: function(response) {
                $('#modal-title').text('Edit Data Menu - ' + response.name);
                $('#form-edit').attr('action', urlFormAction);
                $('#form-edit').find('#name').val(response.name);
                $('#form-edit').find('#slug').val(response.slug);
                $('#form-edit').find('#parent_id').val(response.parent_id).trigger('change');
                $('#form-edit').find('#url').val(response.url);
                $('#form-edit').find('#icon').val(response.icon);
                $('#form-edit').find('#order').val(response.order);
                $('#form-edit').find('#active').val(response.active).trigger('change');
                $('#form-edit').find('#display').val(response.display).trigger('change');
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data.',
                });
            }
        });
    });
</script>
@endpush
