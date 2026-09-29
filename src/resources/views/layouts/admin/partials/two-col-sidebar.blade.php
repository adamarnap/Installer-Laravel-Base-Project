{{-- Start Get Profile Photo & Route Details --}}
@php
    $userData = Auth::user();
    $profile_photo = $userData?->userProfile?->profile_photo
        ? URL::asset('storage/' . $userData->userProfile->profile_photo)
        : URL::asset('assets/admin/images/users/default.jpg');

    $routeName = Route::currentRouteName();
    $routePrefix = !empty($routeName) ? explode('.', $routeName)[0] : (Request::segments()[0] ?? '');

    $urlCurrent = url('/') . '/' . (Request::segments()[0] ?? '');
    if (isset(Request::segments()[1])) {
        $urlCurrent .= '/' . Request::segments()[1];
    }
    if (isset(Request::segments()[2])) {
        $urlCurrent .= '/' . Request::segments()[2];
    }
    if (isset(Request::segments()[3])) {
        $urlCurrent .= '/' . Request::segments()[3];
    }

    $checkUrlActive = function ($targetUrl) use ($urlCurrent, $routePrefix) {
        if (empty($targetUrl) || $targetUrl === '#') {
            return false;
        }
        $targetPath = ltrim(parse_url($targetUrl, PHP_URL_PATH), '/');
        if (!empty($targetPath) && Request::is($targetPath, $targetPath . '/*')) {
            return true;
        }
        if ($urlCurrent === $targetUrl || Str::startsWith($urlCurrent, $targetUrl . '/')) {
            return true;
        }
        if (!empty($targetPath) && !empty($routePrefix) && $routePrefix === $targetPath) {
            return true;
        }
        return false;
    };

    $activeTabKey = null;

    foreach ($navs as $navItem) {
        $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($navItem['slug'] ?? $navItem['name']);

        if (count($navItem['child']) == 0) {
            if ($checkUrlActive($navItem['url'])) {
                $activeTabKey = $tabKey;
                break;
            }
        } else {
            $isParentActive = $checkUrlActive($navItem['url']);
            $hasActiveChild = collect($navItem['child'])->contains(function ($child) use ($checkUrlActive) {
                return $checkUrlActive($child['url']);
            });
            $hasActiveSubChild = false;

            foreach ($navItem['child'] as $childItem) {
                if (isset($childItem['sub_child']) && count($childItem['sub_child']) > 0) {
                    $hasActiveSub = collect($childItem['sub_child'])->contains(function ($subChild) use ($checkUrlActive) {
                        return $checkUrlActive($subChild['url']);
                    });
                    if ($hasActiveSub) {
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
{{-- End Get Profile Photo & Route Details --}}

<!-- Two Col Sidebar -->
<div class="two-col-sidebar" id="two-col-sidebar">
    <div class="sidebar sidebar-twocol">
        {{-- Start: Single Menu and Parent Menu Tabs (Left Column) --}}
        <div class="twocol-mini">
            <div class="sidebar-left slimscroll">
                <div class="nav flex flex-col items-center nav-pills" id="sidebar-tabs" data-tabs-toggle="#sidebar-tab" aria-orientation="vertical" role="tablist" data-tabs-inactive-classes="text-[var(--sidebar-menu-item)]!" data-tabs-active-classes="bg-primary-100 text-[var(--sidebar-col-active-item)]!">
                    @foreach ($navs as $nav)
                        @php
                            $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']);
                            $isTopLevelActive = $activeTabKey
                                ? $activeTabKey === $tabKey
                                : $loop->first;
                        @endphp
                        <a href="{{ count($nav['child']) == 0 ? $nav['url'] : '#' }}"
                           class="nav-link {{ $isTopLevelActive ? 'active' : '' }}"
                           title="{{ $nav['name'] }}"
                           role="tab"
                           aria-selected="{{ $isTopLevelActive ? 'true' : 'false' }}"
                           aria-controls="{{ $tabKey }}"
                           data-tabs-target="#{{ $tabKey }}">
                            <i class="ti {{ $nav['icon'] }}" data-tooltip-placement="top"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End: Single Menu and Parent Menu Tabs (Left Column) --}}

        {{-- Start: Right Column Menu Content --}}
        <div class="sidebar-right">
            <!-- Logo -->
            <div class="sidebar-logo">
                <a href="{{ route('dashboard') }}" class="logo logo-normal">
                    <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-white">
                    <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
                </a>
                <a href="{{ route('dashboard') }}" class="logo-small">
                    <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
                </a>
            </div>
            <!-- /Logo -->

            <div class="sidebar-scroll">
                {{-- Start: User Info Card --}}
                <div class="text-center rounded bg-light p-4 mb-4 border overflow-hidden">
                    <div class="relative size-[45px] mx-auto mb-4">
                        <img src="{{ $profile_photo }}" alt="Img" class="img-fluid rounded-full">
                        <span class="bottom-0 end-0 absolute size-3.5 bg-success border-2 border-white rounded-full"></span>
                    </div>
                    <h6 class="text-sm font-bold mb-1 truncate max-w-full" title="{{ $userData->name }}">{{ $userData->name }}</h6>
                    <p class="text-xs mb-0 truncate max-w-full" title="{{ $userData->email }}">{{ $userData->email }}</p>
                </div>
                {{-- End: User Info Card --}}

                <div class="tab-content" id="sidebar-tab">
                    @foreach ($navs as $nav)
                        @php
                            $tabKey = 'two-col-' . \Illuminate\Support\Str::slug($nav['slug'] ?? $nav['name']);
                            $isTopLevelActive = $activeTabKey
                                ? $activeTabKey === $tabKey
                                : $loop->first;
                        @endphp
                        <div class="{{ $isTopLevelActive ? '' : 'hidden' }} tab-pane fade {{ $isTopLevelActive ? 'show active' : '' }}" id="{{ $tabKey }}" role="tabpanel">
                            <ul>
                                <li class="menu-title"><span>{{ strtoupper($nav['name']) }}</span></li>

                                {{-- Determines between a single menu and a menu that has children --}}
                                @if (count($nav['child']) == 0)
                                    {{-- Single menu --}}
                                    @php
                                        $isSingleMenuActive = $checkUrlActive($nav['url']);
                                    @endphp
                                    <li class="{{ $isSingleMenuActive ? 'active' : '' }}">
                                        <a href="{{ $nav['url'] }}" class="{{ $isSingleMenuActive ? 'active' : '' }} flex items-center">
                                            @if (!empty($nav['icon']))
                                                <i class="ti {{ $nav['icon'] }} text-[16px] me-2" data-tooltip-placement="top"></i>
                                            @endif
                                            <span>{{ $nav['name'] }}</span>
                                        </a>
                                    </li>
                                @else
                                    {{-- Menu with children --}}
                                    @foreach ($nav['child'] as $child)
                                        @php
                                            $hasSubChild = isset($child['sub_child']) && count($child['sub_child']) > 0;
                                            $isChildMenuActive = $checkUrlActive($child['url']);
                                            $isSubChildActive = false;
                                            if ($hasSubChild) {
                                                $isSubChildActive = collect($child['sub_child'])->contains(function ($subChild) use ($checkUrlActive) {
                                                    return $checkUrlActive($subChild['url']);
                                                });
                                            }
                                            $isChildMenuOpen = $isChildMenuActive || $isSubChildActive;
                                        @endphp
                                        <li class="@if ($hasSubChild) submenu submenu-two {{ $isChildMenuOpen ? 'active' : '' }} @else {{ $isChildMenuActive ? 'active' : '' }} @endif">
                                            @if ($hasSubChild)
                                                {{-- Sub-Child Parent Menu --}}
                                                <a href="javascript:void(0);" class="{{ $isChildMenuOpen ? 'active subdrop' : '' }} flex items-center">
                                                    @if (!empty($child['icon']))
                                                        <i class="ti {{ $child['icon'] }} text-[16px] me-2"></i>
                                                    @endif
                                                    <span>{{ $child['name'] }}</span>
                                                    <span class="menu-arrow inside-submenu"></span>
                                                </a>

                                                {{-- Sub-Child List --}}
                                                <ul style="{{ $isChildMenuOpen ? 'display: block !important;' : 'display: none;' }}">
                                                    @foreach ($child['sub_child'] as $subChild)
                                                        @php
                                                            $isSubChildMenuActive = $checkUrlActive($subChild['url']);
                                                        @endphp
                                                        <li class="{{ $isSubChildMenuActive ? 'active' : '' }}">
                                                            <a href="{{ $subChild['url'] }}" class="{{ $isSubChildMenuActive ? 'active' : '' }} flex items-center">
                                                                @if (!empty($subChild['icon']))
                                                                    <i class="ti {{ $subChild['icon'] }} text-[16px] me-2"></i>
                                                                @endif
                                                                <span>
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
                                            @else
                                                {{-- Child Menu Without SubChild --}}
                                                <a href="{{ $child['url'] }}" class="{{ $isChildMenuActive ? 'active' : '' }} flex items-center">
                                                    @if (!empty($child['icon']))
                                                        <i class="ti {{ $child['icon'] }} text-[16px] me-2"></i>
                                                    @endif
                                                    <span>{{ $child['name'] }}</span>
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End: Right Column Menu Content --}}
    </div>
</div>
<!-- /Two Col Sidebar -->

<style>
    /* Two-col sidebar active state styles */
    .sidebar-twocol.sidebar .nav-link.active {
        background-color: var(--color-primary-100) !important;
        color: var(--sidebar-col-active-item) !important;
    }
    .sidebar-twocol.sidebar .sidebar-right ul li.active > a {
        background-color: var(--color-primary-100) !important;
        color: var(--color-primary) !important;
    }
    .sidebar-twocol.sidebar .sidebar-right ul li.submenu ul li.active > a {
        background-color: var(--color-primary-100) !important;
        color: var(--color-primary) !important;
    }
    .sidebar-twocol.sidebar .sidebar-right ul li.submenu ul li:not(.active) > a {
        background-color: transparent !important;
        color: var(--sidebar-submenu-item) !important;
    }
</style>
