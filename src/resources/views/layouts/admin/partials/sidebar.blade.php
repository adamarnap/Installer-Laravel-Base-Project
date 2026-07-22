{{-- Start Get Profile Photo --}}
@php
    $userData = Auth::user();
    $profile_photo = $userData?->userProfile?->profile_photo
    ? URL::asset('storage/' . $userData->userProfile->profile_photo)
    : URL::asset('assets/admin/images/users/default.jpg');
@endphp
{{-- End Get Profile Photo --}}
<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo items-center active">
        <a href="{{ route('dashboard') }}" class="logo logo-normal">
            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-white">
            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
        </a>
        <a href="{{ route('dashboard') }}" class="logo-small">
            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="Img">
        </a>
        <a id="toggle_btn" href="javascript:void(0);" class="flex items-center justify-center absolute end-[-13px] w-[25px] h-[25px] bg-primary text-white rounded-full opacity-100 cursor-pointer transition-all duration-300 hover:bg-primary-hover">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->
    <div class="modern-profile p-4 pb-0">
        <div class="text-center rounded bg-light p-4 mb-6 user-profile">
            <div class="relative size-[45px] mx-auto mb-4">
                <img src="{{ $profile_photo }}" alt="Img" class="img-fluid rounded-full">
                <span class="bottom-0 end-0 absolute  size-3.5 bg-success border-2 border-white rounded-full"></span>
            </div>
            <h6 class="text-sm font-bold mb-1">{{ $userData->name }}</h6>
            <p class="text-xs mb-0">{{ $userData->email }}</p>
        </div>
        <div class="sidebar-nav mb-4">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
                <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-header p-4 pb-0 pt-2">
        <div class="text-center rounded bg-light p-2 mb-6 sidebar-profile flex items-center">
            <div class="size-8 onlin">
                <img src="{{ $profile_photo }}" alt="Img" class="img-fluid rounded-full">
            </div>
            <div class="text-start sidebar-profile-info ms-2">
                <h6 class="text-sm font-bold mb-1">{{ $userData->name }}</h6>
                <p class="text-xs">{{ $userData->email }}</p>
            </div>
        </div>
        <div class="flex items-center justify-between menu-item mb-4">
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-layout-grid-remove"></i>
                </a>
            </div>
            <div>
                <a href="chat.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-brand-hipchat"></i>
                </a>
            </div>
            <div>
                <a href="email.html" class="btn btn-sm btn-icon bg-light relative">
                    <i class="ti ti-message"></i>
                </a>
            </div>
            <div class="notification-item">
                <a href="activities.html" class="btn btn-sm btn-icon bg-light relative">
                    <i class="ti ti-bell"></i>
                    <span class="notification-status-dot"></span>
                </a>
            </div>
            <div class="me-0">
                <a href="general-settings.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-settings"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            {{-- Start : List Menu --}}
            @include('layouts.admin.partials.menu-list')
            {{-- End : List Menu --}}
        </div>
    </div>
</div>