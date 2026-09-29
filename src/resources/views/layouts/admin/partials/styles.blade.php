<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/bootstrap-datetimepicker.min.css') }}">

<!-- animation CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/animate.css') }}">

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/select2/css/select2.min.css') }}">

<!-- Daterangepikcer CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">

<!-- Tabler Icon CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/tabler-icons/tabler-icons.min.css') }}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/fontawesome/css/all.min.css') }}">

<!-- Flowbite CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/flowbite.min.css') }}">
    
<!-- Main CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/style.css') }}">

<!-- Submenu Icon CSS -->
<style>
    .sidebar .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon::after,
    .settings-sidebar .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon::after,
    .sidebarOne .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon::after,
    .sidebar .sidebar-menu .submenu-open .submenu ul li a:has(i)::after,
    .settings-sidebar .sidebar-menu .submenu-open .submenu ul li a:has(i)::after,
    .sidebarOne .sidebar-menu .submenu-open .submenu ul li a:has(i)::after {
        display: none !important;
    }
    .sidebar .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon,
    .settings-sidebar .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon,
    .sidebarOne .sidebar-menu .submenu-open .submenu ul li a.has-submenu-icon,
    .sidebar .sidebar-menu .submenu-open .submenu ul li a:has(i),
    .settings-sidebar .sidebar-menu .submenu-open .submenu ul li a:has(i),
    .sidebarOne .sidebar-menu .submenu-open .submenu ul li a:has(i) {
        padding-left: 20px !important;
    }

    /* Fallback for legacy ti-layout-grid2 if present in DB or cache */
    .ti-layout-grid2:before {
        content: "\eaeb";
    }
</style>

@stack('styles')