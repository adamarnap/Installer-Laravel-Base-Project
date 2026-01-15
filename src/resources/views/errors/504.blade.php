@extends('errors::standalone')

@section('code', '504')
@section('title', 'Gateway Timeout')

@section('content')
    <div class="max-w-[960px] mx-auto text-center px-4">
        <div class="error-code mb-[30px]">
            <h1 class="!text-[80px] md:!text-[120px] lg:!text-[150px] font-black text-primary-500 opacity-20 leading-none">
                504
            </h1>
        </div>
        <h4 class="!text-[24px] md:!text-[32px] mt-[25px] md:mt-[33px] !mb-[13px] font-bold text-gray-800 dark:text-white">
            Gateway Timeout
        </h4>
        <p class="text-gray-600 dark:text-gray-300 mb-[30px] !text-[16px] md:!text-[18px]">
            The server didn't respond in time. This might be a temporary issue. Please try again in a few moments.
        </p>
        <a href="javascript:location.reload()" class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[25px] text-white bg-primary-500 transition-all hover:bg-primary-400 mr-2">
            Try Again
        </a>
        <a href="{{ route('beranda') }}" class="inline-block font-medium rounded-md text-[16px] md:text-[18px] py-[12px] px-[25px] text-gray-700 bg-gray-200 hover:bg-gray-300 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition-all">
            Back to Home
        </a>
    </div>
@endsection