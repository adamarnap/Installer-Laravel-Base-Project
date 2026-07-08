<button id="modal-edit-toggle" type="button" class="hidden" data-hs-overlay="#modal-edit"></button>

<div id="modal-edit" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-title">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-title" class="text-base font-semibold">Edit Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Perbarui data pengguna secara langsung dari modal.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-edit">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form action="" method="POST" id="form-edit">
                @csrf
                @method('PUT')
                <div class="overflow-y-auto card-body">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-[12px] block font-medium">
                                Name
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="Insert user full name here ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Email
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="Insert user email here ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Role
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="roles[]" id="roles" class="form-select select2" multiple="multiple" required>
                                <option value="">- Select Role -</option>
                                @foreach ($roles as $role)
                                    @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Account Status
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="is_active" id="is_active" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Password</label>
                            <input type="password" name="password" class="form-input" placeholder="Insert user password here ...">
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Please retype user password for confirmation here ...">
                        </div>
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
    $(document).on('click', '.btn-modal-edit-user', function(e) {
        e.preventDefault();

        $('#modal-edit-toggle').trigger('click');

        var urlFormAction = $(this).data('url-action');
        var urlGetData = $(this).data('url-get');

        $.ajax({
            url: urlGetData,
            type: 'GET',
            success: function(response) {
                $('#modal-title').text('Edit Data Pengguna | ' + response.name);
                $('#form-edit').attr('action', urlFormAction);
                $('#form-edit').find('#name').val(response.name);
                $('#form-edit').find('#email').val(response.email);
                $('#form-edit').find('#roles').val(response.role_names).trigger('change');
                $('#form-edit').find('#is_active').val(response.is_active).trigger('change');
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
