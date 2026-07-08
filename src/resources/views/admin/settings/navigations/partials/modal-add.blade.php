<div id="modal-add" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 pointer-events-none fixed inset-0 z-80 hidden size-full overflow-x-hidden overflow-y-auto opacity-0 transition-all" role="dialog" tabindex="-1" aria-labelledby="modal-add-label">
    <div class="hs-overlay-animation-target m-3 sm:mx-auto sm:w-full sm:max-w-xl lg:max-w-4xl">
        <div class="border-default-300 pointer-events-auto flex flex-col rounded-md border card">
            <div class="border-default-300 flex items-center justify-between border-b p-6">
                <div>
                    <h3 id="modal-add-label" class="text-base font-semibold">Add Data @yield('title')</h3>
                    <p class="text-default-400 text-sm">Buat menu baru beserta atribut tampilan dan permission-nya.</p>
                </div>

                <button type="button" aria-label="Close" data-hs-overlay="#modal-add">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-xl"></i>
                </button>
            </div>

            <form action="{{ route('settings.navs.store') }}" method="POST">
                @csrf
                <div class="overflow-y-auto card-body">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <label class="mb-[12px] block font-medium">
                                Menu Name
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" id="name" class="form-input" placeholder="Fill menu name ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Permission Identifier
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="slug" id="slug" class="form-input" placeholder="Fill permission identifier ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Parent Menu</label>
                            <select name="parent_id" id="parent_id" class="form-select select2">
                                <option value="">- Select Parent Menu -</option>
                                @foreach ($parentNavigations as $nav)
                                    <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                URL
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="url" id="url" class="form-input" placeholder="Route name menu ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-input" placeholder="Fill icon name, here use Material Icons ...">
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Order
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="number" name="order" id="order" class="form-input" placeholder="Number of order menu ..." required>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Is Active
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="active" id="active" class="form-select select2" required>
                                <option value="">- Select Status Active -</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] block font-medium">
                                Is Display
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="display" id="display" class="form-select select2" required>
                                <option value="">- Select Status Display -</option>
                                <option value="1">Display</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-default-300 flex items-center justify-end border-t p-4">
                    <button type="button" class="btn bg-light hover:text-primary m-1" data-hs-overlay="#modal-add">Close</button>
                    <button type="submit" class="btn bg-primary hover:bg-primary-hover m-1 rounded text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
