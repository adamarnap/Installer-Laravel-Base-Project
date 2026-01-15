@extends('layouts.landing.master')

@section('title', @yield('code') . ' - ' . @yield('title'))

@push('styles')
    <link href="{{ URL::asset('assets/landing/css/error-pages.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- ERROR SECTION ============================================= -->
    <section id="error-@yield('code')" class="bg-snow wide-60 error-section division">
        <div class="container">
            <div class="row justify-center">
                <div class="col-md-10 col-lg-8">
                    <div class="error-holder text-center py-[60px] md:py-[80px]">
                        
                        <!-- Error Code -->
                        <div class="error-code mb-[30px]">
                            <h1 class="!text-[80px] md:!text-[120px] lg:!text-[150px] font-black text-primary-500 opacity-20 leading-none">
                                @yield('code')
                            </h1>
                        </div>

                        <!-- Image (Optional) -->
                        @hasSection('image')
                            <div class="error-img mb-[40px]">
                                <img class="inline-block max-w-[300px] md:max-w-[400px]" src="@yield('image')" alt="error-image">
                            </div>
                        @endif

                        <!-- Title -->
                        <h2 class="!text-[28px] md:!text-[36px] lg:!text-[42px] font-bold !mb-[20px] text-[#333] dark:text-white">
                            @yield('title')
                        </h2>

                        <!-- Message -->
                        <p class="!text-[16px] md:!text-[18px] !mb-[35px] text-gray-600 dark:text-gray-300 max-w-[600px] mx-auto px-4">
                            @yield('message')
                        </p>

                        <!-- Action Buttons -->
                        <div class="error-buttons flex flex-wrap gap-3 justify-center">
                            @hasSection('actions')
                                @yield('actions')
                            @else
                                <a href="{{ route('beranda') }}" 
                                   class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[30px] text-white bg-primary-500 hover:bg-primary-400 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="flaticon-home mr-2"></i> Back to Home
                                </a>
                                <a href="javascript:history.back()" 
                                   class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[30px] text-gray-700 bg-gray-200 hover:bg-gray-300 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-300">
                                    <i class="flaticon-left-arrow mr-2"></i> Go Back
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ERROR SECTION -->
@endsection
