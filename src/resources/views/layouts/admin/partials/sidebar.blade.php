<aside id="app-menu" class="app-menu">
    <!-- Sidenav Menu Brand Logo -->
    <a href="{{ route('dashboard') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <span class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="small logo">
            </span>
        </span>

        <!-- Dark Brand Logo -->
        <span class="logo logo-dark">
            <span class="logo-lg">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="dark logo">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="small logo">
            </span>
        </span>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <div class="h-topbar justify absolute end-5 top-0 flex items-center">
        <button id="button-hover-toggle">
            <span class="btn-on-hover-icon"></span>
        </button>
    </div>

    <!-- Sidenav Menu Item Link -->
    <div class="relative min-h-0 grow">
        <div class="size-full" data-simplebar="">

            <div id="user-profile-settings" class="sidenav-user p-5 bg-[url(../images/user-bg-pattern.svg)]">
                <div class="flex items-center justify-between">
                    <div>
                        {{-- Start Get Profile Photo --}}
                        @php
                            $profile_photo = Auth::user()?->userProfile?->profile_photo
                            ? URL::asset('storage/' . Auth::user()->userProfile->profile_photo)
                            : URL::asset('assets/admin/images/users/default.jpg');
                        @endphp
                        {{-- End Get Profile Photo --}}
                        <a href="{{ route('profile.edit') }}" class="link-reset">
                            <img src="{{ $profile_photo }}" alt="user-image" class="mb-3 size-9 rounded-full">
                            <span class="sidenav-user-name block font-bold text-nowrap">{{ Auth::user()->name }}</span>
                            <span class="text-xs font-semibold">{{ Auth::user()->email }}</span>
                        </a>
                    </div>

                    <div>
                        <!-- Profile Dropdown Button -->
                        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                            <button class="cursor-pointer" aria-haspopup="menu" aria-expanded="false"
                                aria-label="Dropdown">
                                <i class="iconify tabler--settings ms-1 size-6 align-middle"></i>
                            </button>

                            <div class="hs-dropdown-menu" role="menu" aria-orientation="vertical"
                                aria-labelledby="hs-dropdown-with-icons">
                                <!-- Header -->
                                <div class="py-2 px-3.5">
                                    <h6 class="text-xs">Hallo, {{ Auth::user()->name }}</h6>
                                </div>

                                <!-- My Profile -->
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="iconify tabler--user-circle me-1 align-middle text-lg"></i>
                                    <span class="align-middle">Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Start: List Menu --}}
            <div id="sidenav-menu">
                {{-- Start : Load List Menu --}}
                @include('layouts.admin.partials.menu-list')
                {{-- End : Load List Menu --}}
            </div>
            {{-- Start: End Menu --}}
        </div>
    </div>
</aside>
<!-- End Sidebar -->
