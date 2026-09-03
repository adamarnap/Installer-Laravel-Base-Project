{{-- Start: Modal Toggle --}}
<button type="button" id="modalExecuteToggle" data-modal-toggle="modalCacheExecute" data-modal-target="modalCacheExecute" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalCacheExecute" tabindex="-1" aria-labelledby="modalCacheExecuteLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-bolt text-primary text-xl"></i>
                        <h4 class="modal-title" id="modalCacheExecuteLabel">Konfirmasi Eksekusi Aksi Cache</h4>
                    </div>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalCacheExecute">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Cache Execute --}}
                <form action="{{ route('settings.cache.execute') }}" method="POST">
                    @csrf
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <div>
                            <label class="form-label">
                                Pilih Operasi / Aksi Cache <strong class="text-red-500">*</strong>
                            </label>
                            <select name="action" id="modal-cache-select-action" class="form-control" required>
                                <option value="optimize">Optimize Framework (php artisan optimize)</option>
                                <option value="optimize_clear">Optimize Clear (php artisan optimize:clear)</option>
                                <option value="config_cache">Config Cache (php artisan config:cache)</option>
                                <option value="config_clear">Config Clear (php artisan config:clear)</option>
                                <option value="route_cache">Route Cache (php artisan route:cache)</option>
                                <option value="route_clear">Route Clear (php artisan route:clear)</option>
                                <option value="view_cache">View Cache (php artisan view:cache)</option>
                                <option value="view_clear">View Clear (php artisan view:clear)</option>
                                <option value="event_cache">Event Cache (php artisan event:cache)</option>
                                <option value="event_clear">Event Clear (php artisan event:clear)</option>
                                <option value="cache_clear">Flush Application Data Cache (php artisan cache:clear)</option>
                            </select>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-md border border-gray-200">
                            <span class="text-xs text-gray-500 block mb-1">Command yang akan dieksekusi:</span>
                            <code id="modal-cache-command-text" class="text-xs font-mono font-bold text-primary">php artisan optimize</code>
                        </div>
                        <p id="modal-cache-desc-text" class="text-xs text-gray-600">
                            Melakukan caching konfigurasi, rute, dan file framework untuk performa maksimal.
                        </p>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalCacheExecute">Batal</button>
                        <button type="submit" class="btn bg-primary text-white inline-flex items-center gap-1.5">
                            <i class="ti ti-player-play"></i> Jalankan Command
                        </button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Cache Execute --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
