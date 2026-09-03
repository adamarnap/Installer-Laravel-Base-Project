{{-- Start: Modal Toggle --}}
<button type="button" id="modalRunMigrationToggle" data-modal-toggle="modalRunMigration" data-modal-target="modalRunMigration" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalRunMigration" tabindex="-1" aria-labelledby="modalRunMigrationLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-player-play text-primary text-xl"></i>
                        <h4 class="modal-title" id="modalRunMigrationLabel">Jalankan Migrasi Database</h4>
                    </div>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalRunMigration">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Run Migration --}}
                <form action="{{ route('settings.migrations.run') }}" method="POST">
                    @csrf
                    <input type="hidden" name="migration" id="modal-input-migration-name" value="">
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <p id="modal-migration-desc" class="text-xs text-gray-600">
                            Sistem akan mengeksekusi file migrasi ke dalam database.
                        </p>
                        <div class="p-3 bg-gray-100 rounded-md border border-gray-200">
                            <span class="text-xs text-gray-500 block mb-1">Command Artisan:</span>
                            <code id="modal-migration-command" class="text-xs font-mono font-bold text-primary">php artisan migrate</code>
                        </div>
                        <div>
                            <label class="form-label">
                                Konfirmasi Password Akun Anda <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" required placeholder="Masukkan password Anda..." class="form-control">
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalRunMigration">Batal</button>
                        <button type="submit" class="btn bg-primary text-white inline-flex items-center gap-1.5">
                            <i class="ti ti-player-play"></i> Jalankan Migrasi
                        </button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Run Migration --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
