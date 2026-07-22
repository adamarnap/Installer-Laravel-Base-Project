{{-- Start: Modal Toggle --}}
<button type="button" class="btn bg-primary text-white mt-1" data-modal-toggle="modalAdd" data-modal-target="modalAdd">Tambah @yield('title')</button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel"
        aria-hidden="true">
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
                <form action="" method="POST">
                    @csrf
                    {{-- Start: Modal Body --}}
                    <div class="modal-body">
                        ...       
                    </div>
                    {{-- End: Modal Body --}}
                </form>
                {{-- End: Form Add --}}

                {{-- Start: Modal Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2"
                        data-modal-hide="modalAdd">Batal</button>
                    <button type="button" class="btn bg-primary text-white">Simpan</button>
                </div>
                {{-- End: Modal Footer --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}