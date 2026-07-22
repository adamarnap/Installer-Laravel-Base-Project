{{-- Start: Modal Toggle --}}
<button type="button" id="modalEditToggle" data-modal-toggle="modalEdit" data-modal-target="modalEdit"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-full modal-lg">
            <div class="modal-content">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditLabel">
                        Edit Data @yield('title')
                    </h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalEdit">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Add --}}
                <form action="" method="POST" id="form-edit">
                    @csrf
                    {{-- Start: Modal Body --}}
                    <div class="modal-body">
                        ...       
                    </div>
                    {{-- End: Modal Body --}}
                </form>
                {{-- End: Form Add --}}

                {{-- Start: Modal Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2"
                        data-modal-hide="modalEdit">Batal</button>
                    <button type="button" class="btn bg-primary text-white">Simpan</button>
                </div>
                {{-- End: Modal Footer --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}

@push('scripts')
    {{-- Start: Modal & Get data By Ajax --}}
    <script>
        $(document).on('click', '.btnModalEdit', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#modalEditToggle').click();

            // User Id
            var userId = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
            // Send request to get user data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    // Modal title
                    $('#modal-title').text('Edit Data Pengguna - ' + response.name);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#name').val(response.name);
                    $('#form-edit').find('#username').val(response.username);
                    $('#form-edit').find('#email').val(response.email);
                    $('#form-edit').find('#role-select-edit').val(response.role_names).trigger('change');
                    $('#form-edit').find('#status').val(response.status).trigger('change');
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data.',
                    });
                }
            });
        });        
    </script>
    {{-- End: Modal & Get data By Ajax --}}
@endpush
