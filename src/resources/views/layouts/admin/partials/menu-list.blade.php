{{-- Start list menus --}}
<ul class="side-nav hs-accordion-group px-2.5 pb-16.5">

    {{-- START: Title Section Menus --}}
    <li class="menu-title" data-lang="main">
        <span>Main</span>
    </li>
    {{-- END: Title Section Menus --}}

    @foreach ($navs as $nav)
        {{-- Route prefix to determine menu activity  --}}
        @php
            /* 
            * ========================================================================================================
            * DISINI url nav yang bersumber dari DB yang tadinya hanya berupa nama route (ex : dashboard.index) telah diubah menjadi URL hasil dari route($nav->url)
            * Contoh jadinya, $nav['url'] = route('dashboard.index'), yang dimana akan berbentuk URL (ex $nav['url'] : http://127.0.0.0:8000/admin/dashboard)
            * ========================================================================================================
            * ========================================================================================================
            * $navUrl, untuk mengambil path url dari menu yang diambil dari database
            * fungsi pase_url(), Fungsi ini digunakan untuk memecah sebuah URL menjadi komponen-komponennya, seperti skema, host, path, query, dll.
            * PHP_URL_PATH untuk mengambil path url yang berasal dari parse_url() yang sebelumnya berupa array (skema, host, path, query, dll)
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
            $navIcon = null;
            if (!empty($nav['icon'])) {
                $navIcon = \Illuminate\Support\Str::startsWith($nav['icon'], 'tabler--')
                    ? $nav['icon']
                    : 'tabler--' . $nav['icon'];
            }
        @endphp

        {{-- Determines between a single menu and a menu that has children --}}
        @if (count($nav['child']) == 0)
            {{-- Single menu --}}
            <li class="menu-item">
                <a href="{{ $nav['url'] }}" class="{{ $routePrefix == $navUrl ? 'active' : '' }} menu-link">
                    @if (!empty($nav['icon']))
                        <span class="menu-icon">
                            <i class="iconify {{ $navIcon }} me-1 align-middle text-lg"></i>
                        </span>
                    @endif
                    <span class="menu-text" data-lang="{{ $nav['slug'] ?? \Illuminate\Support\Str::slug($nav['name']) }}">
                        {{ $nav['name'] }}
                    </span>
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
                $segments = Request::segments();
                $urlCurrent = url('/') . '/' . ($segments[0] ?? '');

                $isHaveSegment4 = false;
                // Tambahkan URL segment ke 2 jika ada
                if (isset($segments[1])) {
                    $urlCurrent .= '/' . $segments[1];
                    $isHaveSegment4 = false;
                }
                // Tambahkan URL segment ke 3 jika ada
                if (isset($segments[2])) {
                    $urlCurrent .= '/' . $segments[2];
                    $isHaveSegment4 = false;
                }
                // Tambahkan URL segment ke 4 jika ada
                if (isset($segments[3])) {
                    $urlCurrent .= '/' . $segments[3];
                    $isHaveSegment4 = true;
                }

                $navPath = ltrim(parse_url($nav['url'], PHP_URL_PATH), '/');
                $isNavCurrent = Request::is($navPath);
                $isNavHasActiveChild = collect($nav['child'])->pluck('url')->contains($urlCurrent);

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

                $navIsOpen = $isNavCurrent || $isNavHasActiveChild || $hasActiveSubChild;
                $navControlsId = 'menu-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']) . '-submenu';
            @endphp

            {{-- START: Menu Parent With Childs Menu --}}
            <li class="menu-item hs-accordion">
                {{-- START: Parent Menu --}}
                <a href="javascript:void(0)" aria-expanded="{{ $navIsOpen ? 'true' : 'false' }}" aria-controls="{{ $navControlsId }}" class="{{ $navIsOpen ? 'active' : '' }} hs-accordion-toggle menu-link">
                    @if (!empty($nav['icon']))
                        <span class="menu-icon">
                            <i class="iconify {{ $navIcon }} me-1 align-middle text-lg"></i>
                        </span>
                    @endif
                    <span class="menu-text" data-lang="{{ $nav['slug'] ?? \Illuminate\Support\Str::slug($nav['name']) }}">
                        {{ $nav['name'] }}
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                {{-- END: Parent Menu --}}

                {{-- START: Menu Childs --}}
                <ul id="{{ $navControlsId }}" class="sub-menu hs-accordion-content hs-accordion-group {{ $navIsOpen ? '' : 'hidden' }}">
                    {{-- START: Foreach List Childs Menu --}}
                    @foreach ($nav['child'] as $child)
                        @php
                            $childPath = ltrim(parse_url($child['url'], PHP_URL_PATH), '/');
                            $isChildCurrent = Request::is($childPath);
                            $isChildHasActiveSubChild = false;
                            if (isset($child['sub_child']) && count($child['sub_child']) > 0) {
                                $isChildHasActiveSubChild = collect($child['sub_child'])->pluck('url')->contains($urlCurrent);
                            }
                            $childIsOpen = $isChildCurrent || $isChildHasActiveSubChild;
                            $childControlsId = 'menu-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']) . '-' . \Illuminate\Support\Str::slug($child['slug'] ?? $child['name']) . '-submenu';
                        @endphp

                        <li class="menu-item {{ !empty($child['sub_child']) ? 'hs-accordion' : '' }}">
                            {{-- Check if the child has subChild --}}
                            @if (!empty($child['sub_child']) && count($child['sub_child']) > 0)
                                {{-- START: Sub-Child Menu --}}
                                <a href="javascript:void(0)" aria-expanded="{{ $childIsOpen ? 'true' : 'false' }}" aria-controls="{{ $childControlsId }}" class="{{ $childIsOpen ? 'active' : '' }} hs-accordion-toggle menu-link">
                                    <span class="menu-text" data-lang="{{ $child['slug'] ?? \Illuminate\Support\Str::slug($child['name']) }}">
                                        {{ $child['name'] }}
                                    </span>
                                    <span class="menu-arrow"></span>
                                </a>

                                {{-- START: Foreach Sub-Child Menu --}}
                                <ul id="{{ $childControlsId }}" class="sub-menu hs-accordion-content hs-accordion-group {{ $childIsOpen ? '' : 'hidden' }}">
                                    @foreach ($child['sub_child'] as $subChild)
                                        @php
                                            $isSubChildActive = $urlCurrent == $subChild['url'];
                                        @endphp
                                        <li class="menu-item">
                                            <a href="{{ $subChild['url'] }}" class="{{ $isSubChildActive ? 'active' : '' }} menu-link">
                                                <span class="menu-text" data-lang="{{ $subChild['slug'] ?? \Illuminate\Support\Str::slug($subChild['name']) }}">
                                                    @if (strlen($subChild['name']) > 25)
                                                        {{ substr($subChild['name'], 0, 25) . '...' }}
                                                    @else
                                                        {{ $subChild['name'] }}
                                                    @endif
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- END: Foreach Sub-Child Menu --}}

                                {{-- END: Sub-Child Menu --}}
                            @else
                                {{-- START: Child Menu not Have SubChild --}}
                                <a href="{{ $child['url'] }}" class="{{ $isChildCurrent ? 'active' : '' }} menu-link">
                                    <span class="menu-text" data-lang="{{ $child['slug'] ?? \Illuminate\Support\Str::slug($child['name']) }}">
                                        {{ $child['name'] }}
                                    </span>
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

    <li class="menu-item">
        {{-- START: Logout Button --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit" class="menu-link">
                <span class="menu-icon">
                    <i class="iconify tabler--logout"></i>
                </span>
                <span class="menu-text">
                    Log Out
                </span>
            </button>
        </form>
        {{-- END: Logout Button --}}
    </li>
</ul>
{{-- End List Menus --}}

@push('scripts')
{{-- Start: Logout Confirmation --}}
    <script>
        // Logout Confirmation
        document.getElementById('logout-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari aplikasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#919191',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
{{-- End: Logout Confirmation --}}
@endpush