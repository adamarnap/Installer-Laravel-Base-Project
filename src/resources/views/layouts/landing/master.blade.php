<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="elite-themes24">
    <meta name="description" content="Martex - Tailwind CSS Software, SaaS & Startup Template">
    <meta name="keywords"
        content="Responsive, HTML5, elite-themes24, Landing, Software, Mobile App, SaaS, Startup, Creative, Digital Product">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SITE TITLE -->
    <title>@yield('title') | {{ $prefs_composer['title'] }}</title>
    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/landing/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('assets/landing/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ URL::asset('assets/landing/images/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ URL::asset('assets/landing/images/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ URL::asset('assets/landing/images/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" href="{{ URL::asset('assets/landing/images/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ URL::asset('assets/landing/images/apple-touch-icon.png') }}">
    
    {{-- START: Include Styles --}}
    @include('layouts.landing.partials.styles')
    {{-- END: Include Styles --}}
</head>

<body>
    <!-- PRELOADER SPINNER ============================================= -->
    <div id="loading" class="loading--theme  h-full w-full fixed z-[99999999] mt--0 top-0 bg-[#f5f5f9]">
        <div id="loading-center"
            class="absolute !h-[100px] !w-[100px] mt-[-50px] ml-[-50px] animate-[loading-center-absolute_1s_infinite] left-2/4 top-2/4 lg:max-xl:!h-[90px] lg:max-xl:!w-[90px] lg:max-xl:!mt-[-45px] lg:max-xl:ml-[-45px] md:max-lg:!h-[90px] md:max-lg:!w-[90px] md:max-lg:!mt-[-45px] md:max-lg:ml-[-45px]">
            <span
                class="loader !w-[100px] !h-[100px] inline-block relative box-border animate-[rotation_1s_linear_infinite] rounded-[50%] border-2 border-solid border-[transparent_#888] after:content-[''] after:box-border after:absolute after:-translate-x-2/4 after:-translate-y-2/4 after:rounded-[50%] after:border-[50px] after:border-solid after:border-[transparent_rgba(30,30,30,0.15)] after:left-2/4 after:!top-2/4 lg:max-xl:!w-[90px] lg:max-xl:!h-[90px] lg:max-xl:after:border-[45px] lg:max-xl:after:border-solid md:max-lg:!w-[90px] md:max-lg:!h-[90px] md:max-lg:after:border-[45px] md:max-lg:after:border-solid sm:max-md:!w-[80px] sm:max-md:!h-[80px] sm:max-md:after:border-[40px] sm:max-md:after:border-solid"></span>
        </div>
    </div>
    <!-- STYLE SWITCHER ============================================= -->
    <div id="stlChanger"
        class="fixed z-[9999] !text-[15px] overflow-hidden right-[-230px] cursor-pointer transition-all duration-[400ms] ease-[ease-in-out] rounded-none top-[100px] xsm:max-sm:hidden">
        <div class="blockChanger bgChanger min-w-[280px] min-h-[280px] !w-[230px]">
            <a href="#"
                class="chBut icon-xs !w-[50px] !h-[50px] !absolute z-[1000000] !text-center transition-all duration-300 ease-[ease-in-out] shadow-[0_0_2px_rgba(50,50,50,0.4)] pl-[2px] pr-0 py-0 rounded-[4px_0px_0px_4px] ![border-left:none] [border:1px_solid_#ef2853] left-0 top-[30px] bg-[#ef2853]"><span
                    class="flaticon-control-panel before:content-['\f1cf'] before:!text-white before:!text-[2.15rem]"></span></a>
            <div
                class="chBody white-color !w-[230px] relative border !h-[425px] overflow-scroll overflow-x-hidden ml-[50px] rounded-[4px_0px_0px_4px] border-solid border-[#2b2e37] bg-[#2b2e37] [direction:rtl]">
                <div class="stBlock !text-center" style="margin: 30px 20px 20px 26px;">
                    <div class="stBgs">
                        <p
                            class="switch !text-[18px] font-semibold tracking-[0] !mb-[20px] font-Jakarta w-full !text-white rounded px-[1.4rem] py-[0.4rem] border-2 border-solid border-white !leading-[1.6666]">
                        </p>
                        <p class="color--white !text-[1.125rem] font-semibold tracking-[0] !mb-[20px] font-Jakarta">
                            Color
                            Scheme</p>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('pink-theme', 60)"><img src="{{ URL::asset('assets/landing/images/color-scheme/pink.jpg') }}"
                                class=" !w-[50px] !h-[50px] rounded-[8px]" alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('purple-theme', 60)"><img
                                src="{{ URL::asset('assets/landing/images/color-scheme/purple.jpg') }}" class=" !w-[50px] !h-[50px] rounded-[8px]"
                                alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('violet-theme', 60)"><img
                                src="{{ URL::asset('assets/landing/images/color-scheme/violet.jpg') }}" class=" !w-[50px] !h-[50px] rounded-[8px]"
                                alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('skyblue-theme', 60)"><img
                                src="{{ URL::asset('assets/landing/images/color-scheme/skyblue.jpg') }}" class=" !w-[50px] !h-[50px] rounded-[8px]"
                                alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('magenta-theme', 60)"><img
                                src="{{ URL::asset('assets/landing/images/color-scheme/magenta.jpg') }}" class=" !w-[50px] !h-[50px] rounded-[8px]"
                                alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('crocus-theme', 60)"><img
                                src="{{ URL::asset('assets/landing/images/color-scheme/crocus.jpg') }}" class=" !w-[50px] !h-[50px] rounded-[8px]"
                                alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('red-theme', 60)"><img src="{{ URL::asset('assets/landing/images/color-scheme/red.jpg') }}"
                                class=" !w-[50px] !h-[50px] rounded-[8px]" alt=""></a>
                        <a class=" no-underline !w-[50px] !h-[50px] float-left cursor-pointer opacity-100 !mt-0 !mb-[8px] mx-[5px] !p-0 rounded-[8px]"
                            href="javascript:chooseStyle('green-theme', 60)"><img src="{{ URL::asset('assets/landing/images/color-scheme/green.jpg') }}"
                                class=" !w-[50px] !h-[50px] rounded-[8px]" alt=""></a>
                    </div>
                </div>
                <div class="stBlock !text-center" style="margin: 0px 27px 25px 31px;">
                    <a class="btn rounded-[4px] btn--theme hover--theme w-full leading-none mt-[15px] !px-[1.2rem] !py-[0.65rem]"
                        href="javascript:chooseStyle('none', 60)">Reset
                        Color</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END SWITCHER -->
    <!-- PAGE CONTENT ============================================= -->
    <div id="page" class="page font--jakarta">
        {{-- START: Include Topbar --}}
        @include('layouts.landing.partials.topbar')
        {{-- END: Include Topbar --}}

        {{-- START : Main Content --}}
        @yield('content')
        {{-- END : Main Content --}}

        {{-- START: Include Footer --}}
        @include('layouts.landing.partials.footer')
        {{-- END: Include Footer --}}
    </div>
    <!-- END PAGE CONTENT -->


    {{-- START : SCRIPTS --}}
    @include('layouts.landing.partials.scripts')
    {{-- END : SCRIPTS --}}
</body>

</html>
