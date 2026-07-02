@extends('errors::standalone')

@section('code', '500')
@section('title', 'Internal Server Error')

@section('content')
    <div class="max-w-[960px] mx-auto text-center px-4">
        <div class="error-code mb-[30px]">
            <h1 class="!text-[80px] md:!text-[120px] lg:!text-[150px] font-black text-primary-500 opacity-20 leading-none">
                500
            </h1>
        </div>
        <h4 class="!text-[24px] md:!text-[32px] mt-[25px] md:mt-[33px] !mb-[13px] font-bold text-gray-800 dark:text-white">
            Internal Server Error
        </h4>
        <p class="text-gray-600 dark:text-gray-300 mb-[30px] !text-[16px] md:!text-[18px]">
            Oops! Something went wrong on our end. Our team has been notified and we're working to fix the issue. Please try again later.
        </p>
        <a href="{{ route('beranda.index') }}" class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[25px] text-white bg-primary-500 transition-all hover:bg-primary-400">
            Back to Home
        </a>
    </div>
@endsection
