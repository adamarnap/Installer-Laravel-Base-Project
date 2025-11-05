{{-- Start list menus --}}
<div class="accordion">

    @foreach ($navs as $nav)
        {{-- Route prefix to determine menu activity  --}}
        @php
            /* 
            * ========================================================================================================
            * DISINI url nav yang bersumber dari DB yang tadinya hanya berupa nama route (ex : dashboard.index) telah diubah menjadi URL hasil dari route($nav->url)
            * Contoh jadinya, $nav['url'] = route('dashboard.index'), yang dimana hasilnya akan berbentuk URL (ex $nav['url'] : http://127.0.0.0:8000/admin/dashboard)
            * ========================================================================================================
            * ========================================================================================================
            * $navUrl, untuk mengambil path url dari menu yang diambil dari database
            * fungsi pase_url(), Fungsi ini digunakan untuk memecah sebuah URL menjadi komponen-komponennya, seperti skema, host, path, query, dll.
            * PHP_URL_PATH untuk mengambil path url yang berasal dari parse_url() yanng sebelumnya berupa array (skema, host, path, query, dll)
            * ltrim() untuk menghapus karakter spasi atau karakter lain dari sisi kiri string. Disini digunakan untuk menghapus karakter "/" dari sisi kiri string
            * Contoh: $navUrl = 127.0.0.0:8000/admin, maka hasilnya adalah admin
            * ========================================================================================================
            */
            $navUrl = ltrim(parse_url($nav['url'], PHP_URL_PATH), '/');
            /* 
            * ========================================================================================================
            * $routeName, untuk mengambil nama route yang sedang aktif
            * Contoh: routeName = admin.dashboard
            * ========================================================================================================
            */
            $routeName = Route::currentRouteName();
            /* 
            * ========================================================================================================
            * $routePrefix, untuk mengambil prefix dari route yang sedang aktif
            * Contoh: routeName = admin.dashboard, maka prefixnya adalah admin
            * ========================================================================================================
            */
            $routePrefix = explode('.', $routeName)[0];
        @endphp

        {{-- Determines between a single menu and a menu that has children --}}
        @if (count($nav['child']) == 0)
            {{-- Single menu --}}
            <div class="accordion-item rounded-md text-black dark:text-white mb-[5px] whitespace-nowrap">
                <a href="{{ $nav['url'] }}" class="{{ $routePrefix == $navUrl ? 'active' : '' }} accordion-button flex items-center transition-all py-[9px] ltr:pl-[14px] ltr:pr-[28px] rtl:pr-[14px] rtl:pl-[28px] rounded-md font-medium w-full relative hover:bg-gray-50 text-left dark:hover:bg-[#15203c]">
                    <i class="material-symbols-outlined transition-all text-gray-500 dark:text-gray-400 ltr:mr-[7px] rtl:ml-[7px] !text-[22px] leading-none relative -top-px">
                        {{ $nav['icon'] }}
                    </i>
                    <span class="title leading-none">
                        {{ $nav['name'] }}
                    </span>
                </a>
            </div>
        @else

        {{-- Menu with children --}}
        @php
            /* 
            * ========================================================================================================
            * $urlCurrent, untuk mengambil url yang sedang aktif
            *
            * Request::segments() untuk mengambil segment url yang sedang aktif
            * Contoh: Request::segments() = ['admin', 'dashboard'], maka hasilnya adalah admin/dashboard
            * Disini, karena induk menu, maka yang diambil hanya segment pertama saja
            * 
            * url('/') untuk mengambil url dari root project
            * Contoh: url('/') = 127.0.0.1:8000
            *
            * Lalu jika digabungkan, maka hasilnya adalah
            * Contoh: urlCurrent = 127.0.0.1:8000/admin/dashboard
            * ========================================================================================================

            * ========================================================================================================
            * Request::is untuk mengecek apakah request yang sedang aktif, sama dengan request yang diinginkan
            * Contoh: kita mendapati pengecekan dari parse_url($nav['url'], PHP_URL_PATH) yakni url dari DB yang hasilnya adalah admin/dashboard
            * Lalu kita cek [dengan menggunakan Request::is()] apakah request yang sedang aktif di browser, sama dengan admin/dashboard atau tidak
            * ========================================================================================================

            * ========================================================================================================
            * collect($nav['child'])->pluck('url') untuk mengambil kumpulan url dari child menu [anak dari parent menu tersebut] dari DB yang akan disajikan dalam bentuk array
            * Contoh: collect($nav['child'])->pluck('url') = ['admin/dashboard', 'admin/profile']
            * contains($urlCurrent) untuk mengecek apakah url yang sedang aktif, terdapat dalam array yang dihasilkan oleh collect($nav['child'])->pluck('url')
            * ========================================================================================================
            */
            $urlCurrent = url('/') . '/' . Request::segments()[0];
            
            // Tambahkan URL segment ke 2 jika ada
            if (isset(Request::segments()[1])) {
                $urlCurrent .= '/' . Request::segments()[1];
            }
        @endphp

        {{-- START: Menu Parent With Childs Menu --}}
        <div class="accordion-item rounded-md text-black dark:text-white mb-[5px] whitespace-nowrap">
            {{-- START: Parent Menu --}}
            <button class="accordion-button toggle {{ Request::is(ltrim(parse_url($nav['url'], PHP_URL_PATH), '/')) || collect($nav['child'])->pluck('url')->contains($urlCurrent)? 'open active': '' }} flex items-center transition-all py-[9px] ltr:pl-[14px] ltr:pr-[28px] rtl:pr-[14px] rtl:pl-[28px] rounded-md font-medium w-full relative hover:bg-gray-50 text-left dark:hover:bg-[#15203c]" type="button">
                <i class="material-symbols-outlined transition-all text-gray-500 dark:text-gray-400 ltr:mr-[7px] rtl:ml-[7px] !text-[22px] leading-none relative -top-px">
                    {{ $nav['icon'] }}
                </i>
                <span class="title leading-none">
                    {{ $nav['name'] }}
                </span>
            </button>
            {{-- END: Parent Menu --}}

            {{-- START: Menu Childs --}}
            <div class="accordion-collapse" style="display: {{ Request::is(ltrim(parse_url($nav['url'], PHP_URL_PATH), '/')) || collect($nav['child'])->pluck('url')->contains($urlCurrent)? 'block': 'none' }};">
                <div class="pt-[4px]">
                    <ul class="sidebar-sub-menu" id="{{ $nav['name'] }}-item-list">
                        {{-- START: Foreach List Childs Menu --}}
                        @foreach ($nav['child'] as $child)
                            <li class="sidemenu-item mb-[4px] last:mb-0">
                                <a href="{{ $child['url'] }}" class="{{ $urlCurrent == $child['url'] ? 'active' : '' }} sidemenu-link rounded-md flex items-center relative transition-all font-medium text-gray-500 dark:text-gray-400 py-[9px] ltr:pl-[38px] ltr:pr-[30px] rtl:pr-[38px] rtl:pl-[30px] hover:text-primary-500 hover:bg-primary-50 w-full text-left dark:hover:bg-[#15203c]">
                                    {{ $child['name'] }}
                                </a>
                            </li>
                        @endforeach
                        {{-- END: Foreach List Childs Menu --}}
                    </ul>
                </div>
            </div>
            {{-- END: Menu Childs --}}
        </div>
        {{-- END: Menu Parent With Childs Menu --}}
        @endif
    @endforeach
    <div class="accordion-item rounded-md text-black dark:text-white mb-[5px] whitespace-nowrap">
        {{-- START: Logout Button --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit" class="accordion-button flex items-center transition-all py-[9px] ltr:pl-[14px] ltr:pr-[28px] rtl:pr-[14px] rtl:pl-[28px] rounded-md font-medium w-full relative hover:bg-gray-50 text-left dark:hover:bg-[#15203c]">
                <i class="material-symbols-outlined transition-all text-gray-500 dark:text-gray-400 ltr:mr-[7px] rtl:ml-[7px] !text-[22px] leading-none relative -top-px">
                    logout
                </i>
                <span class="title leading-none">
                    Logout
                </span>
            </button>
        </form>
        {{-- END: Logout Button --}}
    </div>
</div>
{{-- End List Menus --}}