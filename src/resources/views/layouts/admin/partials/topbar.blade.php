{{-- Start Get Profile Photo --}}
@php
    $profile_photo = Auth::user()?->userProfile?->profile_photo
    ? URL::asset('storage/' . Auth::user()->userProfile->profile_photo)
    : URL::asset('assets/admin/images/users/default.jpg');
@endphp
{{-- End Get Profile Photo --}}
<!-- Header -->
<div class="header">
    <div class="main-header h-[inherit]">
        <!-- Logo -->
        <div class="header-left active">
            <a href="{{ route('dashboard') }}" class="logo logo-normal">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo">
            </a>
            <a href="{{ route('dashboard') }}" class="logo logo-white">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo">
            </a>
            <a href="{{ route('dashboard') }}" class="logo-small">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo">
            </a>
        </div>
        <!-- /Logo -->
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <!-- Header Menu -->
        <ul class="nav user-menu items-center justify-center relative h-full transition-all duration-[0.5s] ease-[ease] m-0 pr-6">

            <!-- Search -->
            <li class="nav-item nav-searchinputs">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search hidden text-white text-xl h-[60px] leading-[60px] px-[15px]">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#" class="dropdown relative">
                        <div class="searchinputs input-group dropdown-toggle" id="dropdownMenuClickable" data-dropdown-toggle="search-dropdown">
                            <input type="text" placeholder="Search" class="focus:border-border-color focus:ring-0">
                            <div class="search-addon">
                                <span class="flex items-center justify-center cursor-pointer text-[#A6AAAF] rounded-[5px] absolute -translate-y-2/4 z-[9] start-2 top-1/2"><i class="ti ti-search"></i></span>
                            </div>
                            <span class="input-group-text">
                                <kbd class="flex items-center bg-secondary-transparent text-[10px] font-medium text-text-title py-0.5 p-1 rounded-[5px]"><img src="{{ URL::asset('assets/admin/img/icons/command.svg') }}" alt="img" class="me-1">K</kbd>
                            </span>
                        </div>
                        <div id="search-dropdown" class="dropdown-menu hidden search-dropdown w-[300px] h-[315px] shadow overflow-y-auto mt-0 p-5 rounded-[10px]">
                            <div class="text-sm text-text-default mt-0 mb-[15px] mx-0 pt-0 pb-[15px] px-0 border-b-border-color border-b">
                                <h6 class="flex items-center text-sm font-bold mb-[15px]"><span><i data-feather="search" class="feather-16 w-3.5 text-secondary me-1.5"></i></span>Recent Searches
                                </h6>
                                <ul class="search-tags flex items-center gap-[10px]">
                                    <li><a href="javascript:void(0);" class="block text-text-default bg-secondary-transparent px-2.5 py-[5px] rounded-[50px] hover:bg-primary hover:text-white">Products</a></li>
                                    <li><a href="javascript:void(0);" class="block text-text-default bg-secondary-transparent px-2.5 py-[5px] rounded-[50px] hover:bg-primary hover:text-white">Sales</a></li>
                                    <li><a href="javascript:void(0);" class="block text-text-default bg-secondary-transparent px-2.5 py-[5px] rounded-[50px] hover:bg-primary hover:text-white">Applications</a></li>
                                </ul>
                            </div>
                            <div class="text-sm text-text-default mt-0 mb-[15px] mx-0 pt-0 pb-[15px] px-0 border-b-border-color border-b">
                                <h6 class="flex items-center text-sm font-bold mb-[15px]"><span><i data-feather="help-circle" class="feather-16 w-3.5 text-secondary me-1.5"></i></span>Help</h6>
                                <p class="mb-[10px]">How to Change Product Volume from 0 to 200 on Inventory management</p>
                                <p>Change Product Name</p>
                            </div>
                            <div class="text-sm text-text-default mt-0 mx-0 pt-0 px-0">
                                <h6 class="flex items-center text-sm font-bold mb-[15px]"><span><i data-feather="user" class="feather-16 w-3.5 text-secondary me-1.5"></i></span>Customers</h6>
                                <ul class="customers">
                                    <li class="mb-[15px]"><a href="javascript:void(0);" class="text-text-default text-[15px] flex items-center justify-between hover:text-primary">Aron Varu<img src="{{ $profile_photo }}" alt="Img" class="w-[30px] h-[30px] border rounded-[100%] border-border-color"></a></li>
                                    <li class="mb-[15px]"><a href="javascript:void(0);" class="text-text-default text-[15px] flex items-center justify-between hover:text-primary">Jonita<img src="{{ URL::asset('assets/admin/img/profiles/avatar-01.jpg') }}" alt="Img" class="w-[30px] h-[30px] border rounded-[100%] border-border-color"></a></li> 
                                    <li><a href="javascript:void(0);" class="text-text-default text-[15px] flex items-center justify-between hover:text-primary">Aaron<img src="{{ URL::asset('assets/admin/img/profiles/avatar-10.jpg') }}" alt="Img" class="w-[30px] h-[30px] border rounded-[100%] border-border-color"></a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- /Search -->

            {{-- Start : Alert Impersonate --}}
            @if($impersonate_data['is_impersonating'])
                <li class="nav-item flex-1 flex items-center justify-center px-4">
                    <div class="inline-flex items-center gap-2 bg-danger border border-warning text-warning px-3 py-1.5 rounded-md">
                        <i class="ti ti-alert-triangle text-[18px] leading-none"></i>
                        <span class="text-xs font-medium whitespace-nowrap">
                            Mode impersonate aktif:
                            <strong>{{ $impersonate_data['impersonated_user']->name }}</strong>
                            <span class="hidden xl:inline">({{ $impersonate_data['impersonated_user']->email }})</span>
                        </span>
                        <form action="{{ route('settings.impersonate.destroy', $impersonate_data['impersonated_user']->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                title="Keluar dari mode impersonate"
                                class="inline-flex items-center justify-center w-6 h-6 bg-warning text-white hover:bg-warning-hover rounded transition-all cursor-pointer">
                                <i class="ti ti-logout text-[14px] leading-none"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endif
            {{-- End : Alert Impersonate --}}

            <!-- Select Store -->
            <li class="nav-item dropdown relative select-store-dropdown">
                <a href="javascript:void(0);" class="px-[8px] py-[6px] border border-[#E6EAED] rounded-[8px] nav-link select-store"
                    data-dropdown-toggle="store-dropdown">
                    <span class="user-info flex items-center justify-center relative ">
                        <span class="w-4 h-4 me-2">
                            <img src="{{ URL::asset('assets/admin/img/store/store-01.png') }}" alt="Store Logo" class="rounded">
                        </span>
                        <span class="user-detail">
                            <span class="text-sm font-normal text-gray-900">Freshmart</span>
                        </span>
                    </span>
                </a>
                <div id="store-dropdown" class="dropdown-menu p-2 hidden">
                    <a href="javascript:void(0);" class="flex items-center text-text-default text-[0.8125rem] px-[0.9375rem] py-2 whitespace-nowrap hover:bg-primary/5 hover:text-primary focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/store/store-01.png') }}" alt="Store Logo" class="w-5 h-5 rounded me-2">Freshmart
                    </a>
                    <a href="javascript:void(0);" class="flex items-center text-text-default text-[0.8125rem] px-[0.9375rem] py-2 whitespace-nowrap hover:bg-primary/5 hover:text-primary focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/store/store-02.png') }}" alt="Store Logo" class="w-5 h-5 rounded me-2">Grocery Apex
                    </a>
                    <a href="javascript:void(0);" class="flex items-center text-text-default text-[0.8125rem] px-[0.9375rem] py-2 whitespace-nowrap hover:bg-primary/5 hover:text-primary focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/store/store-03.png') }}" alt="Store Logo" class="w-5 h-5 rounded me-2">Grocery Bevy
                    </a>
                    <a href="javascript:void(0);" class="flex items-center text-text-default text-[0.8125rem] px-[0.9375rem] py-2 whitespace-nowrap hover:bg-primary/5 hover:text-primary focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/store/store-04.png') }}" alt="Store Logo" class="w-5 h-5 rounded me-2">Grocery Eden
                    </a>
                </div>
            </li>
            <!-- /Select Store -->

            <li class="nav-item dropdown relative link-nav">
                <a href="javascript:void(0);" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white btn-md inline-flex items-center" data-dropdown-toggle="new-dropdown">
                    <i class="ti ti-circle-plus me-1"></i>Add New
                </a>
                <div id="new-dropdown" class="hidden dropdown-menu p-5 w-[600px]">
                    <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-6 gap-[8px]">
                        <div>
                            <a href="category-list.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-brand-codepen"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Category</p>
                            </a>
                        </div>
                        <div>
                            <a href="add-product.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-square-plus"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Product</p>
                            </a>
                        </div>
                        <div>
                            <a href="category-list.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-shopping-bag"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Purchase</p>
                            </a>
                        </div>
                        <div>
                            <a href="online-orders.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Sale</p>
                            </a>
                        </div>
                        <div>
                            <a href="expense-list.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-file-text"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Expense</p>
                            </a>
                        </div>
                        <div>
                            <a href="quotation-list.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-device-floppy"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Quotation</p>
                            </a>
                        </div>
                        <div>
                            <a href="sales-returns.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-copy"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Return</p>
                            </a>
                        </div>
                        <div>
                            <a href="users.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-user"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">User</p>
                            </a>
                        </div>
                        <div>
                            <a href="customers.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-users"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Customer</p>
                            </a>
                        </div>
                        <div>
                            <a href="sales-report.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-shield"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Biller</p>
                            </a>
                        </div>
                        <div>
                            <a href="suppliers.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-user-check"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Supplier</p>
                            </a>
                        </div>
                        <div>
                            <a href="stock-transfer.html" class="group block text-center border border-border-color rounded-[8px] p-[10px] hover:bg-primary-100 hover:border-primary-100 transition-all">
                                <span class="w-[36px] h-[36px] rounded-[8px] mx-auto mb-2 inline-flex items-center justify-center text-secondary bg-secondary-transparent group-hover:bg-primary group-hover:text-white transition-all">
                                    <i class="ti ti-truck"></i>
                                </span>
                                <p class="text-[13px] text-text-default group-hover:text-primary">Transfer</p>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            
            <li class="nav-item pos-nav">
                <a href="pos.html" class="btn bg-dark border border-dark text-white text-center hover:bg-black hover:text-white btn-md inline-flex items-center">
                    <i class="ti ti-device-laptop me-1"></i>POS
                </a>
            </li>

            <!-- Flag -->
            <li class="nav-item dropdown relative flag-nav nav-item-box">
                <a class="nav-link dropdown-toggle"  data-dropdown-toggle="flag-dropdown" href="javascript:void(0);"
                    role="button">
                    <img src="{{ URL::asset('assets/admin/img/flags/us-flag.svg') }}" alt="Language" class="img-fluid">
                </a>
                <div id="flag-dropdown" class="dropdown-menu hidden dropdown-menu hidden-right">
                    <a href="javascript:void(0);" class="text-gray-500 rounded-[5px] font-medium px-4 py-2 hover:text-primary hover:bg-primary/5 focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/flags/english.svg') }}" alt="Img" height="16">English
                    </a>
                    <a href="javascript:void(0);" class="text-gray-500 rounded-[5px] font-medium px-4 py-2 hover:text-primary hover:bg-primary/5 focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary">
                        <img src="{{ URL::asset('assets/admin/img/flags/arabic.svg') }}" alt="Img" height="16">Arabic
                    </a>
                </div>
            </li>
            <!-- /Flag -->

            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen">
                    <i class="ti ti-maximize"></i>
                </a>
            </li>
            <li class="nav-item nav-item-box">
                <a href="email.html">
                    <i class="ti ti-mail"></i>
                    <span class="text-[11px] capitalize font-medium tracking-[0.5px] px-[0.45rem] py-[0.35rem] rounded-full leading-none rounded-pill">1</span>
                </a>
            </li>
            <!-- Notifications -->
            <li class="nav-item dropdown relative nav-item-box">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link"  data-dropdown-toggle="notification-dropdown">
                    <i class="ti ti-bell"></i>
                </a>
                <div id="notification-dropdown" class="dropdown-menu hidden notifications w-[350px] right-0">
                    <div class="border-b border-border-color text-center text-[12px] px-[20px] py-[15px] flex items-center justify-between">
                        <h5 class="notification-title">Notifications</h5>
                        <a href="javascript:void(0)" class="text-primary font-medium">Mark all as read</a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="border-b border-border-color">
                                <a href="activities.html" class="block relative p-5">
                                    <div class="media flex">
                                        <span class="w-12 h-12 me-2 shrink-0">
                                            <img alt="Img" src="{{ URL::asset('assets/admin/img/profiles/avatar-13.jpg') }}" class="rounded-[50%]">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="text-text-default font-medium mb-1"><span class="text-gray-900">James Kirwin</span> confirmed his order.  Order No: #78901.Estimated delivery: 2 days</p>
                                            <p class="text-text-default">4 mins ago</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="border-b border-border-color">
                                <a href="activities.html" class="block relative p-5">
                                    <div class="media flex">
                                        <span class="w-12 h-12 me-2 shrink-0">
                                            <img alt="Img" src="{{ URL::asset('assets/admin/img/profiles/avatar-03.jpg') }}" class="rounded-[50%]">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="text-text-default font-medium mb-1"><span class="text-gray-900">Leo Kelly</span> cancelled his order scheduled for  17 Jan 2025</p>
                                            <p class="text-text-default">10 mins ago</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="border-b border-border-color">
                                <a href="activities.html" class="block relative p-5 recent-msg">
                                    <div class="media flex">
                                        <span class="w-12 h-12 me-2 shrink-0">
                                            <img alt="Img" src="{{ URL::asset('assets/admin/img/profiles/avatar-17.jpg') }}" class="rounded-[50%]">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="text-text-default font-medium mb-1">Payment of $50 received for Order #67890 from <span class="text-gray-900">Antonio Engle</span></p>
                                            <p class="text-text-default">05 mins ago</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html" class="block relative p-5 recent-msg">
                                    <div class="media flex">
                                        <span class="w-12 h-12 me-2 shrink-0">
                                            <img alt="Img" src="{{ URL::asset('assets/admin/img/profiles/avatar-02.jpg') }}" class="rounded-[50%]">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="text-text-default font-medium mb-1"><span class="text-gray-900">Andrea</span> confirmed his order.  Order No: #73401.Estimated delivery: 3 days</p>
                                            <p class="text-text-default">4 mins ago</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="border-t border-border-color text-center px-[20px] py-[15px] flex items-center gap-3">
                        <a href="#" class="btn bg-secondary border border-secondary text-white text-center hover:bg-secondary-hover hover:text-white btn-md w-100">Cancel</a>
                        <a href="activities.html" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white btn-md w-100">View all</a>
                    </div>
                </div>
            </li>
            <!-- /Notifications -->

            <li class="nav-item nav-item-box">
                <a href="general-settings.html"><i class="ti ti-settings"></i></a>
            </li>
            <li class="nav-item dropdown relative profile-nav">
                <a href="javascript:void(0);" class="nav-link userset" data-dropdown-toggle="profile-dropdown">
                    <span class="user-info p-0">
                        <span class="user-letter flex items-center justify-center text-white w-8 h-8 font-semibold text-[15px] rounded-[10px]">
                            <img src="{{ $profile_photo }}" alt="Img" class="img-fluid">
                        </span>
                    </span>
                </a>
                <div id="profile-dropdown" class="dropdown-menu menu-drop-user hidden">
                    <div class="bg-light mb-2 p-4 rounded-[5px] flex items-center">
                        <span class="user-img me-2">
                            <img src="{{ $profile_photo }}" alt="Img" class="w-10 h-10 shrink-0 rounded-[50%]">
                        </span>
                        <div>
                            <h6 class="font-medium">{{ Auth::user()->name }}</h6>
                            <p>{{ ucwords(Auth::user()->roles->pluck('name')->toArray()[0]) }}</p>
                        </div>
                    </div>
                    <a class="dropdown-item flex items-center font-medium px-4 py-2 hover:text-primary hover:bg-primary/5 focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary" href="{{ route('profile.edit') }}"><i class="ti ti-user-circle me-2"></i>Profile Saya</a>
                    <hr class="my-2">
                    {{-- START: Logout Button --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit" 
                            class="btn dropdown-item flex items-center font-medium text-danger px-4 py-2 hover:text-danger-hover hover:bg-primary/5 focus:bg-primary/5 focus:text-danger-hover active:bg-primary/5 active:text-danger-hover" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-2"></i>
                            Logout
                        </button>
                    </form>
                    {{-- End: Logout Button --}}
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-dropdown-toggle="mobile-dropdown"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu hidden dropdown-menu hidden-right" id="mobile-dropdown">
                <a class="flex items-center font-medium px-4 py-2 hover:text-primary hover:bg-primary/5 focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary" href="{{ route('profile.edit') }}">Profile Saya</a>
                {{-- START: Logout Button --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit" 
                        class="btn flex items-center font-medium px-4 py-2 hover:text-primary hover:bg-primary/5 focus:bg-primary/5 focus:text-primary active:bg-primary/5 active:text-primary" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti ti-logout me-2"></i>
                        Logout
                    </button>
                </form>
                {{-- End: Logout Button --}}
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
</div>
<!-- /Header -->

{{-- Start: Scripts --}}
@push('scripts')
    {{-- Start: Sweetalert Confirmation Logout --}}

    {{-- End: Sweetalert Confirmation Logout --}}
@endpush
{{-- End: Scripts --}}
