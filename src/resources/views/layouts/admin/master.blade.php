<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout-mode="light_mode">

<head>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ $prefs_composer['meta-description'] }}">
    <meta name="keywords" content="{{ $prefs_composer['meta-keywords'] }}">
    <meta name="author" content="{{ $prefs_composer['author'] }}">
	<meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') | {{ $prefs_composer['title'] }}</title>

    {{-- Start: Favicon --}}
    <link rel="icon" type="image/png" href="{{ URL::asset($prefs_composer['favicon']) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset($prefs_composer['favicon']) }}">
    {{-- End: Favicon --}}

    {{-- Start: Load Styles --}}
    @include('layouts.admin.partials.styles')
    {{-- End: Load Styles --}}

    {{-- Start: Load main Theme JS --}}
    {{-- Start : Load asset for JS file --}}
    <script>
        window.Laravel = {
            assetUrl: "{{ asset('') }}"
        };
    </script>
    {{-- End : Load asset for JS file --}}
    <script src="{{ URL::asset('assets/admin/js/theme-script.js') }}"></script>	
    {{-- End: Load main Theme JS --}}
</head>

<body>
    <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>

	{{-- Start : Main Wrapper --}}
	<div class="main-wrapper">
        {{-- Start: Header --}}
        @include('layouts.admin.partials.topbar')
        {{-- End: Header --}}

        {{-- Start: Sidebar --}}
        {{-- Start: Vertical Sidebar --}}
        @include('layouts.admin.partials.sidebar')
        {{-- End: Vertical Sidebar --}}
        
        {{-- Start: Horizontal Sidebar --}}
        @include('layouts.admin.partials.horizontal-sidebar')
        {{-- End: Horizontal Sidebar --}}
        
        {{-- Start: Two Col Sidebar --}}
        @include('layouts.admin.partials.two-col-sidebar')
        {{-- End: Two Col Sidebar --}}
        {{-- End: Sidebar --}}

        {{-- Start : Main Content --}}
        <div class="page-wrapper">
			<div class="content">
                <div class="flex items-center justify-between flex-wrap gap-3 mb-2">
                    {{-- Start : Content Title --}}
					<div class="mb-4">
						<h1 class="mb-1">@yield('title')</h1>
					</div>
                    {{-- End : Content Title --}}

                    {{-- Start : Breadcrumb --}}
					<div class="input-icon-start relative mb-4">
                        @yield('breadcrumb')
                    </div>
                    {{-- Start : Breadcrumb --}}
				</div>

                {{-- Start : Content --}}
                @yield('content')
                {{-- End : Content --}}
            </div>

            {{-- Start : Footer --}}
            @include('layouts.admin.partials.footer')
            {{-- End : Footer --}}
        </div>
        {{-- End : Main Content --}}
    </div>
    {{-- End : Main Wrapper --}}

    {{-- Start : Load Scripts --}}
    @include('layouts.admin.partials.scripts')
    {{-- End : Load Scripts --}}

    {{-- Start : Alert Scripts --}}
    @include('layouts.admin.partials.alert-script')
    {{-- End : Alert Scripts --}}

</body>
</html>