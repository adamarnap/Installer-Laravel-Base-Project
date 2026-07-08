<button id="modal-edit-toggle" type="button" class="hidden" data-hs-overlay="#modal-edit"></button>

<div id="modal-edit" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-title">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-xl lg:max-w-4xl">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-title" class="text-base font-semibold">Edit Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Perbarui nilai preferensi atau unggah asset baru.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-edit">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form id="form-edit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="is_asset" id="is_asset">

                <div class="overflow-y-auto card-body space-y-6">
                    <div class="rounded-lg border border-dashed border-default-300 p-5" id="content-asset">
                        <div class="flex flex-col gap-5 md:flex-row md:items-center">
                            <img src="" alt="preference-preview" class="h-28 w-28 rounded-md object-cover" id="content-asset-preview--image">
                            <div class="flex-1">
                                <h5 class="mb-2">Asset Preview</h5>
                                <p class="text-default-400 mb-4 text-sm" id="content-asset-preview--text"></p>
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                                    <div>
                                        <label class="mb-[12px] block font-medium">Path</label>
                                        <input type="text" name="path" id="path" class="form-input" readonly>
                                    </div>
                                    <div>
                                        <label class="mb-[12px] block font-medium">File Name</label>
                                        <input type="text" name="file_name" id="file_name" class="form-input" readonly>
                                    </div>
                                    <div>
                                        <label class="mb-[12px] block font-medium">Upload File</label>
                                        <input type="file" name="file_asset" id="file_asset" class="form-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-form-value">
                        <label class="mb-[12px] block font-medium">
                            Value
                            <strong class="text-red-500">*</strong>
                        </label>
                        <textarea name="value" id="value" rows="6" class="form-textarea" placeholder="Fill preference value ..." required></textarea>
                    </div>
                </div>

                <div class="border-default-300 flex items-center justify-end border-t p-4">
                    <button type="button" class="btn bg-light hover:text-primary m-1" data-hs-overlay="#modal-edit">Close</button>
                    <button type="submit" class="btn bg-primary hover:bg-primary-hover m-1 rounded text-white">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).on('click', '.btn-modal-edit-pref', function(e) {
        e.preventDefault();

        $('#modal-edit-toggle').trigger('click');

        var urlFormAction = $(this).data('url-action');
        var urlGetData = $(this).data('url-get');

        $.ajax({
            url: urlGetData,
            type: 'GET',
            success: function(response) {
                $('#modal-title').text('Edit Data Preference - ' + response.name);
                $('#form-edit').attr('action', urlFormAction);
                $('#form-edit').find('#value').val(response.value);

                if (response.is_asset) {
                    $('#content-asset').show();
                    $('#content-form-value').hide();
                    $('#form-edit').find('#file_asset').attr('required', true);
                    $('#is_asset').val('1');

                    var filepath = response.value;
                    var filename = filepath.substring(filepath.lastIndexOf('/') + 1);
                    var directory = filepath.substring(0, filepath.lastIndexOf('/'));
                    var baseUrl = window.location.origin;
                    var imgSrc = baseUrl + '/' + filepath;

                    $('#form-edit').find('#path').val(directory + '/');
                    $('#form-edit').find('#file_name').val(filename);
                    $('#content-asset-preview--image').attr('src', imgSrc);
                    $('#content-asset-preview--text').text(filename);
                } else {
                    $('#content-asset').hide();
                    $('#content-form-value').show();
                    $('#is_asset').val('0');
                    $('#form-edit').find('#file_asset').removeAttr('required');
                }
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
