<div id="modal-add" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-add-label">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-add-label" class="text-base font-semibold">Add Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Lengkapi detail pengguna baru di bawah ini.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-add">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form action="{{ route('settings.users.store') }}" method="POST">
                @csrf
                <div class="overflow-y-auto card-body">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-[12px] block font-medium">
                                Name
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" class="form-input" placeholder="Insert user full name here ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Email
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="email" name="email" class="form-input" placeholder="Insert user email here ..." required>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-[12px] block font-medium">
                                Role
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="roles[]" class="form-select select2" multiple required>
                                @foreach ($roles as $role)
                                    @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Password
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" class="form-input mb-3" placeholder="Insert user password here ..." required>
                            <div class="password-bar mb-3"></div>
                            <p class="text-default-400 text-2xs">Gunakan 8 atau lebih karakter dengan kombinasi huruf, angka & simbol.</p>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Password Confirmation
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Please retype user password for confirmation here ..." required>
                        </div>
                    </div>
                </div>

                <div class="border-default-300 flex items-center justify-end border-t p-4">
                    <button type="button" class="btn bg-light hover:text-primary m-1" data-hs-overlay="#modal-add">Close</button>
                    <button type="submit" class="btn bg-primary hover:bg-primary-hover m-1 rounded text-white">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Passwod Meter Plugin Js -->
    <script src="{{ URL::asset('assets/admin/js/pages/plugins-pass-meter.js') }}"></script>
@endpush