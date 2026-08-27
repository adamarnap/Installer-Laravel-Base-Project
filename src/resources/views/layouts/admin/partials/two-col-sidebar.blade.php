{{-- Start Get Profile Photo --}}
@php
    $userData = Auth::user();
    $profile_photo = $userData?->userProfile?->profile_photo
    ? URL::asset('storage/' . $userData->userProfile->profile_photo)
    : URL::asset('assets/admin/images/users/default.jpg');

    $routeName = Route::currentRouteName();
    $routePrefix = explode('.', $routeName)[0];

    $urlCurrent = url('/') . '/' . Request::segments()[0];

    $isHaveSegment4 = false;
    if (isset(Request::segments()[1])) {
        $urlCurrent .= '/' . Request::segments()[1];
        $isHaveSegment4 = false;
    }
    if (isset(Request::segments()[2])) {
        $urlCurrent .= '/' . Request::segments()[2];
        $isHaveSegment4 = false;
    }
    if (isset(Request::segments()[3])) {
        $urlCurrent .= '/' . Request::segments()[3];
        $isHaveSegment4 = true;
    }

    $activeTabKey = null;

    foreach ($navs as $navItem) {
        $navItemUrl = ltrim(parse_url($navItem['url'], PHP_URL_PATH), '/');
        $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($navItem['slug'] ?? $navItem['name']);

        if (count($navItem['child']) == 0) {
            if ($routePrefix == $navItemUrl) {
                $activeTabKey = $tabKey;
                break;
            }
        } else {
            $isParentActive = Request::is($navItemUrl);
            // Cek apakah ada child yang URL-nya diawali oleh $urlCurrent (bukan exact match)
            $hasActiveChild = collect($navItem['child'])->contains(function ($child) use ($urlCurrent) {
                return Str::startsWith($urlCurrent, $child['url']);
            });
            $hasActiveSubChild = false;

            foreach ($navItem['child'] as $childItem) {
                if (isset($childItem['sub_child']) && count($childItem['sub_child']) > 0) {
                    if (collect($childItem['sub_child'])->pluck('url')->contains($urlCurrent)) {
                        $hasActiveSubChild = true;
                        break;
                    }
                }
            }

            if ($isParentActive || $hasActiveChild || $hasActiveSubChild) {
                $activeTabKey = $tabKey;
                break;
            }
        }
    }
@endphp
{{-- End Get Profile Photo --}}

