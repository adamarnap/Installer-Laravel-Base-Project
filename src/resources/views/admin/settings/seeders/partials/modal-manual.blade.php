{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalManualSeeder" tabindex="-1" aria-labelledby="modalManualSeederLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-terminal text-primary text-xl"></i>
                        <h4 class="modal-title" id="modalManualSeederLabel">Jalankan Seeder Manual</h4>
                    </div>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalManualSeeder">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Manual Seeder --}}
                <form id="form-manual-seeder-modal" action="{{ route('settings.seeders.run') }}" method="POST">
                    @csrf
                    <input type="hidden" name="seeder_class" id="input-modal-seeder-class" value="">
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <p class="text-xs text-gray-600">
                            Gunakan opsi ini untuk mengeksekusi class seeder aplikasi, database seeder, atau package seeder dengan konfirmasi otorisasi.
                        </p>
                        <div>
                            <label class="form-label">
                                Class / Identifier Seeder <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" id="manual-seeder-input-class" required placeholder="Contoh: DatabaseSeeder atau UserSeeder" class="form-control font-mono">
                            <p class="text-[11px] text-gray-400 mt-1">Hanya class yang valid dan meng-extend <code class="text-primary font-mono font-semibold">Illuminate\Database\Seeder</code> yang dapat dijalankan.</p>
                        </div>
                        <div>
                            <label class="form-label">
                                Konfirmasi Password Akun Anda <strong class="text-red-500">*</strong>
                            </label>
                            <input type="password" name="password" id="manual-seeder-input-password" required placeholder="Masukkan password akun Anda..." class="form-control">
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalManualSeeder">Batal</button>
                        <button type="submit" class="btn bg-primary text-white inline-flex items-center gap-1.5">
                            <i class="ti ti-player-play"></i> Konfirmasi & Jalankan
                        </button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Manual Seeder --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
