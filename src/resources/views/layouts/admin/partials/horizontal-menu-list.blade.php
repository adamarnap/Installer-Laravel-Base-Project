{{-- Start list menus --}}
{{-- START: TEMPLATE HTML BARU --}}
<ul class="nav-menu">
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
            @php
                $isSingleMenuActive = $routePrefix == $navUrl;
            @endphp
            <li class="{{ $isSingleMenuActive ? 'active' : '' }}">
                <a href="{{ $nav['url'] }}" class="{{ $isSingleMenuActive ? 'active' : '' }}">
                    <i class="ti {{ $nav['icon'] }} text-[16px] me-2" data-tooltip-placement="top"></i>
                    <span>{{ $nav['name'] }}</span>
                </a>
            </li>
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

            $isHaveSegment4 = false;
            // Tambahkan URL segment ke 2 jika ada
            if (isset(Request::segments()[1])) {
                $urlCurrent .= '/' . Request::segments()[1];
                $isHaveSegment4 = false;
            }
            // Tambahkan URL segment ke 3 jika ada
            if (isset(Request::segments()[2])) {
                $urlCurrent .= '/' . Request::segments()[2];
                $isHaveSegment4 = false;
            }
            // Tambahkan URL segment ke 4 jika ada
            if (isset(Request::segments()[3])) {
                $urlCurrent .= '/' . Request::segments()[3];
                $isHaveSegment4 = true;
            }

            $isParentActive = Request::is(ltrim(parse_url($nav['url'], PHP_URL_PATH), '/'));
            $hasActiveChild = collect($nav['child'])->pluck('url')->contains($urlCurrent);
        @endphp

        {{-- START: Menu Parent With Childs Menu --}}
        @php
            // Cek apakah ada sub_child yang aktif
            $hasActiveSubChild = false;
            foreach ($nav['child'] as $child) {
                if (isset($child['sub_child']) && count($child['sub_child']) > 0) {
                    if (collect($child['sub_child'])->pluck('url')->contains($urlCurrent)) {
                        $hasActiveSubChild = true;
                        break;
                    }
                }
            }

            $isParentOpen = $isParentActive || $hasActiveChild || $hasActiveSubChild;
        @endphp
        <li class="submenu {{ $isParentOpen ? 'active' : '' }}">
            {{-- START: Parent Menu --}}
            <a href="javascript:void(0);" class="{{ $isParentOpen ? 'active subdrop' : '' }}">
                <i class="ti {{ $nav['icon'] }} text-[16px] me-2" data-tooltip-placement="top"></i>
                <span>{{ $nav['name'] }}</span>
                <span class="menu-arrow"></span>
            </a>
            {{-- END: Parent Menu --}}

            {{-- START: Menu Childs --}}
            <ul style="{{ $isParentOpen ? 'display: block !important;' : '' }}">
                {{-- START: Foreach List Childs Menu --}}
                @foreach ($nav['child'] as $child)
                    @php
                        $hasSubChild = $child['sub_child'] && count($child['sub_child']) > 0;
                        $isChildMenuActive = Request::is(ltrim(parse_url($child['url'], PHP_URL_PATH), '/'));
                        $isSubChildActive = $hasSubChild ? collect($child['sub_child'])->pluck('url')->contains($urlCurrent) : false;
                        $isChildMenuOpen = $isChildMenuActive || $isSubChildActive;
                    @endphp
                    <li class="@if ($hasSubChild) submenu submenu-two {{ $isChildMenuOpen ? 'active' : '' }} @else {{ $urlCurrent == $child['url'] ? 'active' : '' }} @endif">
                        {{-- Check if the child has subChild --}}
                        @if ($hasSubChild)
                            {{-- START: Sub-Child Menu --}}
                            <a href="javascript:void(0);" class="{{ $isChildMenuOpen ? 'active subdrop' : '' }}">
                                <span>{{ $child['name'] }}</span>
                                <span class="menu-arrow inside-submenu"></span>
                            </a>

                            {{-- START: Foreach Sub-Child Menu --}}
                            <ul style="{{ $isChildMenuOpen ? 'display: block !important;' : '' }}">
                                @foreach ($child['sub_child'] as $subChild)
                                    @php
                                        $isSubChildMenuActive = $urlCurrent == $subChild['url'];
                                    @endphp
                                    <li class="{{ $isSubChildMenuActive ? 'active' : '' }}">
                                        <a href="{{ $subChild['url'] }}" class="{{ $isSubChildMenuActive ? 'active' : '' }}">
                                            @if (strlen($subChild['name']) > 25)
                                                {{ substr($subChild['name'], 0, 25) . '...' }}
                                            @else
                                                {{ $subChild['name'] }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- END: Foreach Sub-Child Menu --}}

                            {{-- END: Sub-Child Menu --}}
                        @else
                            {{-- START: Child Menu not Have SubChild --}}
                            @php
                                $isChildActive = $urlCurrent == $child['url'];
                            @endphp
                            <a href="{{ $child['url'] }}" class="{{ $isChildActive ? 'active' : '' }}">
                                <span>{{ $child['name'] }}</span>
                            </a>
                            {{-- END: Child Menu not Have SubChild --}}
                        @endif
                    </li>
                @endforeach
                {{-- END: Foreach List Childs Menu --}}
            </ul>
            {{-- END: Menu Childs --}}
        </li>
        {{-- END: Menu Parent With Childs Menu --}}
        @endif
    @endforeach
    <li>
        {{-- START: Logout Button --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit">
                <i class="ti ti-logout" data-tooltip-placement="top"></i>
                <span>Logout</span>
            </button>
        </form>
        {{-- END: Logout Button --}}
    </li>
</ul>
{{-- END: TEMPLATE HTML BARU --}}
{{-- End List Menus --}}
