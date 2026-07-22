{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-full modal-lg">
            <div class="modal-content">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAddLabel">
                        Add Data @yield('title')
                    </h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalAdd">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Add --}}
                <form action="{{ route('settings.users.store') }}" method="POST">
                    @csrf
                    {{-- Start: Modal Body --}}
                    <div class="modal-body">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            {{-- START: Name --}}
                            <div class="md:col-span-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Nama Lengkap
                                        <strong class="text-red-500">*</strong>
                                    </label>
                                    <input type="text" name="name"
                                        class="form-control"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>
                            {{-- END: Name --}}

                            {{-- START: Email --}}
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Email
                                        <strong class="text-red-500">*</strong>
                                    </label>
                                    <input type="email" name="email"
                                        class="form-control"
                                        placeholder="Masukkan email pengguna" required>
                                </div>
                            </div>
                            {{-- END: Email --}}

                            {{-- START: Role --}}
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Role
                                        <strong class="text-red-500">*</strong>
                                    </label>
                                    <select name="roles[]"
                                        class="select2 form-control"
                                        multiple required>
                                        @foreach ($roles as $role)
                                            @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- END: Role --}}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Password
                                        <strong class="text-red-500">*</strong>
                                    </label>
                                    <input type="password" name="password"
                                        class="form-control"
                                        placeholder="Masukkan password pengguna" required>
                                </div>
                            </div>
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Konfirmasi  Password
                                        <strong class="text-red-500">*</strong>
                                    </label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control"
                                        placeholder="Konfirmasikan password pengguna" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalAdd">Batal</button>
                        <button type="button" class="btn bg-primary text-white">Simpan</button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Add --}}

            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
