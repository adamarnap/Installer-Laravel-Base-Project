@extends('layouts.admin.master')

@section('title', 'Hak Akses Peran')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles-permissions', $role->id, $role->name) }}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush


@section('content')
    <!-- START: Data Table -->
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar @yield('title')
                </h5>
            </div>
            {{-- START: Tambah Data --}}
            @can('settings-users.create')
                <div class="trezo-card-subtitle sm:flex sm:items-center">
                    <div class="trezo-card-dropdown relative">
                        <button data-url="{{ route('settings.roles.index') }}" class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-gray-500 text-white transition-all hover:bg-gray-400 rounded-md border border-gray-500 hover:border-gray-400" 
                            type="button" onclick="window.location.href=this.getAttribute('data-url')">
                            <i class="ri-arrow-go-back-line"></i>
                            Back
                        </button>

                        <button class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-danger-500 text-white transition-all hover:bg-danger-400 rounded-md border border-danger-500 hover:border-danger-400" type="submit" onclick="submitForm()">
                            <i class="ri-save-line"></i>
                            Save @yield('title')
                        </button>
                    </div>
                </div>
            @endcan
            {{-- END: Tambah Data --}}
        </div>
        {{-- START: Data Table --}}
        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                {{-- Start: Form Update Permissions --}}
                <form action="{{ route('settings.roles.permissions', $role->id) }}" id="permissions-form" method="POST">
                    @csrf
                    @method('PUT')
                    <table id="data-table" class="display stripe group" style="width:100%">
                        <thead>
                            <th class="text-center">Menu</th>
                            <th class="text-center">All</th>
                            <th class="text-center">Read</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @can('settings-roles.read')    
                                @forelse ($navigations as $nav)
                                    {{-- Start single & parent navs --}}
                                    <tr class="">
                                        {{-- Start Nav Icon & Name --}}
                                        <td class="text-left align-middle">
                                            <div class="flex items-center gap-2">
                                                <i class="material-symbols-outlined transition-all text-gray-500 dark:text-gray-400 !text-[22px] leading-none relative -top-px">
                                                    {{ $nav['icon'] }}
                                                </i>
                                                <span class="title leading-none text-left">
                                                    {{ $nav['name'] }}
                                                </span>
                                            </div>
                                        </td>
                                        {{-- End Nav Icon & Name --}}

                                        {{-- Start Select All Checkbox --}}
                                        <td class="text-center">
                                            <div class="flex justify-center">
                                                <input type="checkbox" class="check-all size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-purple-500 checked:border-purple-500 dark:checked:bg-purple-500 dark:checked:border-purple-500" data-id="{{ $nav->id }}">
                                            </div>
                                        </td>
                                        {{-- End Select All Checkbox --}}

                                        {{-- Start Permissions (Read) --}}
                                        <td class="text-center">
                                            <div class="flex justify-center">
                                                <input id="checkbox_{{ $nav->id }}_read" name="permissions[]"
                                            type="checkbox" value="{{ strtolower($nav->slug) . '.read' }}"
                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                            {{ in_array(strtolower($nav->slug) . '.read', $permissions) ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        {{-- End Permissions (Read) --}}
                                        
                                        {{-- Start Permissions (Create) --}}
                                        <td class="text-center">
                                            <div class="flex justify-center">
                                                <input id="checkbox_{{ $nav->id }}_create" name="permissions[]"
                                            type="checkbox" value="{{ strtolower($nav->slug) . '.create' }}"
                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                            {{ in_array(strtolower($nav->slug) . '.create', $permissions) ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        {{-- End Permissions (Create) --}}

                                        {{-- Start Permissions (Update) --}}
                                        <td class="text-center">
                                            <div class="flex justify-center">
                                                <input id="checkbox_{{ $nav->id }}_update" name="permissions[]"
                                            type="checkbox" value="{{ strtolower($nav->slug) . '.update' }}"
                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                            {{ in_array(strtolower($nav->slug) . '.update', $permissions) ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        {{-- End Permissions (Update) --}}

                                        {{-- Start Permissions (Delete) --}}
                                        <td class="text-center">
                                            <div class="flex justify-center">
                                                <input id="checkbox_{{ $nav->id }}_delete" name="permissions[]"
                                            type="checkbox" value="{{ strtolower($nav->slug) . '.delete' }}"
                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                            {{ in_array(strtolower($nav->slug) . '.delete', $permissions) ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        {{-- End Permissions (Delete) --}}
                                    </tr>
                                    {{-- End single & parent navs --}}
                                    
                                    {{-- Start child navs --}}
                                    @if ($nav->child->count() > 0)
                                        @foreach ($nav->child as $child)
                                            <tr class="">
                                                {{-- Start Child Nav Icon & Name --}}
                                                <td class="text-left align-middle border-l-4 border-blue-500">
                                                    <div class="flex items-center gap-2 mr-4 pl-4">
                                                        <div class="col-span">
                                                            <i class="material-symbols-outlined text-blue-500 !text-[18px]">
                                                                subdirectory_arrow_right
                                                            </i>
                                                        </div> 
                                                        <div class="title leading-none text-left font-medium">
                                                            {{ $child->name ?? '-' }}
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- End Child Nav Icon & Name --}}

                                                {{-- Start Select All Checkbox --}}
                                                <td class="text-center">
                                                    <div class="flex justify-center">
                                                        <input type="checkbox" class="check-all size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-purple-500 checked:border-purple-500 dark:checked:bg-purple-500 dark:checked:border-purple-500" data-id="{{ $child->id }}">
                                                    </div>
                                                </td>
                                                {{-- End Select All Checkbox --}}

                                                {{-- Start Permissions (Read) --}}
                                                <td class="text-center">
                                                    <div class="flex justify-center">
                                                        <input id="checkbox_{{ $child->id }}_read" name="permissions[]"
                                                    type="checkbox" value="{{ strtolower($child->slug) . '.read' }}"
                                                    class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                    {{ in_array(strtolower($child->slug) . '.read', $permissions) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                {{-- End Permissions (Read) --}}
                                                
                                                {{-- Start Permissions (Create) --}}
                                                <td class="text-center">
                                                    <div class="flex justify-center">
                                                        <input id="checkbox_{{ $child->id }}_create" name="permissions[]"
                                                    type="checkbox" value="{{ strtolower($child->slug) . '.create' }}"
                                                    class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                    {{ in_array(strtolower($child->slug) . '.create', $permissions) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                {{-- End Permissions (Create) --}}

                                                {{-- Start Permissions (Update) --}}
                                                <td class="text-center">
                                                    <div class="flex justify-center">
                                                        <input id="checkbox_{{ $child->id }}_update" name="permissions[]"
                                                    type="checkbox" value="{{ strtolower($child->slug) . '.update' }}"
                                                    class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                    {{ in_array(strtolower($child->slug) . '.update', $permissions) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                {{-- End Permissions (Update) --}}

                                                {{-- Start Permissions (Delete) --}}
                                                <td class="text-center">
                                                    <div class="flex justify-center">
                                                        <input id="checkbox_{{ $child->id }}_delete" name="permissions[]"
                                                    type="checkbox" value="{{ strtolower($child->slug) . '.delete' }}"
                                                    class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                    {{ in_array(strtolower($child->slug) . '.delete', $permissions) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                {{-- End Permissions (Delete) --}}
                                            </tr>

                                            {{-- Start subChild navs (Level 3) --}}
                                            @if ($child->subChild->count() > 0)
                                                @foreach ($child->subChild as $subChild)
                                                    <tr class="">
                                                        {{-- Start SubChild Nav Icon & Name --}}
                                                        <td class="text-left align-middle border-l-4 border-green-500">
                                                            <div class="flex items-center gap-2 mr-4 pl-8">
                                                                <div class="col-span">
                                                                    <i class="material-symbols-outlined text-green-500 !text-[16px]">
                                                                        arrow_right
                                                                    </i>
                                                                </div> 
                                                                <div class="title leading-none text-left">
                                                                    {{ $subChild->name ?? '-' }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{-- End SubChild Nav Icon & Name --}}

                                                        {{-- Start Select All Checkbox --}}
                                                        <td class="text-center">
                                                            <div class="flex justify-center">
                                                                <input type="checkbox" class="check-all size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-purple-500 checked:border-purple-500 dark:checked:bg-purple-500 dark:checked:border-purple-500" data-id="{{ $subChild->id }}">
                                                            </div>
                                                        </td>
                                                        {{-- End Select All Checkbox --}}

                                                        {{-- Start Permissions (Read) --}}
                                                        <td class="text-center">
                                                            <div class="flex justify-center">
                                                                <input id="checkbox_{{ $subChild->id }}_read" name="permissions[]"
                                                            type="checkbox" value="{{ strtolower($subChild->slug) . '.read' }}"
                                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                            {{ in_array(strtolower($subChild->slug) . '.read', $permissions) ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        {{-- End Permissions (Read) --}}
                                                        
                                                        {{-- Start Permissions (Create) --}}
                                                        <td class="text-center">
                                                            <div class="flex justify-center">
                                                                <input id="checkbox_{{ $subChild->id }}_create" name="permissions[]"
                                                            type="checkbox" value="{{ strtolower($subChild->slug) . '.create' }}"
                                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                            {{ in_array(strtolower($subChild->slug) . '.create', $permissions) ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        {{-- End Permissions (Create) --}}

                                                        {{-- Start Permissions (Update) --}}
                                                        <td class="text-center">
                                                            <div class="flex justify-center">
                                                                <input id="checkbox_{{ $subChild->id }}_update" name="permissions[]"
                                                            type="checkbox" value="{{ strtolower($subChild->slug) . '.update' }}"
                                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                            {{ in_array(strtolower($subChild->slug) . '.update', $permissions) ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        {{-- End Permissions (Update) --}}

                                                        {{-- Start Permissions (Delete) --}}
                                                        <td class="text-center">
                                                            <div class="flex justify-center">
                                                                <input id="checkbox_{{ $subChild->id }}_delete" name="permissions[]"
                                                            type="checkbox" value="{{ strtolower($subChild->slug) . '.delete' }}"
                                                            class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                            {{ in_array(strtolower($subChild->slug) . '.delete', $permissions) ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        {{-- End Permissions (Delete) --}}
                                                    </tr>
                                                @endforeach
                                            @endif
                                            {{-- End subChild navs (Level 3) --}}
                                        @endforeach
                                    @endif
                                    {{-- End child navs --}}
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada menu ditemukan</td>
                                    </tr>
                                @endforelse
                            @endcan
                        </tbody>
                    </table>
                </form>
                {{-- End: Form Update Permissions --}}
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    <!-- END: Data Table -->
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    {{-- Implement datatable --}}
    <script>
        /* Data Table */
        $(document).ready(function() {
            $('#data-table').DataTable({
                columns: [
                    { width: "50%" },
                    { width: "10%" },
                    { width: "10%" },
                    { width: "10%" },
                    { width: "10%" },
                    { width: "10%" }
                ],
                autoWidth: false,
                pageLength: 100,
                ordering: false
            });
        });

        /* Submit form */
        function submitForm() {
            document.getElementById('permissions-form').submit();
        }

        /* Check/Uncheck All Permissions in Row */
        $(document).on('change', '.check-all', function() {
            const menuId = $(this).data('id');
            const isChecked = $(this).prop('checked');
            
            // Check/uncheck all permission checkboxes for this menu
            $(`#checkbox_${menuId}_read`).prop('checked', isChecked);
            $(`#checkbox_${menuId}_create`).prop('checked', isChecked);
            $(`#checkbox_${menuId}_update`).prop('checked', isChecked);
            $(`#checkbox_${menuId}_delete`).prop('checked', isChecked);
        });

        /* Auto-check 'All' checkbox if all permissions are checked */
        $(document).on('change', 'input[type="checkbox"][id^="checkbox_"]', function() {
            // Get the menu ID from checkbox ID (format: checkbox_ID_permission)
            const checkboxId = $(this).attr('id');
            const matches = checkboxId.match(/checkbox_(\d+)_/);
            
            if (matches) {
                const menuId = matches[1];
                
                // Check if all permission checkboxes are checked
                const allChecked = 
                    $(`#checkbox_${menuId}_read`).prop('checked') &&
                    $(`#checkbox_${menuId}_create`).prop('checked') &&
                    $(`#checkbox_${menuId}_update`).prop('checked') &&
                    $(`#checkbox_${menuId}_delete`).prop('checked');
                
                // Update the 'All' checkbox accordingly
                $(`.check-all[data-id="${menuId}"]`).prop('checked', allChecked);
            }
        });

        /* Initialize 'All' checkboxes on page load */
        $(document).ready(function() {
            $('input[id^="checkbox_"]').each(function() {
                const checkboxId = $(this).attr('id');
                const matches = checkboxId.match(/checkbox_(\d+)_read/);
                
                if (matches) {
                    const menuId = matches[1];
                    const allChecked = 
                        $(`#checkbox_${menuId}_read`).prop('checked') &&
                        $(`#checkbox_${menuId}_create`).prop('checked') &&
                        $(`#checkbox_${menuId}_update`).prop('checked') &&
                        $(`#checkbox_${menuId}_delete`).prop('checked');
                    
                    $(`.check-all[data-id="${menuId}"]`).prop('checked', allChecked);
                }
            });
        });

        // Back button
    </script>
@endpush



