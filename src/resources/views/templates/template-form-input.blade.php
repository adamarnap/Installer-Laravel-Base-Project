<div class="grid grid-cols-1 sm:grid-cols-3 gap-[20px] md:gap-[25px]">
    {{-- START: Name --}}
    <div>
        <label class="mb-[12px] font-medium block">
            Name
            <strong class="text-red-500">*</strong>
        </label>
        <input type="text" name="name" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" placeholder="name@example.com">
    </div>
    {{-- END: Name --}}

    {{-- START: Email --}}
    <div>
        <label class="mb-[12px] font-medium block">
            Email
            <strong class="text-red-500">*</strong>
        </label>
        <input type="email" name="email" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" placeholder="name@example.com">
    </div>
    {{-- END: Email --}}
    
    {{-- START: Role --}}
    <div>
        <label class="mb-[12px] font-medium block">
            Role
        </label>
        <select name="roles[]" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500">
            <option selected>- Select Role -</option>
            @foreach ($roles as $role)
                @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endif
            @endforeach
        </select>

        <select name="roles[]" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500">
            <option selected>- Select Role -</option>
            @foreach (\App\Enums\JenisKelompokBinaanEnum::cases() as $enum)
                <option value="{{ $enum->value }}">{{ $enum->label() }}</option>
            @endforeach
        </select>
    </div>
    {{-- END: Role --}}
</div>