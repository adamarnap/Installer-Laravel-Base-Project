{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalMigrateFresh" tabindex="-1" aria-labelledby="modalMigrateFreshLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header bg-danger-50">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-refresh-alert text-danger text-xl"></i>
                        <h4 class="modal-title text-danger" id="modalMigrateFreshLabel">Peringatan: Reset Database (Migrate Fresh)</h4>
                    </div>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalMigrateFresh">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Migrate Fresh --}}
                <form action="{{ route('settings.migrations.fresh') }}" method="POST">
                    @csrf
                    <input type="hidden" name="with_seed" value="1">
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <div class="p-3 bg-red-50 text-danger border border-red-200 rounded text-xs font-semibold">
                            PERHATIAN: Tindakan ini bersifat DESTRUKTIF! Seluruh tabel dan data akan DIHAPUS dan dibuat ulang dari awal beserta seed data.
                        </div>
                        <div class="p-3 bg-gray-100 rounded-md border border-gray-200">
                            <span class="text-xs text-gray-500 block mb-1">Command Artisan:</span>
                            <code class="text-xs font-mono font-bold text-danger">php artisan migrate:fresh --seed</code>
                        </div>
                        <div>
                            <label class="form-label">
                                Konfirmasi Password Akun Anda <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required placeholder="Masukkan password akun Anda untuk konfirmasi..." class="form-control">
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalMigrateFresh">Batal</button>
                        <button type="submit" class="btn bg-danger text-white inline-flex items-center gap-1.5">
                            <i class="ti ti-refresh-alert"></i> Saya Mengerti, Reset Database
                        </button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Migrate Fresh --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