<!-- Two Col Sidebar -->
<div class="two-col-sidebar" id="two-col-sidebar">
    <div class="sidebar sidebar-twocol">
        {{-- Start: Single Menu and Parent Menu --}}
        <div class="twocol-mini">
            <div class="sidebar-left slimscroll">
                <div class="nav flex flex-col items-center nav-pills" id="sidebar-tabs" data-tabs-toggle="#sidebar-tab" aria-orientation="vertical" role="tablist" data-tabs-inactive-classes="text-[var(--sidebar-menu-item)]!" data-tabs-active-classes="bg-primary-100 text-[var(--sidebar-col-active-item)]!">
                    @foreach ($navs as $nav)
                        @php
                            $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']);
                            $navUrl = ltrim(parse_url($nav['url'], PHP_URL_PATH), '/');
                            $isSingleMenuActive = count($nav['child']) == 0 && $routePrefix == $navUrl;
                            $isParentActive = false;
                            $hasActiveChild = false;
                            $hasActiveSubChild = false;

                            if (count($nav['child']) > 0) {
                                $isParentActive = Request::is($navUrl);
                                // Cek apakah ada child yang URL-nya diawali oleh $urlCurrent (bukan exact match)
                                $hasActiveChild = collect($nav['child'])->contains(function ($child) use ($urlCurrent) {
                                    return Str::startsWith($urlCurrent, $child['url']);
                                });

                                foreach ($nav['child'] as $child) {
                                    if (isset($child['sub_child']) && count($child['sub_child']) > 0) {
                                        if (collect($child['sub_child'])->pluck('url')->contains($urlCurrent)) {
                                            $hasActiveSubChild = true;
                                            break;
                                        }
                                    }
                                }
                            }

                            $isTopLevelActive = $activeTabKey
                                ? $activeTabKey === $tabKey
                                : $loop->first;
                        @endphp
                        <a href="{{ count($nav['child']) == 0 ? $nav['url'] : '#' }}" class="nav-link {{ $isTopLevelActive ? 'active' : '' }}" title="{{ $nav['name'] }}" role="tab" data-tabs-target="#{{ $tabKey }}">
                            <i class="ti {{ $nav['icon'] }}" data-tooltip-placement="top"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End: Single Menu and Parent Menu --}}
        <div class="sidebar-right">
            <!-- Logo -->
            <div class="sidebar-logo">
                <a href="{{ route('dashboard') }}" class="logo logo-normal">
                    <img src="{{ $prefs_composer['logo'] }}" alt="Img">
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-white">
                    <img src="{{ $prefs_composer['logo'] }}" alt="Img">
                </a>
                <a href="{{ route('dashboard') }}" class="logo-small">
                    <img src="{{ $prefs_composer['logo'] }}" alt="Img">
                </a>
            </div>
            <!-- /Logo -->
            <div class="sidebar-scroll">
                <div class="text-center rounded bg-light p-4 mb-4 border">
                    <div class="relative size-[45px] mx-auto mb-4">
                        <img src="{{ $profile_photo }}" alt="Img" class="img-fluid rounded-full">
                        <span class="bottom-0 end-0 absolute  size-3.5 bg-success border-2 border-white rounded-full"></span>
                    </div>
                    <h6 class="text-sm font-bold mb-1">{{ $userData->name }}</h6>
                    <p class="text-xs mb-0">{{ $userData->email }}</p>
                </div>
                <div class="tab-content" id="sidebar-tab">
                    @foreach ($navs as $nav)
                        @php
                            $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']);
                            $navUrl = ltrim(parse_url($nav['url'], PHP_URL_PATH), '/');
                            $isSingleMenuActive = count($nav['child']) == 0 && $routePrefix == $navUrl;
                            $isParentActive = false;
                            $hasActiveChild = false;
                            $hasActiveSubChild = false;

                            if (count($nav['child']) > 0) {
                                $isParentActive = Request::is($navUrl);
                                // Cek apakah ada child yang URL-nya diawali oleh $urlCurrent (bukan exact match)
                                $hasActiveChild = collect($nav['child'])->contains(function ($child) use ($urlCurrent) {
                                    return Str::startsWith($urlCurrent, $child['url']);
                                });

                                foreach ($nav['child'] as $child) {
                                    if (isset($child['sub_child']) && count($child['sub_child']) > 0) {
                                        if (collect($child['sub_child'])->pluck('url')->contains($urlCurrent)) {
                                            $hasActiveSubChild = true;
                                            break;
                                        }
                                    }
                                }
                            }

                            $isTopLevelActive = $activeTabKey
                                ? $activeTabKey === $tabKey
                                : $loop->first;
                        @endphp
                        <div class="hidden tab-pane fade {{ $isTopLevelActive ? 'show active' : '' }}" id="{{ $tabKey }}">
                            <ul>
                                <li class="menu-title"><span>{{ strtoupper($nav['name']) }}</span></li>

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
                                    <li class="{{ $routePrefix == $navUrl ? 'active' : '' }}">
                                        <a href="{{ $nav['url'] }}" class="{{ $routePrefix == $navUrl ? 'active' : '' }}">
                                            {{ $nav['name'] }}
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

                                    $isParentOpen = Request::is(ltrim(parse_url($nav['url'], PHP_URL_PATH), '/'))
                                        || collect($nav['child'])->contains(function ($child) use ($urlCurrent) {
                                            return Str::startsWith($urlCurrent, $child['url']);
                                        })
                                        || $hasActiveSubChild;
                                @endphp

                                {{-- START: Foreach List Childs Menu --}}
                                @foreach ($nav['child'] as $child)
                                    @php
                                        $hasSubChild = $child['sub_child'] && count($child['sub_child']) > 0;
                                    @endphp
                                    <li class="@if ($hasSubChild) submenu {{ Request::is(ltrim(parse_url($child['url'], PHP_URL_PATH), '/')) || collect($child['sub_child'])->pluck('url')->contains($urlCurrent) ? 'active' : '' }} @else {{ Str::startsWith($urlCurrent, $child['url']) ? 'active' : '' }} @endif">
                                        {{-- Check if the child has subChild --}}
                                        @if ($hasSubChild)
                                            {{-- START: Sub-Child Menu --}}
                                            @php
                                                // Cek apakah sub_child aktif
                                                $isSubChildActive = collect($child['sub_child'])->pluck('url')->contains($urlCurrent);
                                                $isChildMenuActive = Request::is(ltrim(parse_url($child['url'], PHP_URL_PATH), '/'));
                                                $isChildMenuOpen = $isChildMenuActive || $isSubChildActive;
                                            @endphp
                                            <a href="javascript:void(0);" class="{{ $isChildMenuOpen ? 'active subdrop' : '' }}">
                                                <span>{{ $child['name'] }}</span>
                                                <span class="menu-arrow"></span>
                                            </a>

                                            {{-- START: Foreach Sub-Child Menu --}}
                                            <ul style="display: {{ $isChildMenuOpen ? 'block' : 'none' }};">
                                                @foreach ($child['sub_child'] as $subChild)
                                                    <li>
                                                        <a href="{{ $subChild['url'] }}" class="{{ $urlCurrent == $subChild['url'] ? 'active' : '' }}">
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
                                            <a href="{{ $child['url'] }}" class="{{ Str::startsWith($urlCurrent, $child['url']) ? 'active' : '' }}">
                                                <span>{{ $child['name'] }}</span>
                                            </a>
                                            {{-- END: Child Menu not Have SubChild --}}
                                        @endif
                                    </li>
                                @endforeach
                                {{-- END: Foreach List Childs Menu --}}
                                {{-- END: Menu Parent With Childs Menu --}}
                                @endif
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Two Col Sidebar -->
