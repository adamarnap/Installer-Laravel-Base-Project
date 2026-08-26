<div class="trezo-card-header mb-[20px] md:mb-[25px] flex items-center justify-between">
    <div class="trezo-card-title">
        <h5 class="!mb-0">
            Example
        </h5>
    </div>
</div>

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

    {{-- START: Textarea --}}
    <div>
        <label class="mb-[12px] font-medium block">
            Textarea
            <strong class="text-red-500">*</strong>
        </label>
        <textarea name="textarea" class="h-[140px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] p-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" placeholder="It makes me feel..."></textarea>
    </div>
    {{-- END: Textarea --}}
    
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

    {{-- START: Form Group --}}
    <div>
        <label class="mb-[12px] font-medium block">
            Nominal Setoran
            <strong class="text-red-500">*</strong>
        </label>
        <div class="mt-2">
            <div class="h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] flex items-center transition-all focus-within:border-primary-500">
                <div class="shrink-0 text-base text-gray-500 dark:text-gray-400 select-none mr-3">$</div>
                <input id="price" type="text" name="price" placeholder="0.00" class="block min-w-0 grow bg-transparent py-1.5 text-black dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 outline-0" />
            </div>
        </div>
    </div>
    {{-- END: Form Group --}}
</div>