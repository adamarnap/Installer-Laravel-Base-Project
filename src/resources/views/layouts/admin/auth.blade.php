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
    </head>

<body>
    <!-- Start: Page Content here -->
    <div class="flex min-h-screen items-center p-12.5">
        <div class="container">
            <div class="flex justify-center">
                <div class="xl:w-5/6">
                    <div class="absolute end-0 top-0">
                        <img src="{{ URL::asset('assets/admin/images/auth-card-bg.svg') }}" alt="auth-card-bg" />
                    </div>

                    <div class="absolute start-0 bottom-0 rotate-180">
                        <img src="{{ URL::asset('assets/admin/images/auth-card-bg.svg') }}" alt="auth-card-bg" />
                    </div>
                    <div class="card rounded-2xl">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                                <div class="card-body relative p-12.5">
                                    <!-- Start: Logo -->
                                    <div class="mb-7.5 flex flex-col items-center justify-center text-center">
                                        <a href="index.html" class="auth-logo">
                                            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="logo" class="flex dark:hidden" />
                                            <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="dark logo" class="hidden dark:flex" />
                                        </a>
                                        @php
                                            $title = $__env->yieldContent('title');
                                            $titlePage = '';
                                            $sambutan = '';

                                            if ($title == 'Masuk') {
                                                $sambutan = 'Silahkan masuk untuk memulai pengalaman anda.';
                                                $titlePage = 'Masuk';
                                            } elseif ($title == 'Daftar') {
                                                $sambutan = 'Mari kita mulai. Buat akun Anda dengan memasukkan detail Anda di bawah ini.';
                                                $titlePage = 'Daftar';
                                            } elseif ($title == 'Lupa Kata Sandi') {
                                                $sambutan = 'Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda menggantinya dengan yang baru.';
                                                $titlePage = 'Lupa Kata Sandi';
                                            } elseif ($title == 'Verifikasi Email') {
                                                $sambutan = 'Silahkan cek email yang Anda berikan saat pendaftaran, link verifikasi ada di dalamnya!';
                                                $titlePage = 'Verifikasi Email';
                                            } elseif ($title == 'Atur Ulang Kata Sandi') {
                                                $sambutan = 'Silakan masukkan kata sandi baru Anda dan konfirmasi kata sandi baru Anda di bawah ini.';
                                                $titlePage = 'Atur Ulang Kata Sandi';
                                            }
                                        @endphp
                                        <h1 class="mt-5 mb-1 text-xl font-bold">{{ $titlePage }}</h1>
                                        <h4 class="mt-2 mb-2 text-base font-bold">Selamat datang di aplikasi {{ $prefs_composer['app_name'] }}</h4>

                                        
                                        <p class="text-default-400 mx-auto w-full lg:w-3/4">
                                            {{ $sambutan }}
                                        </p>
                                    </div>
                                    <!-- End: Logo -->

                                    {{-- Start: Author --}}
                                    <p class="relative my-5 text-center text-default-400 after:absolute after:start-0 after:end-0 after:top-2.75 after:h-0.75 after:border-t after:border-b after:border-dashed after:border-default-300">
                                        <span class="relative z-10 bg-card font-medium px-4">{{ $prefs_composer['author'] }}</span>
                                    </p>
                                    {{-- End: Author --}}

                                    {{-- Start : Session Status --}}
                                    @if (session('status'))
                                        @if(session('status') == 'verification-link-sent')
                                            <div class="bg-success/15 text-success flex items-center rounded px-4 py-3">
                                                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                                            </div>
                                        @else
                                        <div class="bg-success/15 text-success flex items-center rounded px-4 py-3" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                    @endif
                                    {{-- End : Session Status --}}

                                    {{-- Start : Validation Errors --}}
                                    @if ($errors->any())
                                        <div class="bg-danger/15 text-danger flex items-center rounded px-4 py-3"
                                            role="alert">
                                            <b><i class="bi bi-x-octagon"></i> Error :</b>
                                            <ul>
                                                @error('email')
                                                    <li>{{ $message }}</li>
                                                @enderror
                                                @error('password')
                                                    <li>{{ $message }}</li>
                                                @enderror
                                                @error('g-recaptcha-response')
                                                    <li>{{ $message }}</li>
                                                @enderror
                                                @error('name')
                                                    <li>{{ $message }}</li>
                                                @enderror
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    {{-- Start : Content Auth --}}
                                    <div class="rounded-md">
                                        {{-- Start : Login Form --}}
                                        @yield('auth-form')
                                        {{-- End : Login Form --}}

                                        {{-- Start : Footer Auth --}}
                                        <p class="text-default-400 mt-7.5 text-center">
                                            <span class="text-purple-500">{{ $prefs_composer['title'] }}</span> {!! $prefs_composer['copyright'] !!} {!! $prefs_composer['credits'] !!}
                                        </p>
                                        {{-- End : Footer Auth --}}
                                    </div>
                                    {{-- End : Content Auth --}}

                                </div>
                            {{-- Start: Background Image --}}
                            <div class="relative hidden h-full overflow-hidden rounded-e-2xl bg-cover bg-center object-cover lg:block"
                                style="background-image: url(&quot;assets/admin/images/auth/bantul.jpg&quot;)">
                                <div class="absolute inset-0 flex items-end justify-center rounded-e-sm p-9 [background:linear-gradient(to_top,#313a46,rgba(49,58,70,.8),rgba(49,58,70,.5))]"></div>
                            </div>
                            {{-- End: Background Image --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Page content -->

    {{-- Start: Theme Customization --}}
    <div>
        <div id="theme-customization"
            class="hs-overlay hs-overlay-open:translate-x-0 bg-card hs-overlay-open:flex fixed inset-y-0 end-0 bottom-0 z-80 hidden w-full max-w-[400px] translate-x-full transform flex-col overflow-hidden transition-all duration-300 rtl:-translate-x-full">
            <div
                class="bg-primary text-default-600 border-default-900/10 flex items-start gap-3 border-b border-dashed bg-[url(../images/settings-bg.png)] p-6">
                <div>
                    <h5 class="mb-1.25 text-sm font-bold text-white uppercase">Admin Customizer</h5>
                    <p class="font-medium text-white/75 italic">Easily configure layout, styles, and preferences for your
                        admin interface.</p>
                </div>

                <div class="grow">
                    <button type="button" data-hs-overlay="#theme-customization"
                        class="btn btn-sm bg-default-100/20 size-7.5 rounded-full text-white">
                        <i class="iconify tabler--x text-base"></i>
                    </button>
                </div>
            </div>

            <div class="h-full grow overflow-y-auto" data-simplebar="">
                <div class="divide-default-300 divide-y divide-dashed">
                    <div id="skin" class="p-6">
                        <h5 class="text-md mb-5 font-bold">Select Theme</h5>
                        <div class="grid grid-cols-2 gap-3">

                            <div class="card-radio" id="skin-default">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-default"
                                    value="default">
                                <label class="form-label" for="demo-skin-default">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-default.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Default</h5>
                            </div>


                            <div class="card-radio" id="skin-minimal">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-minimal"
                                    value="minimal">
                                <label class="form-label" for="demo-skin-minimal">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-minimal.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Minimal</h5>
                            </div>


                            <div class="card-radio" id="skin-modern">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-modern"
                                    value="modern">
                                <label class="form-label" for="demo-skin-modern">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-modern.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Modern</h5>
                            </div>


                            <div class="card-radio" id="skin-material">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-material"
                                    value="material">
                                <label class="form-label" for="demo-skin-material">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-material.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Material</h5>
                            </div>


                            <div class="card-radio" id="skin-saas">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-saas"
                                    value="saas">
                                <label class="form-label" for="demo-skin-saas">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-saas.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Saas</h5>
                            </div>


                            <div class="card-radio" id="skin-flat">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-flat"
                                    value="flat">
                                <label class="form-label" for="demo-skin-flat">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-flat.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Flat</h5>
                            </div>


                            <div class="card-radio" id="skin-galaxy">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-galaxy"
                                    value="galaxy">
                                <label class="form-label" for="demo-skin-galaxy">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-galaxy.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Galaxy</h5>
                            </div>


                            <div class="card-radio" id="skin-luxe">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-luxe"
                                    value="luxe">
                                <label class="form-label" for="demo-skin-luxe">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-luxe.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Luxe</h5>
                            </div>


                            <div class="card-radio" id="skin-retro">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-retro"
                                    value="retro">
                                <label class="form-label" for="demo-skin-retro">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-retro.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Retro</h5>
                            </div>


                            <div class="card-radio" id="skin-neon">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-neon"
                                    value="neon">
                                <label class="form-label" for="demo-skin-neon">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-neon.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Neon</h5>
                            </div>


                            <div class="card-radio" id="skin-pixel">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-pixel"
                                    value="pixel">
                                <label class="form-label" for="demo-skin-pixel">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-pixel.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Pixel</h5>
                            </div>


                            <div class="card-radio" id="skin-soft">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-soft"
                                    value="soft">
                                <label class="form-label" for="demo-skin-soft">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-soft.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Soft</h5>
                            </div>


                            <div class="card-radio" id="skin-mono">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-mono"
                                    value="mono">
                                <label class="form-label" for="demo-skin-mono">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-mono.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Mono</h5>
                            </div>


                            <div class="card-radio" id="skin-zen">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-zen"
                                    value="zen">
                                <label class="form-label" for="demo-skin-zen">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-zen.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Zen</h5>
                            </div>


                            <div class="card-radio" id="skin-silver">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-silver"
                                    value="silver">
                                <label class="form-label" for="demo-skin-silver">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-silver.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Silver</h5>
                            </div>


                            <div class="card-radio" id="skin-prism">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-prism"
                                    value="prism">
                                <label class="form-label" for="demo-skin-prism">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-prism.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Prism</h5>
                            </div>


                            <div class="card-radio" id="skin-nova">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-nova"
                                    value="nova">
                                <label class="form-label" for="demo-skin-nova">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-nova.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Nova</h5>
                            </div>


                            <div class="card-radio" id="skin-elegant">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-elegant"
                                    value="elegant">
                                <label class="form-label" for="demo-skin-elegant">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-elegant.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Elegant</h5>
                            </div>


                            <div class="card-radio" id="skin-vivid">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-vivid"
                                    value="vivid">
                                <label class="form-label" for="demo-skin-vivid">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-vivid.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Vivid</h5>
                            </div>


                            <div class="card-radio" id="skin-matrix">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-matrix"
                                    value="matrix">
                                <label class="form-label" for="demo-skin-matrix">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-matrix.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Matrix</h5>
                            </div>


                            <div class="card-radio" id="skin-neo">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-neo"
                                    value="neo">
                                <label class="form-label" for="demo-skin-neo">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-neo.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Neo</h5>
                            </div>


                            <div class="card-radio" id="skin-xenon">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-xenon"
                                    value="xenon">
                                <label class="form-label" for="demo-skin-xenon">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-xenon.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Xenon</h5>
                            </div>


                            <div class="card-radio" id="skin-crystal">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-crystal"
                                    value="crystal">
                                <label class="form-label" for="demo-skin-crystal">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-crystal.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Crystal</h5>
                            </div>


                            <div class="card-radio" id="skin-aurora">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-aurora"
                                    value="aurora">
                                <label class="form-label" for="demo-skin-aurora">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-aurora.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Aurora</h5>
                            </div>


                            <div class="card-radio" id="skin-orbit">
                                <input class="hidden" type="radio" name="data-skin" id="demo-skin-orbit"
                                    value="orbit">
                                <label class="form-label" for="demo-skin-orbit">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/skin-orbit.png') }}" alt="layout-img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Orbit</h5>
                            </div>

                        </div>
                    </div>

                    <div id="dir" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Theme Direction</h5>

                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio">
                                <input class="hidden" type="radio" name="dir" id="direction-ltr" value="ltr">
                                <label class="form-label" for="direction-ltr">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/theme-light.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">LTR Mode</h5>
                            </div>

                            <div class="card-radio">
                                <input class="hidden" type="radio" name="dir" id="direction-rtl" value="rtl">
                                <label class="form-label" for="direction-rtl">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/theme-light.png') }}" alt="layout img"
                                        class="flex size-full scale-x-[-1] rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">RTL Mode</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidenav-size" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Sidenav View</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio" id="sidenav-size-default">
                                <input class="hidden" type="radio" name="data-sidenav-size" id="sidenav-view-default"
                                    value="default">
                                <label class="form-label" for="sidenav-view-default">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-default.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Default</h5>
                            </div>

                            <div class="card-radio" id="sidenav-size-compact">
                                <input class="hidden" type="radio" name="data-sidenav-size" id="sidenav-view-compact"
                                    value="compact">
                                <label class="form-label" for="sidenav-view-compact">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-compact.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Compact</h5>
                            </div>

                            <div class="card-radio" id="sidenav-size-condensed">
                                <input class="hidden" type="radio" name="data-sidenav-size"
                                    id="sidenav-view-condensed" value="condensed">
                                <label class="form-label" for="sidenav-view-condensed">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-condensed.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Condensed</h5>
                            </div>

                            <div class="card-radio" id="sidenav-size-on-hover">
                                <input class="hidden" type="radio" name="data-sidenav-size" id="sidenav-view-hover"
                                    value="on-hover">
                                <label class="form-label" for="sidenav-view-hover">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-condensed.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">On Hover</h5>
                            </div>

                            <div class="card-radio" id="sidenav-size-on-hover-active">
                                <input class="hidden" type="radio" name="data-sidenav-size"
                                    id="sidenav-view-hover-active" value="on-hover-active">
                                <label class="form-label" for="sidenav-view-hover-active">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-default.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">On Hover- Show</h5>
                            </div>

                            <div class="card-radio" id="sidenav-size-offcanvas">
                                <input class="hidden" type="radio" name="data-sidenav-size" id="sidenav-view-mobile"
                                    value="offcanvas">
                                <label class="form-label" for="sidenav-view-mobile">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-size-offcanvas.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Offcanvas</h5>
                            </div>
                        </div>
                    </div>

                    <div id="theme" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Theme Mode</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio" id="theme-light">
                                <input class="hidden" type="radio" name="data-theme" id="layout-color-light"
                                    value="light">
                                <label class="form-label" for="layout-color-light">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/theme-light.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Light</h5>
                            </div>

                            <div class="card-radio" id="theme-dark">
                                <input class="hidden" type="radio" name="data-theme" id="layout-color-dark"
                                    value="dark">
                                <label class="form-label" for="layout-color-dark">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/theme-dark.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Dark</h5>
                            </div>

                            <div class="card-radio" id="theme-system">
                                <input class="hidden" type="radio" name="data-theme" id="layout-color-system"
                                    value="system">
                                <label class="form-label" for="layout-color-system">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/theme-system.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">System</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidenav-color" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Sidenav Color</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio" id="sidenav-color-light">
                                <input class="hidden" type="radio" name="data-menu-color" id="menu-color-light"
                                    value="light">
                                <label class="form-label" for="menu-color-light">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-color-light.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Light</h5>
                            </div>

                            <div class="card-radio" id="sidenav-color-dark">
                                <input class="hidden" type="radio" name="data-menu-color" id="menu-color-dark"
                                    value="dark">
                                <label class="form-label" for="menu-color-dark">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-color-dark.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Dark</h5>
                            </div>

                            <div class="card-radio" id="sidenav-color-gradient">
                                <input class="hidden" type="radio" name="data-menu-color" id="menu-color-gradient"
                                    value="gradient">
                                <label class="form-label" for="menu-color-gradient">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-color-gradient.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Gradient</h5>
                            </div>

                            <div class="card-radio" id="sidenav-color-gray">
                                <input class="hidden" type="radio" name="data-menu-color" id="menu-color-gray"
                                    value="gray">
                                <label class="form-label" for="menu-color-gray">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-color-gray.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Gray</h5>
                            </div>

                            <div class="card-radio" id="sidenav-color-image">
                                <input class="hidden" type="radio" name="data-menu-color" id="menu-color-image"
                                    value="image">
                                <label class="form-label" for="menu-color-image">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/sidenav-color-image.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Image</h5>
                            </div>
                        </div>
                    </div>

                    <div id="topbar-color" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Topbar Color</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio" id="topbar-color-light">
                                <input class="hidden" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-light" value="light">
                                <label class="form-label" for="layout-topbar-color-light">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/topbar-color-light.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Light</h5>
                            </div>

                            <div class="card-radio" id="topbar-color-dark">
                                <input class="hidden" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-dark" value="dark">
                                <label class="form-label" for="layout-topbar-color-dark">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/topbar-color-dark.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Dark</h5>
                            </div>

                            <div class="card-radio" id="topbar-color-gradient">
                                <input class="hidden" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-gradient" value="gradient">
                                <label class="form-label" for="layout-topbar-color-gradient">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/topbar-color-gradient.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Gradient</h5>
                            </div>

                            <div class="card-radio" id="topbar-color-gray">
                                <input class="hidden" type="radio" name="data-topbar-color"
                                    id="layout-topbar-color-gray" value="gray">
                                <label class="form-label" for="layout-topbar-color-gray">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/topbar-color-gray.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Gray</h5>
                            </div>
                        </div>
                    </div>

                    <div id="width" class="p-5">
                        <h5 class="text-md mb-5 font-bold">Layout Width</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-base">
                            <div class="card-radio" id="width-fluid">
                                <input class="hidden" type="radio" name="data-layout-width" id="layout-width-fluid"
                                    value="fluid">
                                <label class="form-label" for="layout-width-fluid">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/width-fluid.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Fluid</h5>
                            </div>

                            <div class="card-radio" id="width-boxed">
                                <input class="hidden" type="radio" name="data-layout-width" id="layout-width-boxed"
                                    value="boxed">
                                <label class="form-label" for="layout-width-boxed">
                                    <img src="{{ URL::asset('assets/admin/images/layouts/width-boxed.png') }}" alt="layout img"
                                        class="flex size-full rounded-md">
                                </label>
                                <h5 class="text-md text-default-600 mt-2.5 text-center">Boxed</h5>
                            </div>
                        </div>
                    </div>

                    <div id="position" class="p-6">
                        <div class="flex items-center justify-between">
                            <h5 class="font-bold">Layout Position</h5>

                            <div class="flex gap-1">
                                <div id="position-fixed">
                                    <input type="radio" class="peer hidden" name="data-layout-position"
                                        id="layout-position-fixed" value="fixed">
                                    <label
                                        class="btn btn-sm bg-warning/15 text-warning peer-checked:bg-warning peer-checked:text-white"
                                        for="layout-position-fixed">Fixed</label>
                                </div>
                                <div id="position-scrollable">
                                    <input type="radio" class="peer hidden" name="data-layout-position"
                                        id="layout-position-scrollable" value="scrollable">
                                    <label
                                        class="btn btn-sm bg-warning/15 text-warning peer-checked:bg-warning peer-checked:text-white"
                                        for="layout-position-scrollable">Scrollable</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sidenav-user" class="p-6">
                        <div class="flex items-center justify-between">
                            <label class="m-0 font-bold" for="sidebaruser-check">Sidebar User Info</label>
                            <input type="checkbox" class="form-switch" name="sidebar-user" id="sidebaruser-check">
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-default-900/10 flex border-t p-5">
                <div class="grid w-full grid-cols-2 gap-4">
                    <a href="https://1.envato.market/paces"
                        class="btn py-3 w-full bg-success hover:bg-success-hover text-white">
                        <i class="iconify tabler--basket"></i> Buy Now
                    </a>
                    <button type="button" class="btn py-3 w-full bg-danger text-white hover:bg-danger-hover"
                        id="reset-layout">
                        <i class="iconify tabler--refresh"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End: Theme Customization --}}

    {{-- Start: Load auth script --}}
        @include('layouts.admin.partials.auth-script')
    {{-- End: Load auth script --}}

</body>

</html>