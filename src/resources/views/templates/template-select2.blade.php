@push('styles')
    {{-- Select2 CSS --}}
    <link href="{{ URL::asset('assets/admin/css/select2-4.1.0/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/admin/css/select2-4.1.0/select2-height-style.css') }}" rel="stylesheet" />
@endpush

{{-- START: Select 2 --}}
<div>
    <label class="mb-[12px] font-medium block">
        Role
        <strong class="text-red-500">*</strong>
    </label>
    <select name="roles[]" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500" multiple required>
        @foreach ($roles as $role)
            @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endif
        @endforeach
    </select>
</div>
{{-- END: Select 2 --}}

@push('scripts')
    {{-- Start Select 2 --}}
    <script src="{{ URL::asset('assets/admin/js/select2-4.1.0/select2.min.js') }}"></script>    
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    {{-- End Select 2 --}}
    
@endpush