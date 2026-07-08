{{-- Start: Topbar --}}
<header class="app-header">
    <div class="container-fluid flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="logo-topbar">
                <!-- Sidenav Menu Brand Logo -->
                <a href="index.html" class="logo-box">
                    <!-- Light Brand Logo -->
                    <div class="logo-light">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" class="logo-lg h-6" alt="Light logo">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" class="logo-sm h-6" alt="Small logo">
                    </div>

                    <!-- Dark Brand Logo -->
                    <div class="logo-dark">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" class="logo-lg h-6" alt="Dark logo">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" class="logo-sm h-6" alt="Small logo">
                    </div>
                </a>
            </div>

            <!-- Sidenav Menu Toggle Button -->
            <button id="button-toggle-menu" class="sidenav-toggle-button btn btn-icon">
                <i class="iconify tabler--menu-4 text-xl"></i>
            </button>

            <!-- Topnav Menu Toggle Button for Horizontal -->
            <div class="topnav-toggle-button">
                <button type="button" class="hs-collapse-toggle btn topnav-toggle-button" data-hs-collapse="#topnav-menu" id="topnav-menu-collapse" aria-expanded="false" aria-controls="topnav-menu" aria-label="Toggle navigation">
                    <i class="iconify tabler--menu-4 text-xl"></i>
                </button>
            </div>
            {{-- Start: Search Box --}}
            <div id="search-box-rounded" class="hidden xl:flex">
                <div class="input-icon-group">
                    <i class="iconify tabler--search input-icon text-lg text-(--topbar-item-color)/50! placeholder:opacity-50"></i>
                    <input type="search" id="topbar-search" class="form-input w-57.5 rounded-full! border-(--topbar-search-border)! bg-(--topbar-search-bg)! text-(--topbar-item-color)! placeholder:opacity-50" placeholder="Quick Search...">
                </div>
            </div>
            {{-- End: Search Box --}}

            {{-- Start: Mega Menu Columns --}}
            <div id="megamenu-columns" class="md:inline-flex hidden">
                <div class="topbar-item hs-dropdown relative inline-flex">
                    <button class="topbar-link hs-dropdown-toggle btn px-2.5! font-medium" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">Mega Menu <i class="iconify tabler--chevron-down"></i></button>

                    <div class="hs-dropdown-menu p-0 md:min-w-3xl" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                        <div style="max-height: 380px" data-simplebar="">
                            <div class="grid md:grid-cols-3">
                                <div class="p-3">
                                    <h5 class="py-2 px-3.5 font-semibold mb-2 text-xs">Dashboard &amp; Analytics</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Sales Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Marketing Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Finance Overview
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                User Analytics
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Traffic Insights
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="p-3">
                                    <h5 class="py-2 px-3.5 font-semibold mb-2 text-xs">Project Management</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--minus align-middle text-default-400"></i>
                                                Kanban Workflow
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--minus align-middle text-default-400"></i>
                                                Project Timeline
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--minus align-middle text-default-400"></i>
                                                Task Management
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--minus align-middle text-default-400"></i>
                                                Team Members
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--minus align-middle text-default-400"></i>
                                                Assignments
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="p-3 bg-light/50">
                                    <h5 class="py-2 px-3.5 font-semibold mb-2 text-xs">User Management</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                User Profiles
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Access Control
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Security Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                User Groups
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="iconify tabler--chevron-right align-middle text-default-400"></i>
                                                Authentication
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>
            {{-- End: Mega Menu Columns --}}

            {{-- Start: Mega Menu Apps --}}
            <div id="megamenu-apps" class="md:inline-flex hidden">
                <div class="topbar-item hs-dropdown relative inline-flex">
                    <button class="topbar-link hs-dropdown-toggle btn px-2.5! font-medium" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">Apps <i class="iconify tabler--chevron-down"></i></button>

                    <div class="hs-dropdown-menu p-0 md:min-w-3xl" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                        <div style="max-height: 380px" data-simplebar="">
                            <div class="grid md:grid-cols-3">
                                <div class="p-3 space-y-2">
                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-primary border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--basket size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">eCommerce</h5>
                                                <span class="text-default-400 text-xs">Products, orders &amp; etc.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-success border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--message size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Chat</h5>
                                                <span class="text-default-400 text-xs">Team conversations</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-danger border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--list-check size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Task</h5>
                                                <span class="text-default-400 text-xs">Plan and track work</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-info border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--mailbox size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Email</h5>
                                                <span class="text-default-400 text-xs">Messages and inbox</span>
                                            </span>
                                        </span>
                                    </a>
                                </div>

                                <div class="p-3 space-y-2">
                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-secondary border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--building size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Companies</h5>
                                                <span class="text-default-400 text-xs">Business profiles</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-dark border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--id size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Contacts Diary</h5>
                                                <span class="text-default-400 text-xs">People and connections</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-warning border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--calendar size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Calendar</h5>
                                                <span class="text-default-400 text-xs">Events and reminders</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <span class="flex items-center gap-3">
                                            <span class="size-9 flex items-center justify-center text-success border border-light bg-light/50 rounded">
                                                <i class="iconify tabler--lifebuoy size-5.5"></i>
                                            </span>
                                            <span>
                                                <h5 class="text-xs">Support</h5>
                                                <span class="text-default-400 text-xs">Help and assistance</span>
                                            </span>
                                        </span>
                                    </a>
                                </div>

                                <div class="row-span-2 bg-light/50">
                                    <div class="h-full relative rounded-e overflow-hidden bg-[url(../images/stock/small-8.jpg)] bg-cover">
                                        <div class="p-6 absolute inset-0 bg-gradient bg-secondary/90 flex items-center justify-center">
                                            <div class="text-center text-white">
                                                <i class="iconify tabler--atom text-4xl"></i>
                                                <p class="text-white/75 mb-5 uppercase">Limited Offer</p>
                                                <h3 class="font-semibold text-white mb-3 text-xl">Unlock Exclusive Savings</h3>
                                                <h4 class="font-medium text-base mb-1">
                                                    <del class="text-opacity-75 text-white">$49.00</del>
                                                    /
                                                    <span class="font-bold text-white">$25 USD</span>
                                                </h4>
                                                <button type="button" class="mt-5 btn btn-sm bg-danger text-white hover:bg-danger-hover">
                                                    <i class="iconify tabler--shopping-cart me-1.5"></i>
                                                    Buy Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .bg-light-->
                                </div>

                                <div class="col-span-2">
                                    <div class="grid grid-cols-2 border-t border-light border-dashed text-center">
                                        <div class="p-6">
                                            <p class="font-medium text-default-400 mb-1 text-2xs uppercase">-: &nbsp; Support &nbsp;:-</p>
                                            <h5 class="text-md">help@mydomain.com</h5>
                                        </div>

                                        <div class="p-6">
                                            <p class="font-medium text-default-400 mb-1 text-2xs uppercase">-: &nbsp; Help: &nbsp;:-</p>
                                            <h5 class="text-md">+(12) 3456 7890</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>
            {{-- End: Mega Menu Apps --}}
        </div>

        {{-- Start: Impersonate Warning (di dalam topbar, di antara kiri & kanan) --}}
        @if($impersonate_data['is_impersonating'])
        <div class="flex-1 flex items-center justify-center px-4">
            <div class="flex items-center gap-2 bg-red-500 text-white px-3 py-1.5 rounded-md">
                <i class="iconify tabler--{icon_name} text-xs text-[18px]">warning</i>
                <span class="text-xs font-medium whitespace-nowrap">
                    Impersonate: <strong>{{ $impersonate_data['impersonated_user']->name }}</strong>
                </span>
                <form action="{{ route('settings.impersonate.destroy', $impersonate_data['impersonated_user']->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-white text-red-600 hover:bg-red-50 rounded text-[11px] font-semibold transition-all ml-1">
                        <i class="iconify tabler--{icon_name} text-xs text-[14px]">logout</i>
                    </button>
                </form>
            </div>
        </div>
        @endif
        {{-- End: Impersonate Warning (di dalam topbar, di antara kiri & kanan) --}}

        <div class="flex items-center gap-2.5">
            {{-- Start: Theme Dark/Light Toggle --}}
            <div id="theme-dropdown" class="sm:inline-flex hidden">
                <div class="topbar-item hs-dropdown relative inline-flex [--auto-close:inside] [--placement:bottom-right]">
                    <button class="topbar-link hs-dropdown-toggle rounded-full" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <i class="iconify tabler--sun topbar-link-icon hidden" id="theme-icon-light"></i>
                        <i class="iconify tabler--moon topbar-link-icon hidden" id="theme-icon-dark"></i>
                        <i class="iconify tabler--sun-moon topbar-link-icon hidden" id="theme-icon-system"></i>
                    </button>

                    <div class="hs-dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                        <div class="theme-mode">
                            <input class="peer invisible absolute size-0" type="radio" name="data-theme" id="topbar-dropdown-light" value="light" checked="">
                            <label class="dropdown-item peer-checked:bg-default-100" for="topbar-dropdown-light">
                                <i class="iconify tabler--sun me-1 align-middle text-base"></i>
                                Light
                            </label>
                        </div>

                        <div class="theme-mode">
                            <input class="peer invisible absolute size-0" type="radio" name="data-theme" id="topbar-dropdown-dark" value="dark">
                            <label class="dropdown-item peer-checked:bg-default-100" for="topbar-dropdown-dark">
                                <i class="iconify tabler--moon me-1 align-middle text-base"></i>
                                Dark
                            </label>
                        </div>

                        <div class="theme-mode">
                            <input class="peer invisible absolute size-0" type="radio" name="data-theme" id="topbar-dropdown-system" value="system">
                            <label class="dropdown-item peer-checked:bg-default-100" for="topbar-dropdown-system">
                                <i class="iconify tabler--sun-moon me-1 align-middle text-base"></i>
                                System
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Start: Theme Dark/Light Toggle --}}

            {{-- Start: Apps Dropdown --}}
            <div id="apps-dropdown-grid" class="xl:inline-flex hidden">
                <div class="topbar-item hs-dropdown relative inline-flex [--auto-close:inside] [--placement:bottom-right]">
                    <button class="topbar-link hs-dropdown-toggle relative flex items-center" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <i class="iconify tabler--apps topbar-link-icon"></i>
                    </button>

                    <div class="hs-dropdown-menu w-80 p-3" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                        <div class="grid grid-cols-3 items-center gap-1.5">
                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full bg-light flex items-center justify-center mx-auto mb-1.25">
                                    <img src="{{ URL::asset('assets/admin/images/logos/google.svg') }}" alt="Google Logo" class="h-4.5">
                                </span>
                                <span class="align-middle font-medium">Google</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full bg-light flex items-center justify-center mx-auto mb-1.25">
                                    <img src="{{ URL::asset('assets/admin/images/logos/figma.svg') }}" alt="Figma Logo" class="h-4.5">
                                </span>
                                <span class="align-middle font-medium">Figma</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full bg-light flex items-center justify-center mx-auto mb-1.25">
                                    <img src="{{ URL::asset('assets/admin/images/logos/slack.svg') }}" alt="Slack Logo" class="h-4.5">
                                </span>
                                <span class="align-middle font-medium">Slack</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full bg-light flex items-center justify-center mx-auto mb-1.25">
                                    <img src="{{ URL::asset('assets/admin/images/logos/dropbox.svg') }}" alt="Dropbox Logo" class="h-4.5">
                                </span>
                                <span class="align-middle font-medium">Dropbox</span>
                            </a>

                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-sm btn-icon rounded-full bg-danger text-white hover:bg-danger-hover">
                                    <i class="iconify tabler--circle-dashed-plus text-lg"></i>
                                </a>
                            </div>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full flex items-center justify-center bg-primary/15 text-primary mx-auto mb-1.25">
                                    <i class="iconify tabler--calendar text-lg"></i>
                                </span>
                                <span class="align-middle font-medium">Calendar</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full flex items-center justify-center bg-primary/15 text-primary mx-auto mb-1.25">
                                    <i class="iconify tabler--message-circle text-lg"></i>
                                </span>
                                <span class="align-middle font-medium">Chat</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full flex items-center justify-center bg-primary/15 text-primary mx-auto mb-1.25">
                                    <i class="iconify tabler--folder text-lg"></i>
                                </span>
                                <span class="align-middle font-medium">Files</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item flex-col gap-0 border border-dashed border-default-300 rounded text-center py-3">
                                <span class="size-8 rounded-full flex items-center justify-center bg-primary/15 text-primary mx-auto mb-1.25">
                                    <i class="iconify tabler--users text-lg"></i>
                                </span>
                                <span class="align-middle font-medium">Team</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Start: End Dropdown --}}

            {{-- Start: Notification Dropdown --}}
            <div id="notification-dropdown-people" class="topbar-item hs-dropdown relative inline-flex [--auto-close:inside] [--placement:bottom-right]">
                <button class="topbar-link hs-dropdown-toggle relative flex items-center" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <i class="iconify tabler--bell topbar-link-icon"></i>
                    <span class="badge bg-danger absolute -end-px -top-[13px] size-4 rounded-full leading-0 text-white">5</span>
                </button>

                <div class="hs-dropdown-menu min-w-80 p-0 space-y-0" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                    <div class="border-default-300 border-b px-3 py-2">
                        <div class="flex items-center justify-between">
                            <h6 class="text-base font-semibold">Notifications</h6>
                            <a href="#!" class="badge badge-label bg-success/15 text-success">07 Notification</a>
                        </div>
                    </div>

                    <div style="max-height: 300px" data-simplebar="">
                        <!-- item 1 -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-1">
                            <span class="shrink-0 relative">
                                <img src="{{ URL::asset('assets/admin/images/users/user-4.jpg') }}" class="size-9 rounded-full" alt="User Avatar">
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-success text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--bell text-2xs align-middle"></i>
                                    <span class="sr-only">unread notification</span>
                                </span>
                            </span>

                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Emily Johnson</span>
                                commented on a task in
                                <span class="font-medium text-body-color">Design Sprint</span>
                                <br>
                                <span class="text-xs">12 minutes ago</span>
                            </span>
                        </div>

                        <!-- Notification 2 -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-2">
                            <span class="shrink-0 relative">
                                <img src="{{ URL::asset('assets/admin/images/users/user-5.jpg') }}" class="size-9 rounded-full" alt="User Avatar">
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-info text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--cloud-upload text-2xs align-middle"></i>
                                    <span class="sr-only">upload notification</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Michael Lee</span>
                                uploaded files to
                                <span class="font-medium text-body-color">Marketing Assets</span>
                                <br>
                                <span class="text-xs">25 minutes ago</span>
                            </span>
                        </div>

                        <!-- Notification 3 - Server CPU Alert -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-6">
                            <span class="shrink-0 relative">
                                <span class="size-9 rounded-full bg-light flex items-center justify-center">
                                    <i class="iconify tabler--database text-lg"></i>
                                </span>
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-danger text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--alert-circle text-2xs align-middle"></i>
                                    <span class="sr-only">server alert</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Server #3</span>
                                CPU usage exceeded 90%
                                <br>
                                <span class="text-xs">Just now</span>
                            </span>
                        </div>

                        <!-- Notification 4 -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-3">
                            <span class="shrink-0 relative">
                                <img src="{{ URL::asset('assets/admin/images/users/user-6.jpg') }}" class="size-9 rounded-full" alt="User Avatar">
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-warning text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--alert-triangle text-2xs align-middle"></i>
                                    <span class="sr-only">alert</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Sophia Ray</span>
                                flagged an issue in
                                <span class="font-medium text-body-color">Bug Tracker</span>
                                <br>
                                <span class="text-xs">40 minutes ago</span>
                            </span>
                        </div>

                        <!-- Notification 5 -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-4">
                            <span class="shrink-0 relative">
                                <img src="{{ URL::asset('assets/admin/images/users/user-7.jpg') }}" class="size-9 rounded-full" alt="User Avatar">
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-primary text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--calendar-event text-2xs align-middle"></i>
                                    <span class="sr-only">event notification</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">David Kim</span>
                                scheduled a meeting for
                                <span class="font-medium text-body-color">UX Review</span>
                                <br>
                                <span class="text-xs">1 hour ago</span>
                            </span>
                        </div>

                        <!-- Notification 6 -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-5">
                            <span class="shrink-0 relative">
                                <img src="{{ URL::asset('assets/admin/images/users/user-8.jpg') }}" class="size-9 rounded-full" alt="User Avatar">
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-secondary text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--edit text-2xs align-middle"></i>
                                    <span class="sr-only">edit</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Isabella White</span>
                                updated the document in
                                <span class="font-medium text-body-color">Product Specs</span>
                                <br>
                                <span class="text-xs">2 hours ago</span>
                            </span>
                        </div>

                        <!-- Notification 7 - Deployment Success -->
                        <div class="dropdown-item gap-6 px-4.5 py-3 text-wrap" id="message-7">
                            <span class="shrink-0 relative">
                                <span class="size-9 rounded-full bg-light flex items-center justify-center">
                                    <i class="iconify tabler--rocket text-lg"></i>
                                </span>
                                <span class="absolute -top-3 -end-2 border-2 border-card bg-success text-white flex size-5.5 items-center justify-center rounded-full">
                                    <i class="iconify tabler--check text-2xs align-middle"></i>
                                    <span class="sr-only">deployment</span>
                                </span>
                            </span>
                            <span class="grow text-default-400">
                                <span class="font-medium text-body-color">Production Server</span>
                                deployment completed successfully
                                <br>
                                <span class="text-xs">30 minutes ago</span>
                            </span>
                        </div>
                    </div>
                    <!-- end dropdown-->

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-reset border-light justify-center border-t py-3 font-bold underline underline-offset-2">Read All Messages</a>
                </div>
            </div>
            {{-- End: Notification Dropdown --}}

            {{-- Start: Fullscreen Toggle --}}
            <div id="fullscreen-toggler" class="md:inline-flex hidden">
                <div class="topbar-item">
                    <button class="topbar-link btn group size-8 rounded-full" data-toggle="fullscreen" aria-label="Full Screen">
                        <i class="iconify tabler--maximize topbar-link-icon group-[.fullscreen-active]:hidden"></i>
                        <i class="iconify tabler--minimize hidden topbar-link-icon group-[.fullscreen-active]:inline-block"></i>
                    </button>
                </div>
            </div>
            {{-- End: Fullscreen Toggle --}}

            {{-- Start: Monochrome Mode Toggle --}}
            <div class="xl:inline-flex hidden">
                <div id="monochrome-toggler" class="topbar-item">
                    <button class="topbar-link btn btn-sm size-8 rounded-full" id="monochrome-mode" type="button" aria-label="Monochrome Mode">
                        <i class="iconify tabler--palette topbar-link-icon"></i>
                    </button>
                </div>
            </div>

            <div class="sm:inline-flex hidden">
                <div class="topbar-item btn-theme-setting">
                    <button class="topbar-link btn btn-icon size-8 rounded-full" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="theme-customization" data-hs-overlay="#theme-customization">
                        <i class="iconify tabler--settings topbar-link-icon"></i>
                    </button>
                </div>
            </div>
            {{-- End: Monochrome Mode Toggle --}}

            {{-- Start: Language Selector --}}
            <div id="language-selector-rounded" class="topbar-item hs-dropdown relative inline-flex [--placement:bottom-right]">
                {{-- Get Current Language --}}
                @php
                    $currentLanguage = strtoupper(Lang::locale());
                    $selectedLanguageImage = 'us.svg'; // Default to English flag

                    if($currentLanguage === 'EN') {
                        $selectedLanguageImage = 'us.svg';
                    } elseif($currentLanguage === 'DE') {
                        $selectedLanguageImage = 'de.svg';
                    } elseif($currentLanguage === 'IT') {
                        $selectedLanguageImage = 'it.svg';
                    } elseif($currentLanguage === 'ES') {
                        $selectedLanguageImage = 'es.svg';
                    } elseif($currentLanguage === 'ID') {
                        $selectedLanguageImage = 'id.svg';
                    } elseif($currentLanguage === 'RU') {
                        $selectedLanguageImage = 'ru.svg';
                    } elseif($currentLanguage === 'HI') {
                        $selectedLanguageImage = 'in.svg';
                    } elseif($currentLanguage === 'AR') {
                        $selectedLanguageImage = 'sa.svg';
                    }
                @endphp
                <button class="topbar-link hs-dropdown-toggle font-bold relative flex items-center" type="button" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <img src="{{ URL::asset('assets/admin/images/flags/' . $selectedLanguageImage) }}" alt="" class="me-3 size-4.5 rounded-full" id="selected-language-image">
                    <span id="selected-language-code">{{ $currentLanguage }}</span>
                </button>

                <div class="hs-dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                    <a href="{{ route('change-locale', 'en') }}" class="dropdown-item" data-translator-lang="en" title="English">
                        <img src="{{ URL::asset('assets/admin/images/flags/us.svg') }}" alt="English" class="me-1 size-4 rounded-full" height="18" data-translator-image="">
                        <span class="align-middle">English</span>
                    </a>
                    <a href="{{ route('change-locale', 'id') }}" class="dropdown-item" data-translator-lang="id" title="Indonesian">
                        <img src="{{ URL::asset('assets/admin/images/flags/id.svg') }}" alt="Indonesian" class="me-1 size-4 rounded-full" height="18" data-translator-image="">
                        <span class="align-middle">Indonesia</span>
                    </a>
                </div>
            </div>
            {{-- End: Language Selector --}}

            {{-- Start: User Dropdown --}}
            <div id="user-dropdown-detailed" class="topbar-item hs-dropdown before:bg-default-700/35 relative inline-flex before:h-4.5 before:w-px before:content-['']">
                <button class="hs-dropdown-toggle topbar-link ms-2.5 cursor-pointer items-center px-3! flex" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    {{-- Start Get Profile Photo --}}
                    @php
                        $profile_photo = Auth::user()?->userProfile?->profile_photo
                        ? URL::asset('storage/' . Auth::user()->userProfile->profile_photo)
                        : URL::asset('assets/admin/images/users/default.jpg');
                    @endphp
                    {{-- End Get Profile Photo --}}
                    
                    <img src="{{ $profile_photo }}" alt="user-image" class="size-8 rounded-full lg:me-3">
                    <div class="hidden lg:flex items-center gap-1.5">
                        <span class="flex flex-col items-start">
                            <h5 class="pro-username">{{ Auth::user()->name }}</h5>
                            <span class="text-xs/none mb-0.5">{{ ucwords(Auth::user()->roles->pluck('name')->toArray()[0]) }}</span>
                        </span>
                        <i class="iconify tabler--chevron-down align-middle"></i>
                    </div>
                </button>

                <div class="hs-dropdown-menu min-w-48" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                    <!-- Header -->
                    <div class="py-2 px-3.5">
                        <h6 class="text-xs">Hallo, {{ Auth::user()->name }}</h6>
                    </div>

                    <!-- My Profile -->
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="iconify tabler--user-circle text-base align-middle"></i>
                        <span class="align-middle">Profil Saya</span>
                    </a>

                    <!-- Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit" class="dropdown-item font-semibold">
                            <i class="iconify tabler--logout text-base align-middle text-danger"></i>
                            <span class="align-middle text-danger">Log Out</span>
                        </button>
                    </form>
                </div>
            </div>
            {{-- End: User Dropdown --}}    
        </div>
    </div>
</header>
{{-- End: Topbar --}}

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