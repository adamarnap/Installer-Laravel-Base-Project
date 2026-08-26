{{-- START: Select 2 --}}
<div>
    <label class="mb-[12px] font-medium block">
        Role
        <strong class="text-red-500">*</strong>
    </label>
    <select name="roles[]" class="select2 form-input" multiple required>
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
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    {{-- End Select 2 --}}
    
@endpush