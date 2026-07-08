<div id="modal-add" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-add-label">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-add-label" class="text-base font-semibold">Add Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Tambahkan peran baru untuk pengelolaan akses.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-add">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form action="{{ route('settings.roles.store') }}" method="POST">
                @csrf
                <div class="overflow-y-auto card-body">
                    <div>
                        <label class="mb-[12px] block font-medium">
                            Name
                            <strong class="text-red-500">*</strong>
                        </label>
                        <input type="text" name="name" class="form-input" placeholder="Insert role name here ..." required>
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
