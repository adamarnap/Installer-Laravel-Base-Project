<!-- Sidebar -->
<div class="sidebar-area bg-white dark:bg-[#0c1427] fixed overflow-hidden z-[7] top-0 h-screen transition-all rounded-r-md" id="sidebar-area">
    <div class="logo bg-white dark:bg-[#0c1427] border-b border-gray-100 dark:border-[#172036] px-[25px] pt-[19px] pb-[15px] absolute z-[2] right-0 top-0 left-0">
        <a href="index.html" class="transition-none relative flex items-center">
            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo-icon">
            <span class="font-bold text-black dark:text-white relative ltr:ml-[8px] rtl:mr-[8px] top-px text-xl">
                {{ $prefs_composer['title'] }}
            </span>
        </a>
        <button type="button" class="burger-menu inline-block absolute z-[3] top-[24px] ltr:right-[25px] rtl:left-[25px] transition-all hover:text-primary-500" id="hide-sidebar-toggle2">
            <i class="material-symbols-outlined">
                close
            </i>
        </button>
    </div>
    <div class="pt-[89px] px-[25px] pb-[20px] h-screen" data-simplebar>
        {{-- Start : List Menu --}}
        @include('layouts.admin.partials.menu-list')
        {{-- End : List Menu --}}
    </div>
</div>
<!-- End Sidebar -->