@extends('layouts.admin.auth')

@section('title', 'Masuk')

@section('content')
        <!-- Light/Dark Mode Button -->
        <button type="button" class="light-dark-toggle leading-none inline-block transition-all text-[#fe7a36] absolute top-[20px] md:top-[25px] ltr:right-[20px] rtl:left-[20px] ltr:md:right-[25px] rtl:md:left-[25px]" id="light-dark-toggle">
            <i class="material-symbols-outlined !text-[20px] md:!text-[22px]">
                light_mode
            </i>
        </button>
        <!-- End Light/Dark Mode Button -->

        <!-- Sign In -->
        <div class="bg-white dark:bg-[#0a0e19] py-[60px] md:py-[80px] lg:py-[135px]">
            <div class="mx-auto px-[12.5px] md:max-w-[720px] lg:max-w-[960px] xl:max-w-[1255px]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-[25px] items-center">
                    <!-- Session Status -->

                    <div class="xl:ltr:-mr-[25px] xl:rtl:-ml-[25px] 2xl:ltr:-mr-[45px] 2xl:rtl:-ml-[45px] rounded-[25px] order-2 lg:order-1">
                        <img src="{{ URL::asset('/asstes/admin/images/sign-in.jpg') }}" alt="sign-in-image" class="rounded-[25px]">
                    </div>
                    <div class="xl:ltr:pl-[90px] xl:rtl:pr-[90px] 2xl:ltr:pl-[120px] 2xl:rtl:pr-[120px] order-1 lg:order-2">

                        <img src="{{ URL::asset('/asstes/admin/images/logo-big.svg') }}" alt="logo" class="inline-block dark:hidden">
                        <img src="{{ URL::asset('/asstes/admin/images/white-logo-big.svg') }}" alt="logo" class="hidden dark:inline-block">
                        <div class="my-[17px] md:my-[25px]">
                            <h1 class="!font-semibold !text-[22px] md:!text-xl lg:!text-2xl !mb-[5px] md:!mb-[7px]">
                                Selamat datang di {{ $prefs_composer['title'] }}!
                            </h1>
                            <p class="font-medium lg:text-md text-[#445164] dark:text-gray-400">
                                Silahkan masuk dengan akun yang telah anda buat.
                            </p>
                        </div>
                        <div class="flex items-center justify-between mb-[20px] md:mb-[23px] gap-[12px]">
                            <div class="grow">
                                <button type="button" class="block text-center w-full rounded-md transition-all py-[8px] md:py-[10.5px] px-[15px] md:px-[25px] text-black dark:text-white border border-[#D6DAE1] bg-white dark:bg-[#0a0e19] dark:border-[#172036] shadow-sm hover:border-primary-500">
                                    <img src="{{ URL::asset('/asstes/admin/images/icons/google.svg') }}" class="inline-block" alt="google">
                                </button>
                            </div>
                            <div class="grow">
                                <button type="button" class="block text-center w-full rounded-md transition-all py-[8px] md:py-[10.5px] px-[15px] md:px-[25px] text-black dark:text-white border border-[#D6DAE1] bg-white dark:bg-[#0a0e19] dark:border-[#172036] shadow-sm hover:border-primary-500">
                                    <img src="{{ URL::asset('/asstes/admin/images/icons/facebook2.svg') }}" class="inline-block" alt="google">
                                </button>
                            </div>
                            <div class="grow">
                                <button type="button" class="block text-center w-full rounded-md transition-all py-[8px] md:py-[10.5px] px-[15px] md:px-[25px] text-black dark:text-white border border-[#D6DAE1] bg-white dark:bg-[#0a0e19] dark:border-[#172036] shadow-sm hover:border-primary-500">
                                    <img src="{{ URL::asset('/asstes/admin/images/icons/apple.svg') }}" class="inline-block" alt="google">
                                </button>
                            </div>
                        </div>
                        <div class="">
                            @if (session('status'))
                            <div
                                class="font-medium text-sm text-green-600 border border-transparent rounded-md bg-green-50 px-4 py-3 mt-4">
                                {{ session('status') }}
                            </div>
                            @endif
                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="py-[1rem] px-[1rem] text-danger-500 bg-danger-50 border border-danger-200 dark:bg-[#15203c] dark:border-[#15203c] rounded-md" role="alert">
                                    <b><i class="bi bi-x-octagon"></i> Error :</b>
                                    <ul>
                                        @error('email')
                                            <li>{{ $message }}</li>
                                        @enderror
                                        @error('password')
                                            <li>{{ $message }}</li>
                                        @enderror
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                        @csrf
                            <div class="mb-[15px] relative">
                                <label class="mb-[10px] md:mb-[12px] text-black dark:text-white font-medium block">
                                    Email Address
                                </label>
                                <input name="email" type="text" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" placeholder="Masukkan email anda">
                            </div>
                            <div class="mb-[15px] relative" id="passwordHideShow">
                                <label class="mb-[10px] md:mb-[12px] text-black dark:text-white font-medium block">
                                    Password
                                </label>
                                <input name="password" type="password" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" id="password" placeholder="Masukkan password anda">
                                <button class="absolute text-lg ltr:right-[20px] rtl:left-[20px] bottom-[12px] transition-all hover:text-primary-500" id="toggleButton" type="button">
                                    <i class="ri-eye-off-line"></i>
                                </button>
                            </div>
                        <a href="/forgot-password" class="inline-block text-primary-500 transition-all font-semibold hover:underline">
                            Forgot Password?
                        </a>
                        <button type="submit" class="md:text-md block w-full text-center transition-all rounded-md font-medium mt-[20px] md:mt-[25px] py-[12px] px-[25px] text-white bg-primary-500 hover:bg-primary-400">
                            <span class="flex items-center justify-center gap-[5px]">
                                <i class="material-symbols-outlined">
                                    login
                                </i>
                                Sign In
                            </span>
                        </button>
                        </form>
                        <p class="mt-[15px] md:mt-[20px]">
                            Don’t have an account. <a href="{{ route('register') }}" class="text-primary-500 transition-all font-semibold hover:underline">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sign In -->
@endsection
