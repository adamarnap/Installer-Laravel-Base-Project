<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ $prefs_composer['title'] }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="{{ $prefs_composer['meta-description'] }}">
        <meta name="keywords" content="{{ $prefs_composer['meta-keywords'] }}">
        <meta name="author" content="{{ $prefs_composer['author'] }}" />

        {{-- Styles --}}
        @include('layouts.admin.partials.styles')

        {{-- Head Js --}}
        <script src="{{ URL::asset('assets/admin/js/config.js') }}"></script>

    <!-- Jquery for Datatables & Select2 -->
    <script src="{{ URL::asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    </head>


    <body>
        <div class="wrapper">
            {{-- Start: Topbar --}}
            @include('layouts.admin.partials.topbar')
            {{-- End: Topbar --}}
            
            {{-- Start: Sidebar --}}
            @include('layouts.admin.partials.sidebar')
            {{-- End: Sidebar --}}

            {{-- Start: Main Content --}}
            <div class="page-content">
                <main>
                    {{-- Start: Title and Breadcrumb --}}
                    <div class="page-title-head">
                        {{-- Start: Title --}}
                        <h4 class="page-main-title">@yield('title')</h4>
                        {{-- End: Title --}}

                        {{-- Start: Breadcrumb --}}
                        <div class="hidden items-center gap-1.25 text-sm md:flex">
                            @yield('breadcrumb')
                        </div>
                        {{-- End: Breadcrumb --}}
                    </div>
                    {{-- End: Title and Breadcrumb --}}

                    {{-- Start: Content --}}
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    {{-- End: Content --}}
                </main>

                {{-- Start: Footer --}}
                @include('layouts.admin.partials.footer')
                {{-- End: Footer --}}
            </div>
            {{-- End: Main Content --}}
        </div>

        {{-- Start: Scripts --}}
        @include('layouts.admin.partials.scripts')
        {{-- End: Scripts --}}
    </body>

</html>