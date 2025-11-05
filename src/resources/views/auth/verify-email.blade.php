@extends('layouts.admin.auth')

@section('title', 'Verifikasi Email')

@section('content')
    <!-- Light/Dark Mode Button -->
    <button type="button" class="light-dark-toggle leading-none inline-block transition-all text-[#fe7a36] absolute top-[20px] md:top-[25px] ltr:right-[20px] rtl:left-[20px] ltr:md:right-[25px] rtl:md:left-[25px]" id="light-dark-toggle">
        <i class="material-symbols-outlined !text-[20px] md:!text-[22px]">
            light_mode
        </i>
    </button>
    <!-- End Light/Dark Mode Button -->

    <!-- Confirm Email -->
    <div class="bg-white dark:bg-[#0a0e19] py-[60px] md:py-[80px] lg:py-[135px]">
        <div class="mx-auto px-[12.5px] md:max-w-[720px] lg:max-w-[960px] xl:max-w-[1255px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[25px] items-center">
                <div class="xl:ltr:-mr-[25px] xl:rtl:-ml-[25px] 2xl:ltr:-mr-[45px] 2xl:rtl:-ml-[45px] rounded-[25px] order-2 lg:order-1">
                    <img src="{{ URL::asset('assets/images/confirm-email.jpg') }}" alt="confirm-email-image" class="rounded-[25px]">
                </div>
                <div class="xl:ltr:pl-[90px] xl:rtl:pr-[90px] 2xl:ltr:pl-[120px] 2xl:rtl:pr-[120px] order-1 lg:order-2">
                    <img src="{{ URL::asset('assets/images/logo-big.svg') }}" alt="logo" class="inline-block dark:hidden">
                    <img src="{{ URL::asset('assets/images/white-logo-big.svg') }}" alt="logo" class="hidden dark:inline-block">
                    <div class="my-[17px] md:my-[25px]">
                        <h1 class="font-semibold text-[22px] md:text-xl lg:text-2xl mb-[5px] md:mb-[10px]">
                            Selamat datang kembali ke {{ $prefs_composer['title'] }} !
                        </h1>
                        <p class="font-medium leading-[1.5] lg:text-md text-[#445164] dark:text-gray-400">
                            Silahkan cek email yang Anda berikan saat pendaftaran, link verifikasi ada di dalamnya!
                        </p>
                    </div>
                    <div class="row">
                        @if (session('status') == 'verification-link-sent')
                            <div class="font-medium text-sm text-green-600 border border-transparent rounded-md bg-green-50 px-4 py-3 mt-4">
                                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                            </div>
                        @endif
                    </div>
                    {{-- Start Resend Email Verif --}}
                    <div class="row">
                        <p><b>Belum mendapatkan email verifikasi ?</b></p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="md:text-md block w-full text-center transition-all rounded-md font-medium mt-[20px] md:mt-[25px] lg:mt-[30px] py-[12px] px-[25px] text-white bg-primary-500 hover:bg-primary-400">
                                <span class="flex items-center justify-center gap-[5px]">
                                    <i class="material-symbols-outlined">
                                        article_shortcut
                                    </i>
                                    Kirim ulang email verifikasi
                                </span>
                            </button>
                        </form>
                    </div>
                    {{-- End Resend Email Verif --}}

                    {{-- Start: Email Verified --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="md:text-md block w-full text-center transition-all rounded-md font-medium mt-[20px] md:mt-[25px] lg:mt-[30px] py-[12px] px-[25px] text-white bg-primary-500 hover:bg-primary-400">
                            <span class="flex items-center justify-center gap-[5px]">
                                <i class="material-symbols-outlined">
                                    login
                                </i>
                                Back To Home
                            </span>
                        </button>
                    </form>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Confirm Email -->
@endsection