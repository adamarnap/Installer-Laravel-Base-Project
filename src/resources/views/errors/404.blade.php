@extends('errors::standalone')

@section('code', '404')
@section('title', 'Page Not Found')

@section('content')
    <div class="max-w-[960px] mx-auto text-center px-4">
        <img src="{{ URL::asset('assets/landing/images/error-404.png') }}" class="inline-block max-w-[400px] md:max-w-[500px] w-full" alt="error-image">
        <h4 class="!text-[24px] md:!text-[32px] mt-[25px] md:mt-[33px] !mb-[13px] font-bold text-gray-800 dark:text-white">
            Looks like we did not find this page, please try again later.
        </h4>
        <p class="text-gray-600 dark:text-gray-300 mb-[30px] !text-[16px] md:!text-[18px]">
            But no worries! Our team is looking everywhere while you wait safely.
        </p>
        <a href="{{ route('beranda.index') }}" class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[25px] text-white bg-primary-500 transition-all hover:bg-primary-400">
            Back to Home
        </a>
    </div>
@endsection
