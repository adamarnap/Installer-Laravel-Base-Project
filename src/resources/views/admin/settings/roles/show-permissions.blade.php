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
    <div class="grid grid-cols-1 gap-base">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar @yield('title')</h4>

                @can('settings-roles.update')
                    <div class="flex items-center gap-2">
                        <a href="{{ route('settings.roles.index') }}" class="btn bg-dark text-white hover:bg-warning">
                            <i class="iconify tabler--arrow-back-up text-xs"></i>
                            Back
                        </a>

                        <button type="button" class="btn bg-danger text-white hover:bg-danger-hover" onclick="submitForm()">
                            <i class="iconify tabler--device-floppy text-xs"></i>
                            Save @yield('title')
                        </button>
                    </div>
                @endcan
            </div>

            <div class="card-body">
                <form action="{{ route('settings.roles.permissions', $role->id) }}" id="permissions-form" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="table-wrapper -mb-4">
                        <table id="data-table" class="table table-striped group">
                            <thead class="thead-sm uppercase text-2xs">
                                <tr>
                                    <th class="text-center">Menu</th>
                                    <th class="text-center">All</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            @can('settings-roles.read')    
                                @forelse ($navigations as $nav)
                                    {{-- Start single & parent navs --}}
                                    <tr class="">
                                        {{-- Start Nav Icon & Name --}}
                                        <td class="text-left align-middle">
                                            <div class="flex items-center gap-2">
                                                <i class="iconify tabler--{{ str_replace('_', '-', $nav['icon']) }} transition-all text-gray-500 dark:text-gray-400 text-xs leading-none relative -top-px"></i>
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
                                                            <i class="iconify tabler--dots text-blue-500 text-xs"></i>
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
                                                                    <i class="iconify tabler--dots text-blue-500 text-xs"></i><i class="iconify tabler--dots text-blue-500 text-xs"></i>
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
                                        <td colspan="6" class="text-center">Tidak ada menu ditemukan</td>
                                    </tr>
                                @endforelse
                            @endcan
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    </script>
@endpush
