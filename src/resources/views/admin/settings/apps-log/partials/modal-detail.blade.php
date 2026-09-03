{{-- Start: Modal Toggle --}}
<button type="button" id="modalDetailToggle" data-modal-toggle="modalLogDetail" data-modal-target="modalLogDetail" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalLogDetail" tabindex="-1" aria-labelledby="modalLogDetailLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[850px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <div class="flex items-center gap-2">
                        <span id="modal-level-badge"></span>
                        <h4 class="modal-title font-bold text-gray-800" id="modalLogDetailLabel">Detail Entri Log</h4>
                    </div>
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
                    {{-- Start: Metadata Info --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="bg-gray-50 p-3 rounded border border-gray-200">
                            <label class="form-label text-[11px] font-bold uppercase text-gray-500 flex items-center gap-1.5 mb-1">
                                <i class="ti ti-calendar text-sm text-primary"></i> Waktu Kejadian
                            </label>
                            <p id="modal-timestamp" class="text-sm font-semibold text-gray-800 font-mono">-</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded border border-gray-200">
                            <label class="form-label text-[11px] font-bold uppercase text-gray-500 flex items-center gap-1.5 mb-1">
                                <i class="ti ti-server text-sm text-primary"></i> Environment & Level
                            </label>
                            <p id="modal-env" class="text-sm font-semibold text-gray-800 uppercase font-mono">-</p>
                        </div>
                    </div>
                    {{-- End: Metadata Info --}}

                    {{-- Start: Log Message --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="form-label text-[11px] font-bold uppercase text-gray-500 flex items-center gap-1">
                                <i class="ti ti-message-2 text-sm text-primary"></i> Pesan Log
                            </label>
                            <button type="button" id="btn-copy-message" class="text-xs text-primary hover:text-primary-hover flex items-center gap-1 font-medium cursor-pointer">
                                <i class="ti ti-copy"></i> Salin Pesan
                            </button>
                        </div>
                        <pre id="modal-message" class="bg-gray-50 text-gray-800 border border-gray-200 rounded p-3.5 text-xs font-mono whitespace-pre-wrap break-all max-h-[220px] overflow-y-auto leading-relaxed"></pre>
                    </div>
                    {{-- End: Log Message --}}

                    {{-- Start: Stack Trace --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="form-label text-[11px] font-bold uppercase text-gray-500 flex items-center gap-1">
                                <i class="ti ti-code text-sm text-primary"></i> Stack Trace / Detail Teknis
                            </label>
                            <button type="button" id="btn-copy-stacktrace" class="text-xs text-primary hover:text-primary-hover flex items-center gap-1 font-medium cursor-pointer hidden">
                                <i class="ti ti-copy"></i> Salin Stack Trace
                            </button>
                        </div>
                        <pre id="modal-stacktrace" class="bg-gray-900 text-gray-100 rounded p-4 text-xs font-mono whitespace-pre-wrap break-all max-h-[280px] overflow-y-auto leading-relaxed hidden"></pre>
                        <div id="modal-no-stacktrace" class="bg-gray-50 border border-dashed border-gray-200 text-gray-500 rounded p-3 text-xs italic flex items-center gap-2">
                            <i class="ti ti-info-circle text-base"></i> Tidak ada stack trace untuk entri log ini.
                        </div>
                    </div>
                    {{-- End: Stack Trace --}}
                </div>
                {{-- End: Modal Body --}}

                {{-- Start: Modal Footer --}}
                <div class="modal-footer flex items-center justify-between flex-wrap gap-2">
                    <button type="button" id="btn-copy-all-log" class="btn bg-light border border-borderColor text-gray-700 hover:bg-gray-200 text-xs inline-flex items-center gap-1.5 py-2 px-3 cursor-pointer">
                        <i class="ti ti-copy"></i> Salin Seluruh Info Log
                    </button>
                    <button type="button" class="btn btn-light" data-modal-hide="modalLogDetail">Tutup</button>
                </div>
                {{-- End: Modal Footer --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
