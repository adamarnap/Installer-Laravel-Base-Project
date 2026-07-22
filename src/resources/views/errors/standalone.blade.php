<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('code') - @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('assets/landing/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ URL::asset('assets/landing/images/kdmp-logo-white.png') }}">

    <!-- Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Custom Error Pages CSS -->
    <link href="{{ URL::asset('assets/landing/css/error-pages.css') }}" rel="stylesheet">

    <style>
        /* Additional styles for standalone error pages */
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .light-dark-toggle {
            z-index: 9999;
        }
        
        /* Primary color for buttons */
        .bg-primary-500 {
            background-color: #ef2853;
        }
        
        .bg-primary-500:hover {
            background-color: #d91e44;
        }

        .hover\:bg-primary-400:hover {
            background-color: #d91e44;
        }
    </style>
</head>
<body class="bg-white dark:bg-[#0a0e19] transition-colors duration-300">

    <!-- Light/Dark Mode Button -->
    <button type="button" class="light-dark-toggle leading-none inline-block transition-all text-[#fe7a36] absolute top-[20px] md:top-[25px] ltr:right-[20px] rtl:left-[20px] ltr:md:right-[25px] rtl:md:left-[25px]" id="light-dark-toggle">
        <i class="material-symbols-outlined !text-[20px] md:!text-[22px]">
            light_mode
        </i>
    </button>
    <!-- End Light/Dark Mode Button -->

    <!-- Error Content -->
    <div class="py-[30px] min-h-screen flex items-center justify-center">
        <div class="w-full">
            @yield('content')
        </div>
    </div>
    <!-- End Error Content -->

    <!-- Light/Dark Mode Toggle Script -->
    <script>
        // Light/Dark Mode Toggle
        const toggle = document.getElementById('light-dark-toggle');
        const html = document.documentElement;
        const icon = toggle.querySelector('.material-symbols-outlined');
        
        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        
        if (currentTheme === 'dark') {
            html.classList.add('dark');
            icon.textContent = 'dark_mode';
        } else {
            html.classList.remove('dark');
            icon.textContent = 'light_mode';
        }
        
        toggle.addEventListener('click', function() {
            html.classList.toggle('dark');
            
            if (html.classList.contains('dark')) {
                icon.textContent = 'dark_mode';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.textContent = 'light_mode';
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>
