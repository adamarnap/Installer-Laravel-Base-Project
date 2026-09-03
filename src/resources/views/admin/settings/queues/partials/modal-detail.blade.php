{{-- Start: Modal Toggle --}}
<button type="button" id="modalDetailToggle" data-modal-toggle="modalExceptionDetail" data-modal-target="modalExceptionDetail" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalExceptionDetail" tabindex="-1" aria-labelledby="modalExceptionDetailLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <div class="flex items-center gap-2">
                        <span class="py-0.5 px-2.5 rounded text-xs font-bold uppercase bg-danger text-white">FAILED JOB</span>
                        <h4 class="modal-title" id="modalExceptionDetailLabel">Detail Exception & Payload</h4>
                    </div>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalExceptionDetail">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Modal Body --}}
                <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                    <div>
                        <label class="form-label uppercase text-gray-500 text-xs">UUID Job</label>
                        <p id="modal-uuid" class="text-xs font-mono text-gray-800 bg-gray-50 p-2 rounded border border-gray-200 mt-0.5"></p>
                    </div>
                    <div>
                        <label class="form-label uppercase text-gray-500 text-xs">Exception</label>
                        <pre id="modal-exception" class="bg-gray-900 text-red-400 rounded p-4 text-xs font-mono overflow-x-auto max-h-[250px] mt-0.5 whitespace-pre-wrap"></pre>
                    </div>
                    <div>
                        <label class="form-label uppercase text-gray-500 text-xs">Payload</label>
                        <pre id="modal-payload" class="bg-gray-100 text-gray-800 rounded p-4 text-xs font-mono overflow-x-auto max-h-[200px] mt-0.5 whitespace-pre-wrap"></pre>
                    </div>
                </div>
                {{-- End: Modal Body --}}

                {{-- Start: Modal Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-modal-hide="modalExceptionDetail">Tutup</button>
                </div>
                {{-- End: Modal Footer --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
