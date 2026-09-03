{{-- Start: Modal Toggle --}}
<button type="button" id="modalDetailToggle" data-modal-toggle="modalLogDetail" data-modal-target="modalLogDetail" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalLogDetail" tabindex="-1" aria-labelledby="modalLogDetailLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLogDetailLabel">
                        Detail Eksekusi Task
                    </h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalLogDetail">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Modal Body --}}
                <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs bg-gray-50 p-3 rounded border border-gray-100">
                        <div>
                            <span class="text-gray-500 font-semibold block">Nama Task:</span>
                            <span id="log-modal-name" class="font-bold text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-gray-500 font-semibold block">Waktu Eksekusi:</span>
                            <span id="log-modal-time" class="text-gray-700"></span>
                        </div>
                        <div>
                            <span class="text-gray-500 font-semibold block">Command:</span>
                            <code id="log-modal-command" class="text-primary font-mono font-bold"></code>
                        </div>
                        <div>
                            <span class="text-gray-500 font-semibold block">Durasi & Status:</span>
                            <span id="log-modal-status"></span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label block mb-1">Output Console:</label>
                        <pre id="log-modal-output" class="bg-gray-900 text-gray-100 rounded p-3 text-xs font-mono overflow-x-auto max-h-[200px] whitespace-pre-wrap"></pre>
                    </div>

                    <div id="log-modal-error-wrapper" class="hidden">
                        <label class="form-label text-danger block mb-1">Pesan Error:</label>
                        <pre id="log-modal-error" class="bg-red-950 text-red-300 rounded p-3 text-xs font-mono overflow-x-auto max-h-[160px] whitespace-pre-wrap"></pre>
                    </div>
                </div>
                {{-- End: Modal Body --}}

                {{-- Start: Modal Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-modal-hide="modalLogDetail">Tutup</button>
                </div>
                {{-- End: Modal Footer --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
