@extends('layouts.landing.master')

@section('title', 'Beranda')

{{-- @section('breadcrumb')
    {{ Breadcrumbs::render('navigations') }}
@endsection --}}

@push('styles')
    {{-- Another Styles --}}
@endpush

@section('content')
    {{-- START: Main Content --}}
    {{-- START : Hero-2 --}}
        <section id="hero-2"
            class="bg--scroll hero-section relative md:max-lg:!mt-[80px] z-[3] w-full bg-no-repeat bg-[center_center] bg-cover bg-fixed sm:max-md:w-auto sm:max-md:bg-scroll xsm:max-sm:w-auto xsm:max-sm:bg-scroll bg-[url(./images/hero-2.jpg)] pt-[150px] pb--100 pb-[100px] lg:max-xl:pt-[150px] lg:max-xl:!pb-[80px] md:max-lg:py-[70px]">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- HERO IMAGE -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div
                            class="hero-2-img wow fadeInRight !text-center pr-[25px] lg:max-xl:pr-[15px] md:max-lg:pr-[5px] xsm:max-sm:!mt-[40px]">
                            <img class="img-fluid" src="images/hero-2-img.png" alt="hero-image">
                        </div>
                    </div>
                    <!-- HERO TEXT -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div class="hero-2-txt wow fadeInLeft">
                            <!-- Title -->
                            <h2
                                class="s-56 w--700 color--black xl:!text-[3.5rem] md:max-lg:!text-[2.94117rem] lg:max-xl:!text-[3.25rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] xl:!mb-[28px] lg:max-xl:!mb-[24px] md:max-lg:!mb-[18px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[18px]">
                                Realize your digital potential with Martex</h2>
                            <!-- Text -->
                            <p
                                class="p-lg xl:!mb-[32px] lg:max-xl:!mb-[28px] md:max-lg:!mb-[24px] sm:max-md:!mb-[25px] xsm:max-sm:!mb-[25px] pr-[3%] lg:max-xl:pr-0 md:max-lg:pr-0">
                                Tempor sapien sodales quaerat ipsum congue ipsum laoreet turpis neque
                                auctor turpis a vitae dolor luctus placerat magna and ligula cursus purus ipsum
                            </p>
                            <!-- HERO DIGITS -->
                            <div class="hero-digits md:max-lg:-mt-[8px] sm:max-md:px-[10%] sm:max-md:py-0 ">
                                <!-- DIGIT BLOCK #1 -->
                                <div id="hd-1-1"
                                    class="wow fadeInUp xl:!w-[45%] inline-block float-left pr-[20px] md:max-lg:w-6/12 md:max-lg:pr-0">
                                    <div
                                        class="hero-digits-block md:max-lg:block flex relative items-stretch justify-start [flex-flow:row_wrap] ">
                                        <!-- Digit -->
                                        <div class="block-digit">
                                            <h2
                                                class="s-46 statistic-number color--black xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.75rem] sm:max-md:!text-[2.75rem] xsm:max-sm:!text-[2.5rem] !leading-none !font-bold font-Jakarta tracking-[-1px] !mb-0 lg:max-xl:tracking-[-0.5px] md:max-lg:tracking-[-0.5px] sm:max-md:tracking-[-0.5px] xsm:max-sm:leading-none xsm:max-sm:tracking-[-0.5px]">
                                                2<span
                                                    class="xl:!text-[1.85rem] md:max-lg:!text-[2.25rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[2.25rem]">x</span>
                                            </h2>
                                        </div>
                                        <!-- Text -->
                                        <div
                                            class="block-txt overflow-hidden flex-1 max-w-full pl-[12px] md:max-lg:!pl-0">
                                            <p
                                                class="p-sm leading-[1.35] xl:!mt-[5px] !mb-0 lg:max-xl:!mt-[2px] md:max-lg:!mt-[10px] !p-0">
                                                Tempor sapien and quaerat placerat</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END DIGIT BLOCK #1 -->
                                <!-- DIGIT BLOCK #2 -->
                                <div id="hd-1-2"
                                    class="wow fadeInUp xl:!w-[55%] inline-block float-left pr-[20px] md:max-lg:w-6/12 md:max-lg:pr-0">
                                    <div
                                        class="hero-digits-block md:max-lg:block sm:max-md:block xsm:max-sm:block flex relative items-stretch justify-start [flex-flow:row_wrap]">
                                        <!-- Digit -->
                                        <div class="block-digit">
                                            <h2
                                                class="s-46 statistic-number color--black xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.75rem] sm:max-md:!text-[2.75rem] xsm:max-sm:!text-[2.5rem] !leading-none !font-bold font-Jakarta tracking-[-1px] !mb-0 lg:max-xl:tracking-[-0.5px] md:max-lg:tracking-[-0.5px] sm:max-md:tracking-[-0.5px] xsm:max-sm:leading-none xsm:max-sm:tracking-[-0.5px]">
                                                63<span
                                                    class="xl:!text-[1.85rem] md:max-lg:!text-[2.25rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[2.25rem]">%</span>
                                            </h2>
                                        </div>
                                        <!-- Text -->
                                        <div
                                            class="block-txt overflow-hidden flex-1 max-w-full pl-[12px] md:max-lg:!pl-0">
                                            <p
                                                class="p-sm leading-[1.35] xl:!mt-[5px] !mb-0 lg:max-xl:!mt-[2px] md:max-lg:!mt-[10px] !p-0">
                                                Ligula suscipit vitae and rutrum turpis</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END DIGIT BLOCK #2 -->
                            </div>
                            <!-- END HERO DIGITS -->
                        </div>
                    </div>
                    <!-- END HERO TEXT -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </section>
        {{-- END : Hero 2 --}}

        <!-- BRANDS-1  ============================================= -->
        <div id="brands-1" class="py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px] brands-section">
            <div class="container">
                <!-- BRANDS CAROUSEL -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                    <div class="col !text-center w-full flex-[1_0_0%] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="owl-carousel brands-carousel-6">
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-1.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-1-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-2.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-3-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-4.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-4-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-5.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-5-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-6.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-6-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-7.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-7-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-8.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-8-white.png" alt="brand-logo"></a>
                            </div>
                            <!-- BRAND LOGO IMAGE -->
                            <div
                                class="brand-logo px-[30px] py-0 lg:max-xl:px-[12px] lg:max-xl:py-0 md:max-lg:px-[12px] md:max-lg:py-0 sm:max-md:px-[20px] sm:max-md:py-0 xsm:max-sm:px-[25px] xsm:max-sm:py-0 overflow-hidden relative transition-all duration-[400ms] ease-[ease-in-out] top-0 hover:-top-1.5">
                                <a href="#"><img class="img-fluid light-theme-img" src="images/brand-9.png"
                                        alt="brand-logo"></a>
                                <a href="#"><img class="img-fluid dark-theme-img hidden absolute"
                                        src="images/brand-9-white.png" alt="brand-logo"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BRANDS CAROUSEL -->
            </div>
            <!-- End container -->
        </div>
        <!-- END BRANDS-1 -->
        <!-- DIVIDER LINE -->
        <hr class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
        <!-- FEATURES-2 ============================================= -->
        <section id="features-2"
            class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  features-section division">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                Build a customer-centric marketing strategy</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- FEATURES-2 WRAPPER -->
                <div class="fbox-wrapper !text-center">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-3">
                        <!-- FEATURE BOX #1 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="fbox-2 fb-1 wow fadeInUp">
                                <!-- Image -->
                                <div
                                    class="fbox-img gr--whitesmoke h--175 xl:!m-[0_8px_60px] xl:!pt-[42px] lg:max-xl:!mt-0 lg:max-xl:!mb-[50px] lg:max-xl:mx-0 lg:max-xl:pt-[35px] md:max-lg:!mt-0 md:max-lg:!mb-[45px] md:max-lg:mx-0 md:max-lg:pt-[30px] sm:max-md:!mt-0 sm:max-md:!mb-[50px] sm:max-md:mx-[10%] sm:max-md:pt-[46px] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[50px] xsm:max-sm:mx-3 xsm:max-sm:pt-[40px] rounded-[12px_12px_0_0]">
                                    <img class="img-fluid light-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] inline-block"
                                        src="images/f_01.png" alt="feature-image">
                                    <img class="img-fluid dark-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] hidden"
                                        src="images/f_01_dark.png" alt="feature-image">
                                </div>
                                <!-- Text -->
                                <div class="fbox-txt">
                                    <h6
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] !font-bold !mb-[15px]">
                                        Cross-Platform</h6>
                                    <p class="!mb-0">Luctus egestas augue undo ultrice aliquam in lacus congue dapibus
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- END FEATURE BOX #1 -->
                        <!-- FEATURE BOX #2 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="fbox-2 fb-2 wow fadeInUp">
                                <!-- Image -->
                                <div
                                    class="fbox-img gr--whitesmoke h--175 xl:!m-[0_8px_60px] xl:!pt-[42px] lg:max-xl:!mt-0 lg:max-xl:!mb-[50px] lg:max-xl:mx-0 lg:max-xl:pt-[35px] md:max-lg:!mt-0 md:max-lg:!mb-[45px] md:max-lg:mx-0 md:max-lg:pt-[30px] sm:max-md:!mt-0 sm:max-md:!mb-[50px] sm:max-md:mx-[10%] sm:max-md:pt-[46px] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[50px] xsm:max-sm:mx-3 xsm:max-sm:pt-[40px] rounded-[12px_12px_0_0]">
                                    <img class="img-fluid light-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] inline-block"
                                        src="images/f_05.png" alt="feature-image">
                                    <img class="img-fluid dark-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] hidden"
                                        src="images/f_05_dark.png" alt="feature-image">
                                </div>
                                <!-- Text -->
                                <div class="fbox-txt">
                                    <h6
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] !font-bold !mb-[15px]">
                                        Effortless Integration</h6>
                                    <p class="!mb-0">Tempor laoreet augue undo ultrice aliquam in lacusq luctus
                                        feugiat</p>
                                </div>
                            </div>
                        </div>
                        <!-- END FEATURE BOX #2 -->
                        <!-- FEATURE BOX #3 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div class="fbox-2 fb-3 wow fadeInUp">
                                <!-- Image -->
                                <div
                                    class="fbox-img gr--whitesmoke h--175 xl:!m-[0_8px_60px] xl:!pt-[42px] lg:max-xl:!mt-0 lg:max-xl:!mb-[50px] lg:max-xl:mx-0 lg:max-xl:pt-[35px] md:max-lg:!mt-0 md:max-lg:!mb-[45px] md:max-lg:mx-0 md:max-lg:pt-[30px] sm:max-md:!mt-0 sm:max-md:!mb-[50px] sm:max-md:mx-[10%] sm:max-md:pt-[46px] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[50px] xsm:max-sm:mx-3 xsm:max-sm:pt-[40px] rounded-[12px_12px_0_0]">
                                    <img class="img-fluid light-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] inline-block"
                                        src="images/f_02.png" alt="feature-image">
                                    <img class="img-fluid dark-theme-img mb-[-25px] xl:!max-h-[175px] md:max-lg:!max-h-32 sm:max-md:!max-h-[220px] xsm:max-sm:!max-h-[185px] lg:max-xl:!max-h-40 w-auto max-w-[inherit] hidden"
                                        src="images/f_02_dark.png" alt="feature-image">
                                </div>
                                <!-- Text -->
                                <div class="fbox-txt">
                                    <h6
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4] !font-bold !mb-[15px]">
                                        Engagement Analytics</h6>
                                    <p class="!mb-0">Egestas luctus augue undo ultrice aliquam in lacus feugiat cursus
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- END FEATURE BOX #3 -->
                    </div>
                    <!-- End row -->
                </div>
                <!-- END FEATURES-2 WRAPPER -->
            </div>
            <!-- End container -->
        </section>
        <!-- END FEATURES-2 -->
        <!-- DIVIDER LINE -->
        <hr class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
        <!-- TEXT CONTENT ============================================= -->
        <section id="lnk-1"
            class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-02 content-section division">
            <div class="container">
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- IMAGE BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="img-block !text-center left-column wow fadeInRight mr-[30px] lg:max-xl:mr-[5px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-06.png" alt="content-image">
                        </div>
                    </div>
                    <!-- TEXT BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="txt-block right-column wow fadeInLeft">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Data
                                Integration</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Create a workflow that works for you</h2>
                            <!-- Text -->
                            <p>Sodales tempor sapien quaerat ipsum undo congue laoreet turpis neque auctor turpis
                                vitae dolor luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit
                            </p>
                            <!-- Small Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Enhance your personality</h5>
                            <!-- CONTENT BOX #1 -->
                            <div
                                class="cbox-1 ico-15 flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <div class="ico-wrap color--theme ml-[8px]">
                                    <div class="cbox-1-ico"><span
                                            class="flaticon-check relative right-[8px] top-px xsm:max-sm:right-[6px] xsm:max-sm:top-[0.5px]"></span>
                                    </div>
                                </div>
                                <div class="cbox-1-txt overflow-hidden flex-1 max-w-full">
                                    <p
                                        class="xl:!mb-[8px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] xsm:max-sm:!mb-[5px]">
                                        Magna
                                        dolor luctus at egestas sapien</p>
                                </div>
                            </div>
                            <!-- CONTENT BOX #2 -->
                            <div
                                class="cbox-1 ico-15 flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <div class="ico-wrap color--theme ml-[8px]">
                                    <div class="cbox-1-ico"><span
                                            class="flaticon-check relative right-[8px] top-px xsm:max-sm:right-[6px] xsm:max-sm:top-[0.5px]"></span>
                                    </div>
                                </div>
                                <div class="cbox-1-txt overflow-hidden flex-1 max-w-full">
                                    <p
                                        class="xl:!mb-[8px] lg:max-xl:!mb-[5px] md:max-lg:!mb-[5px] xsm:max-sm:!mb-[5px]">
                                        Cursus
                                        purus suscipit vitae cubilia magnis volute egestas vitae sapien
                                        turpis ultrice auctor congue varius magnis
                                    </p>
                                </div>
                            </div>
                            <!-- CONTENT BOX #3 -->
                            <div
                                class="cbox-1 ico-15 flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <div class="ico-wrap color--theme ml-[8px]">
                                    <div class="cbox-1-ico"><span
                                            class="flaticon-check relative right-[8px] top-px xsm:max-sm:right-[6px] xsm:max-sm:top-[0.5px]"></span>
                                    </div>
                                </div>
                                <div class="cbox-1-txt overflow-hidden flex-1 max-w-full">
                                    <p class="!mb-0">Volute turpis dolores and sagittis congue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- FEATURES-12 ============================================= -->
        <section id="features-12"
            class="shape--bg shape--white-500 features-section division after:bg-[#f2f4f8] pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px] after:absolute after:content-[''] after:z-[-1] after:w-[48%] after:h-[72%] after:left-[52%] after:top-[21%] lg:max-xl:after:!w-6/12 lg:max-xl:after:!h-[76%] lg:max-xl:after:!left-2/4 lg:max-xl:after:!top-[18%] md:max-lg:after:!w-[52%] md:max-lg:after:!h-3/4 md:max-lg:after:!left-[48%] md:max-lg:after:!top-[19%] xsm:max-sm:after:!h-[64%] xsm:max-sm:after:!top-[32.35%]">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- TEXT BLOCK -->
                    <div
                        class="md:w-5/12 lg:max-xl:w-5/12 xl:w-5/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="txt-block left-column wow fadeInRight">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">One-Stop
                                Solution</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Smart solutions, real-time results</h2>
                            <!-- List -->
                            <ul class="simple-list">
                                <li class="list-item">
                                    <p>Tempor sapien quaerat undo ipsum laoreet purus and sapien dolor ociis ultrice
                                        ipsum aliquam undo congue dolor cursus congue varius magnis
                                    </p>
                                </li>
                                <li class="list-item">
                                    <p class="!mb-0">Cursus purus suscipit vitae cubilia magnis diam volute egestas
                                        sapien ultrice auctor
                                    </p>
                                </li>
                            </ul>
                            <!-- Button -->
                            <a href="#banner-3"
                                class="btn btn-sm rounded-[4px] btn--tra-black hover--theme mt-[25px] lg:max-xl:!mt-[22px] md:max-lg:!mt-[15px] sm:max-md:!mt-[18px] xsm:max-sm:!mt-[18px]">
                                Get started now
                            </a>
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                    <!-- FEATURES-12 WRAPPER -->
                    <div
                        class="md:max-lg:w-7/12 lg:max-xl:w-7/12 xl:w-7/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="fbox-12-wrapper wow fadeInLeft pl-[45px] lg:max-xl:!pl-[30px] md:max-lg:!pl-0">
                            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <!-- FEATURE BOX #1 -->
                                    <div id="fb-12-1"
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] mb--30 xl:!mb-[30px] px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon -->
                                                <span class="flaticon-graphics relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->
                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-20 w--700 !text-[1.25rem] lg:max-xl:!text-[1.18755rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold  mt-[20px] !mb-[10px] md:max-lg:!text-[1.3rem] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                Market Research</h5>
                                            <p class="!mb-0">Porta semper lacus and cursus feugiat at primis ultrice a
                                                ligula
                                                auctor</p>
                                        </div>
                                    </div>
                                    <!-- FEATURE BOX #2 -->
                                    <div id="fb-12-2"
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon -->
                                                <span class="flaticon-graphic relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->
                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-20 w--700 !text-[1.25rem] lg:max-xl:!text-[1.18755rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold  mt-[20px] !mb-[10px] md:max-lg:!text-[1.3rem] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                Digital Marketing</h5>
                                            <p class="!mb-0">Porta semper lacus and cursus feugiat at primis ultrice a
                                                ligula
                                                auctor</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <!-- FEATURE BOX #3 -->
                                    <div id="fb-12-3"
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] mb--30 xl:!mb-[30px] px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon -->
                                                <span class="flaticon-idea relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->
                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-20 w--700 !text-[1.25rem] lg:max-xl:!text-[1.18755rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold  mt-[20px] !mb-[10px] md:max-lg:!text-[1.3rem] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                User Experience</h5>
                                            <p class="!mb-0">Porta semper lacus and cursus feugiat at primis ultrice a
                                                ligula
                                                auctor</p>
                                        </div>
                                    </div>
                                    <!-- FEATURE BOX #4 -->
                                    <div id="fb-12-4"
                                        class="fbox-12 bg--white-100 block-shadow rounded-[12px] px-[35px] py-[32px] lg:max-xl:!p-[30px] md:max-lg:px-[18px] md:max-lg:py-[22px] sm:max-md:!px-[50px] sm:max-md:py-[40px] xsm:max-sm:px-[30px] xsm:max-sm:py-[35px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                        <!-- Icon -->
                                        <div class="fbox-ico ico-50 !mb-[20px] xsm:max-sm:!mb-[20px]">
                                            <div class="shape-ico color--theme relative inline-block !m-[0_auto]">
                                                <!-- Vector Icon -->
                                                <span class="flaticon-search-engine-1 relative z-[2]"></span>
                                                <!-- Shape -->
                                                <svg class="xl:!w-[130px] xl:!h-[130px] top-[-35px] left-[calc(50%_-_60px)] lg:max-xl:!w-[110px] lg:max-xl:!h-[110px] lg:max-xl:top-[-30px] lg:max-xl:left-[calc(50%_-_55px)] md:max-lg:!w-[95px] md:max-lg:!h-[95px] md:max-lg:top-[-25px] md:max-lg:left-[calc(50%_-_50px)] sm:max-md:!w-[125px] sm:max-md:!h-[125px] sm:max-md:top-[-35px] sm:max-md:left-[calc(50%_-_65px)] xsm:max-sm:!w-[120px] xsm:max-sm:!h-[120px] xsm:max-sm:top-[-35px] xsm:max-sm:left-[calc(50%_-_60px)] !absolute z-[1]"
                                                    viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M69.8,-23C76.3,-2.7,57.6,25.4,32.9,42.8C8.1,60.3,-22.7,67,-39.1,54.8C-55.5,42.7,-57.5,11.7,-48.6,-11.9C-39.7,-35.5,-19.8,-51.7,5.9,-53.6C31.7,-55.6,63.3,-43.2,69.8,-23Z"
                                                        transform="translate(100 100)" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- End Icon -->
                                        <!-- Text -->
                                        <div class="fbox-txt">
                                            <h5
                                                class="s-20 w--700 !text-[1.25rem] lg:max-xl:!text-[1.18755rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold  mt-[20px] !mb-[10px] md:max-lg:!text-[1.3rem] md:max-lg:!mb-[10px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                SEO Services</h5>
                                            <p class="!mb-0">Porta semper lacus and cursus feugiat at primis ultrice a
                                                ligula
                                                auctor</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- END FEATURES-12 WRAPPER -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </section>
        <!-- END FEATURES-12 -->
        <!-- TEXT CONTENT ============================================= -->
        <section class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  ct-02 content-section division">
            <div class="container">
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- IMAGE BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="img-block !text-center left-column wow fadeInRight mr-[30px] lg:max-xl:mr-[5px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-13.png" alt="content-image">
                        </div>
                    </div>
                    <!-- TEXT BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="txt-block right-column wow fadeInLeft">
                            <!-- TEXT BOX -->
                            <div class="txt-box !mb-[20px] md:max-lg:!mb-[5px] last:!mb-0">
                                <!-- Title -->
                                <h5
                                    class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                    Solution that grows with you</h5>
                                <!-- Text -->
                                <p>Sodales tempor sapien quaerat ipsum undo congue laoreet turpis neque auctor turpis
                                    vitae dolor luctus placerat magna and ligula cursus purus vitae purus an ipsum
                                    suscipit
                                </p>
                            </div>
                            <!-- END TEXT BOX -->
                            <!-- TEXT BOX -->
                            <div class="txt-box  !mb-0 ">
                                <!-- Title -->
                                <h5
                                    class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                    Connect your data sources</h5>
                                <!-- Text -->
                                <p>Tempor sapien sodales quaerat ipsum undo congue laoreet turpis neque auctor turpis
                                    vitae dolor luctus placerat magna and ligula cursus purus an ipsum vitae suscipit
                                    purus
                                </p>
                                <!-- List -->
                                <ul class="simple-list">
                                    <li class="list-item">
                                        <p>Tempor sapien quaerat an ipsum laoreet purus and sapien dolor an ultrice
                                            ipsum
                                            aliquam undo congue dolor cursus
                                        </p>
                                    </li>
                                    <li class="list-item">
                                        <p class="!mb-0">Cursus purus suscipit vitae cubilia magnis volute egestas
                                            vitae
                                            sapien turpis ultrice auctor congue magna placerat
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <!-- END TEXT BOX -->
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- TEXT CONTENT ============================================= -->
        <section id="lnk-2"
            class="bg--white-400  py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  ct-04 content-section division">
            <div class="container">
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- TEXT BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div class="txt-block left-column wow fadeInRight">
                            <!-- CONTENT BOX #1 -->
                            <div
                                class="cbox-2 process-step flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <!-- Icon -->
                                <div
                                    class="ico-wrap relative mr-[1.625rem] lg:max-xl:mr-[1.1rem] md:max-lg:mr-[1.15rem] xsm:max-sm:mr-4">
                                    <div
                                        class="cbox-2-ico bg--theme color--white relative xl:!w-[2.625rem] xl:!h-[2.625rem] !text-center xl:!text-[1.1875rem] font-medium leading-[2.375rem] [transition:all_450ms_ease-in-out] rounded-[100%] [border:2px_solid_transparent] lg:max-xl:!w-[2.35rem] lg:max-xl:!h-[2.35rem] lg:max-xl:!text-[1.135rem] lg:max-xl:leading-8 md:max-lg:!w-[2.15rem] md:max-lg:!h-[2.15rem] md:max-lg:!text-[1.125rem] md:max-lg:!leading-[1.85rem] xsm:max-sm:!w-[2.3rem] xsm:max-sm:!h-[2.3rem] xsm:max-sm:!text-[1.15rem] xsm:max-sm:!leading-[2.05rem] group-hover:!bg-transparent group-hover:scale-110">
                                        1</div>
                                    <span
                                        class="cbox-2-line !absolute !w-[2px] bg-[#e4e4e4] xl:!h-[calc(100%_-_90px)] -translate-x-2/4 left-2/4 bottom-5 lg:max-xl:!h-[calc(100%_-_74px)] md:max-lg:!h-[calc(100%_-_74px)] xsm:max-sm:!h-[calc(100%_-_74px)]"></span>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-2-txt overflow-hidden flex-1 max-w-full mb-[35px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] xsm:max-sm:!mb-[25px]">
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!mb-[15px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[10px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px] !font-bold font-Jakarta">
                                        Extensions & Addons</h5>
                                    <p class="!leading-[1.6666] !mb-0">Ligula risus auctor tempus feugiat dolor lacinia
                                        nemo
                                        purus in lipsum
                                        purus sapien quaerat a primis viverra tellus vitae luctus dolor ipsum
                                        neque ligula quaerat
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #1 -->
                            <!-- CONTENT BOX #2 -->
                            <div
                                class="cbox-2 process-step flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <!-- Icon -->
                                <div
                                    class="ico-wrap relative mr-[1.625rem] lg:max-xl:mr-[1.1rem] md:max-lg:mr-[1.15rem] xsm:max-sm:mr-4">
                                    <div
                                        class="cbox-2-ico bg--theme color--white relative xl:!w-[2.625rem] xl:!h-[2.625rem] !text-center xl:!text-[1.1875rem] font-medium leading-[2.375rem] [transition:all_450ms_ease-in-out] rounded-[100%] [border:2px_solid_transparent] lg:max-xl:!w-[2.35rem] lg:max-xl:!h-[2.35rem] lg:max-xl:!text-[1.135rem] lg:max-xl:leading-8 md:max-lg:!w-[2.15rem] md:max-lg:!h-[2.15rem] md:max-lg:!text-[1.125rem] md:max-lg:!leading-[1.85rem] xsm:max-sm:!w-[2.3rem] xsm:max-sm:!h-[2.3rem] xsm:max-sm:!text-[1.15rem] xsm:max-sm:!leading-[2.05rem] group-hover:!bg-transparent group-hover:scale-110">
                                        2</div>
                                    <span
                                        class="cbox-2-line !absolute !w-[2px] bg-[#e4e4e4] xl:!h-[calc(100%_-_90px)] -translate-x-2/4 left-2/4 bottom-5 lg:max-xl:!h-[calc(100%_-_74px)] md:max-lg:!h-[calc(100%_-_74px)] xsm:max-sm:!h-[calc(100%_-_74px)]"></span>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-2-txt overflow-hidden flex-1 max-w-full mb-[35px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] xsm:max-sm:!mb-[25px]">
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!mb-[15px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[10px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px] !font-bold font-Jakarta">
                                        Improved Productivity</h5>
                                    <p class="!leading-[1.6666] !mb-0">Ligula risus auctor tempus feugiat dolor lacinia
                                        nemo
                                        purus in lipsum
                                        purus sapien quaerat a primis viverra tellus vitae luctus dolor ipsum
                                        neque ligula quaerat
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #2 -->
                            <!-- CONTENT BOX #3 -->
                            <div
                                class="cbox-2 process-step flex relative items-stretch justify-start [flex-flow:row_wrap] group">
                                <!-- Icon -->
                                <div
                                    class="ico-wrap relative mr-[1.625rem] lg:max-xl:mr-[1.1rem] md:max-lg:mr-[1.15rem] xsm:max-sm:mr-4">
                                    <div
                                        class="cbox-2-ico bg--theme color--white relative xl:!w-[2.625rem] xl:!h-[2.625rem] !text-center xl:!text-[1.1875rem] font-medium leading-[2.375rem] [transition:all_450ms_ease-in-out] rounded-[100%] [border:2px_solid_transparent] lg:max-xl:!w-[2.35rem] lg:max-xl:!h-[2.35rem] lg:max-xl:!text-[1.135rem] lg:max-xl:leading-8 md:max-lg:!w-[2.15rem] md:max-lg:!h-[2.15rem] md:max-lg:!text-[1.125rem] md:max-lg:!leading-[1.85rem] xsm:max-sm:!w-[2.3rem] xsm:max-sm:!h-[2.3rem] xsm:max-sm:!text-[1.15rem] xsm:max-sm:!leading-[2.05rem] group-hover:!bg-transparent group-hover:scale-110">
                                        3</div>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-2-txt overflow-hidden flex-1 max-w-full mb-[35px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] xsm:max-sm:!mb-[25px]">
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] xl:!mb-[15px] lg:max-xl:!mb-[12px] md:max-lg:!mb-[10px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px] !font-bold font-Jakarta">
                                        Customizable Dashboard</h5>
                                    <p class="!leading-[1.6666] !mb-0">Ligula risus auctor tempus feugiat dolor lacinia
                                        nemo
                                        purus
                                        in lipsum purus sapien quaerat a primis viverra tellus vitae luctus dolor
                                        ipsum neque ligula quaerat
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #3 -->
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                    <!-- IMAGE BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div
                            class="img-block !text-center wow fadeInLeft ml-[30px] lg:max-xl:ml-[15px] md:max-lg:ml-[15px]">
                            <img class="img-fluid max-w-none inline-block lg:max-xl:!max-w-[175%] md:max-lg:!max-w-[220%]"
                                src="images/tablet-02.png" alt="content-image">
                        </div>
                    </div>
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- TEXT CONTENT ============================================= -->
        <section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-01 content-section division">
            <div class="container">
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- IMAGE BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="img-block !text-center left-column wow fadeInRight mr-[20px] lg:max-xl:mr-[15px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-05.png" alt="content-image">
                        </div>
                    </div>
                    <!-- TEXT BLOCK -->
                    <div
                        class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div class="txt-block right-column wow fadeInLeft">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Easy
                                Onboarding</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Achieve more with better workflows</h2>
                            <!-- Text -->
                            <p>Nemo ipsam egestas volute turpis egestas ipsum and purus sapien ultrice an aliquam
                                quaerat
                                ipsum augue turpis sapien cursus congue magna purus quaerat at ligula purus egestas
                                magna
                                cursus undo varius purus magnis sapien quaerat
                            </p>
                            <!-- Small Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[18px] md:max-lg:!mb-[18px] sm:max-md:!mb-[18px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Get more done in less time</h5>
                            <!-- List -->
                            <ul class="simple-list">
                                <li class="list-item">
                                    <p>Sapien quaerat tempor an ipsum laoreet purus and sapien dolor an ultrice ipsum
                                        aliquam undo congue cursus dolor
                                    </p>
                                </li>
                                <li class="list-item">
                                    <p class="!mb-0">Purus suscipit cursus vitae cubilia magnis volute egestas vitae
                                        sapien turpis ultrice auctor congue magna placerat
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- TEXT CONTENT ============================================= -->
        <section class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  ct-01 content-section division">
            <div class="container">
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- TEXT BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div class="txt-block left-column wow fadeInRight">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Easy
                                Integration</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Plug your essential tools in few clicks</h2>
                            <!-- List -->
                            <ul class="simple-list">
                                <li class="list-item">
                                    <p>Cursus purus suscipit vitae cubilia magnis volute egestas vitae sapien turpis
                                        sodales magna undo aoreet primis
                                    </p>
                                </li>
                                <li class="list-item">
                                    <p class="!mb-0">Tempor sapien quaerat an ipsum laoreet purus and sapien dolor an
                                        ultrice ipsum aliquam undo congue dolor cursus purus congue and ipsum purus
                                        sapien
                                        a blandit
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                    <!-- IMAGE BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div
                            class="img-block !text-center right-column wow fadeInLeft ml-[30px] lg:max-xl:ml-[5px] md:max-lg:ml-0 sm:max-md:!mx-[3%] xsm:max-sm:!m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-02.png" alt="content-image">
                        </div>
                    </div>
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- IMAGE CONTENT ============================================= -->
        <section id="lnk-3" class="bg--white-400 ct-10 content-section division">
            <div
                class="section-overlay pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px] xl:!mb-[100px] lg:max-xl:!mb-[80px] md:max-lg:!mb-[80px] sm:max-md:!mb-[50px] xsm:max-sm:!mb-[40px] w-full h-full">
                <div class="container">
                    <!-- SECTION TITLE -->
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                        <div
                            class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                            <div
                                class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                                <!-- Title -->
                                <h2
                                    class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !mb-0 xsm:max-sm:px-[1%] xsm:max-sm:py-0 leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                    Track the progress towards objectives with key results</h2>
                                <!-- Text -->
                                <p
                                    class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-3 sm:max-md:!text-[1.21875rem] sm:max-md:!mt-3 xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-3 xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                    Ligula risus auctor tempus magna feugiat lacinia.</p>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE BLOCK -->
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                        <div class="col flex-[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div
                                class="img-block !text-center video-preview wow fadeInUp mb-[-100px] lg:max-xl:-mb-[80px] md:max-lg:-mb-[80px] sm:max-md:!mb-[-50px] xsm:max-sm:-mb-[40px] relative">
                                <!-- Play Icon -->
                                <a class="video-popup2" href="https://www.youtube.com/watch?v=7e90gBu4pas">
                                    <div
                                        class="video-btn video-btn-xl bg--theme w-[6.25rem] h-[6.25rem] mt-[-3.125rem] ml-[-3.125rem] hover:before:opacity-75 md:max-lg:w-28 md:max-lg:!h-28 md:max-lg:!mt-[-3.5rem] md:max-lg:ml-[-3.5rem] !absolute inline-block !text-center !text-white rounded-[100%] left-2/4 top-2/4 before:content-[''] before:absolute before:left-[-5px] before:right-[-5px] before:top-[-5px] before:bottom-[-5px] before:opacity-0 before:transition-all before:duration-[400ms] before:ease-[ease-in-out] before:rounded-[50%] before:bg-[rgba(255,255,255,0.2)] group">
                                        <div
                                            class="video-block-wrapper transition-all duration-[400ms] ease-[ease-in-out] group-hover:scale-95">
                                            <span class="flaticon-play-button"></span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Preview Image -->
                                <img class="img-fluid" src="images/dashboard-01.png" alt="video-preview">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End container -->
            </div>
            <!-- End section overlay -->
        </section>
        <!-- END IMAGE CONTENT -->
        <!-- STATISTIC-1 ============================================= -->
        <div id="statistic-1"
            class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px]  statistic-section division">
            <div class="container">
                <!-- STATISTIC-1 WRAPPER -->
                <div class="statistic-1-wrapper">
                    <div
                        class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-content-md-center md:max-lg:justify-center lg:max-xl:justify-center xl:justify-center row-cols-1 row-cols-md-3">
                        <!-- STATISTIC BLOCK #1 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="sb-1-1" class="wow fadeInUp">
                                <div class="statistic-block">
                                    <!-- Digit -->
                                    <div
                                        class="statistic-block-digit !text-center xl:!w-[35%] inline-block float-left lg:max-xl:!w-[32%] md:max-lg:!w-full md:max-lg:block md:max-lg:float-none md:max-lg:!mb-[15px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px]">
                                        <h2
                                            class="s-46 statistic-number leading-none !font-bold tracking-[-1px] !mb-0 md:max-lg:tracking-[-0.5px] xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.5rem] sm:max-md:!leading-[1.35] xsm:max-sm:!text-[2.25rem] font-Jakarta">
                                            <span class="count-element">89</span>k
                                        </h2>
                                    </div>
                                    <!-- Text -->
                                    <div
                                        class="statistic-block-txt color--grey xl:!w-[65%] inline-block pl-[20px] lg:max-xl:!w-[68%] lg:max-xl:!pl-[10px] md:max-lg:!w-full md:max-lg:inline-block md:max-lg:!p-[0_8%] md:max-lg:!text-center">
                                        <p class="p-md leading-[1.35] !mb-0">Porta justo integer and velna vitae auctor
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END STATISTIC BLOCK #1 -->
                        <!-- STATISTIC BLOCK #2 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="sb-1-2" class="wow fadeInUp">
                                <div class="statistic-block">
                                    <!-- Digit -->
                                    <div
                                        class="statistic-block-digit !text-center xl:!w-[35%] inline-block float-left lg:max-xl:!w-[32%] md:max-lg:!w-full md:max-lg:block md:max-lg:float-none md:max-lg:!mb-[15px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px]">
                                        <h2
                                            class="s-46 statistic-number leading-none !font-bold tracking-[-1px] !mb-0 md:max-lg:tracking-[-0.5px] xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.5rem] sm:max-md:!leading-[1.35] xsm:max-sm:!text-[2.25rem] font-Jakarta">
                                            <span class="count-element">76</span>%
                                        </h2>
                                    </div>
                                    <!-- Text -->
                                    <div
                                        class="statistic-block-txt color--grey xl:!w-[65%] inline-block pl-[20px] lg:max-xl:!w-[68%] lg:max-xl:!pl-[10px] md:max-lg:!w-full md:max-lg:inline-block md:max-lg:!p-[0_8%] md:max-lg:!text-center">
                                        <p class="p-md leading-[1.35] !mb-0">Ligula magna suscipit vitae and rutrum</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END STATISTIC BLOCK #2 -->
                        <!-- STATISTIC BLOCK #3 -->
                        <div
                            class="md:w-4/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <div id="sb-1-3" class="wow fadeInUp">
                                <div class="statistic-block">
                                    <!-- Digit -->
                                    <div
                                        class="statistic-block-digit !text-center xl:!w-[35%] inline-block float-left lg:max-xl:!w-[32%] md:max-lg:!w-full md:max-lg:block md:max-lg:float-none md:max-lg:!mb-[15px] sm:max-md:!mb-[12px] xsm:max-sm:!mb-[12px]">
                                        <h2
                                            class="s-46 statistic-number leading-none !font-bold tracking-[-1px] !mb-0 md:max-lg:tracking-[-0.5px] xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.5rem] sm:max-md:!leading-[1.35] xsm:max-sm:!text-[2.25rem] font-Jakarta">
                                            <span class="count-element">4</span>.<span class="count-element">93</span>
                                        </h2>
                                    </div>
                                    <!-- Text -->
                                    <div
                                        class="statistic-block-txt color--grey xl:!w-[65%] inline-block pl-[20px] lg:max-xl:!w-[68%] lg:max-xl:!pl-[10px] md:max-lg:!w-full md:max-lg:inline-block md:max-lg:!p-[0_8%] md:max-lg:!text-center">
                                        <p class="p-md leading-[1.35] !mb-0">Sagittis congue augue egestas an egestas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END STATISTIC BLOCK #3 -->
                    </div>
                    <!-- End row -->
                </div>
                <!-- END STATISTIC-1 WRAPPER -->
            </div>
            <!-- End container -->
        </div>
        <!-- END STATISTIC-1 -->
        <!-- DIVIDER LINE -->
        <hr class="divider w-full h-px bg-transparent bg-[linear-gradient(90deg,rgba(206,211,246,0)_0,#bbb_38%,#bbb_64%,rgba(206,211,246,0)_99%)] opacity-40 !m-0 ![border:none]">
        <!-- FEATURES-5 ============================================= -->
        <section id="features-5"
            class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  features-section division">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                Reach your audience through social media marketing</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- FEATURES-5 WRAPPER -->
                <div class="fbox-wrapper !text-center">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] items-center">
                        <!-- FEATURE BOX #1 -->
                        <div
                            class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                            <div
                                class="fbox-5 fb-1 gr--smoke rounded-[16px] wow fadeInUp p-[60px] md:max-lg:px-[25px] md:max-lg:py-[35px] sm:max-md:pt-[50px] sm:max-md:!pb-[45px] sm:max-md:!px-[50px] xsm:max-sm:pt-[45px] xsm:max-sm:!pb-[40px] xsm:max-sm:px-[25px]">
                                <!-- Text -->
                                <div class="fbox-txt order-last order-md-2">
                                    <h5
                                        class="s-26 w--700 xl:!text-[1.625rem] lg:max-xl:!text-[1.5rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        Marketing Integrations</h5>
                                    <p class="!mb-0">Aliquam a augue suscipit luctus diam neque purus ipsum neque and
                                        dolor
                                        primis libero</p>
                                </div>
                                <!-- Image -->
                                <div
                                    class="fbox-5-img order-first order-md-2 mt--40 mt-[40px] xl:!mb-0 mx-[5%] lg:max-xl:!mt-[35px] lg:max-xl:!mb-0 lg:max-xl:mx-[6%] md:max-lg:!mt-[30px] md:max-lg:!mb-0 md:max-lg:mx-[6%] sm:max-md:!mt-0 sm:max-md:!mb-[30px] sm:max-md:mx-[10%] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[30px] xsm:max-sm:mx-[9%]">
                                    <img class="img-fluid light-theme-img" src="images/f_06.png" alt="feature-image">
                                    <img class="img-fluid dark-theme-img hidden absolute" src="images/f_06_dark.png"
                                        alt="feature-image">
                                </div>
                            </div>
                        </div>
                        <!-- END FEATURE BOX #1 -->
                        <!-- FEATURE BOX #2 -->
                        <div
                            class="xl:w-6/12 lg:max-xl:w-6/12 md:max-lg:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                            <div
                                class="fbox-5 fb-2 gr--smoke rounded-[16px] wow fadeInUp p-[60px] md:max-lg:px-[25px] md:max-lg:py-[35px] sm:max-md:pt-[50px] sm:max-md:!pb-[45px] sm:max-md:!px-[50px] xsm:max-sm:pt-[45px] xsm:max-sm:!pb-[40px] xsm:max-sm:px-[25px]">
                                <!-- Image -->
                                <div
                                    class="fbox-5-img !mt-0 xl:!mb-[40px] mx-[5%] lg:max-xl:!mt-0 lg:max-xl:!mb-[30px] lg:max-xl:mx-[6%] md:max-lg:!mt-0 md:max-lg:!mb-[25px] md:max-lg:mx-[6%] sm:max-md:!mt-0 sm:max-md:!mb-[30px] sm:max-md:mx-[10%] xsm:max-sm:!mt-0 xsm:max-sm:!mb-[30px] xsm:max-sm:mx-[9%]">
                                    <img class="img-fluid light-theme-img" src="images/f_04.png" alt="feature-image">
                                    <img class="img-fluid dark-theme-img hidden absolute" src="images/f_04_dark.png"
                                        alt="feature-image">
                                </div>
                                <!-- Text -->
                                <div class="fbox-txt">
                                    <h5
                                        class="s-26 w--700 xl:!text-[1.625rem] lg:max-xl:!text-[1.5rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        Enhance Engagement</h5>
                                    <p class="!mb-0">Aliquam a augue suscipit luctus diam neque purus ipsum neque and
                                        dolor
                                        primis libero</p>
                                </div>
                            </div>
                        </div>
                        <!-- END FEATURE BOX #2 -->
                    </div>
                    <!-- End row -->
                </div>
                <!-- END FEATURES-5 WRAPPER -->
            </div>
            <!-- End container -->
        </section>
        <!-- END FEATURES-5 -->
        <!-- TEXT CONTENT ============================================= -->
        <section id="lnk-4"
            class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-01 content-section division">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title mb--80 mb-[80px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                The Complete Solutions</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- SECTION CONTENT (ROW) -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- TEXT BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-last order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div class="txt-block left-column wow fadeInRight">
                            <!-- CONTENT BOX #1 -->
                            <div class="cbox-4">
                                <!-- Icon & Title -->
                                <div class="box-title">
                                    <span
                                        class="flaticon-paper-sizes color--theme relative mr-[10px] top-[12px] xsm:max-sm:block xsm:max-sm:mr-0 xsm:max-sm:!mb-[10px] xsm:max-sm:top-0"></span>
                                    <h5
                                        class="s-22 w--700 !text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold inline-block !leading-[2.35rem] !mb-[15px] md:max-lg:leading-none md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:block xsm:max-sm:leading-none xsm:max-sm:!mb-[15px] font-Jakarta">
                                        Built-in automation</h5>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-4-txt xl:!mb-[25px] lg:max-xl:!mb-[22px] md:max-lg:!mb-[16px] xsm:max-sm:!mb-[30px]">
                                    <p>Quaerat sodales sapien blandit purus primis purus ipsum cubilia laoreet augue
                                        luctus and magna dolor luctus egestas an ipsum sapien primis vitae volute and
                                        magna turpis
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #1 -->
                            <!-- CONTENT BOX #2 -->
                            <div class="cbox-4">
                                <!-- Icon & Title -->
                                <div class="box-title">
                                    <span
                                        class="flaticon-layers-1 color--theme relative mr-[10px] top-[12px] xsm:max-sm:block xsm:max-sm:mr-0 xsm:max-sm:!mb-[10px] xsm:max-sm:top-0"></span>
                                    <h5
                                        class="s-22 w--700 !text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold inline-block !leading-[2.35rem] !mb-[15px] md:max-lg:leading-none md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:block xsm:max-sm:leading-none xsm:max-sm:!mb-[15px] font-Jakarta">
                                        Automatic workflows</h5>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-4-txt xl:!mb-[25px] lg:max-xl:!mb-[22px] md:max-lg:!mb-[16px] xsm:max-sm:!mb-[30px]">
                                    <p>Quaerat sodales sapien blandit purus primis purus ipsum cubilia laoreet augue
                                        luctus and magna dolor luctus egestas an ipsum sapien primis vitae volute and
                                        magna turpis
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #2 -->
                            <!-- CONTENT BOX #3 -->
                            <div class="cbox-4">
                                <!-- Icon & Title -->
                                <div class="box-title">
                                    <span
                                        class="flaticon-pie-chart color--theme relative mr-[10px] top-[12px] xsm:max-sm:block xsm:max-sm:mr-0 xsm:max-sm:!mb-[10px] xsm:max-sm:top-0"></span>
                                    <h5
                                        class="s-22 w--700 !text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold inline-block !leading-[2.35rem] !mb-[15px] md:max-lg:leading-none md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:block xsm:max-sm:leading-none xsm:max-sm:!mb-[15px] font-Jakarta">
                                        Real-time analytics</h5>
                                </div>
                                <!-- Text -->
                                <div
                                    class="cbox-4-txt xl:!mb-[25px] lg:max-xl:!mb-[22px] md:max-lg:!mb-[16px] xsm:max-sm:!mb-[30px]">
                                    <p class="!mb-0">Quaerat sodales sapien blandit purus primis purus ipsum cubilia
                                        laoreet
                                        augue luctus and magna dolor luctus egestas an ipsum sapien primis vitae volute
                                        and
                                        magna turpis
                                    </p>
                                </div>
                            </div>
                            <!-- END CONTENT BOX #3 -->
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                    <!-- IMAGE BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-6/12 xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full order-first order-md-2 md:max-lg:order-2 lg:max-xl:order-2 xl:order-2">
                        <div
                            class="img-block !text-center right-column wow fadeInLeft ml-[30px] lg:max-xl:ml-[5px] md:max-lg:ml-0 sm:max-md:!mx-[3%] xsm:max-sm:!m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-03.png" alt="content-image">
                        </div>
                    </div>
                </div>
                <!-- END SECTION CONTENT (ROW) -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- TEXT CONTENT ============================================= -->
        <section class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  ct-03 content-section division">
            <div class="container">
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  items-center">
                    <!-- IMAGE BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-7/12 xl:w-7/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="img-block !text-center left-column wow fadeInRight mr-[20px] lg:max-xl:mr-[15px] md:max-lg:mr-0 sm:max-md:mx-[3%] xsm:max-sm:m-[0_2%_35px]">
                            <img class="img-fluid" src="images/img-14.png" alt="content-image">
                        </div>
                    </div>
                    <!-- TEXT BLOCK -->
                    <div
                        class="md:w-6/12 lg:max-xl:w-5/12 xl:w-5/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                        <div class="txt-block right-column wow fadeInLeft">
                            <!-- Section ID -->
                            <span
                                class="section-id block !text-[0.85rem] leading-none !font-bold !tracking-[0.5px] uppercase xl:!mb-[35px] lg:max-xl:!mb-[30px] md:max-lg:!mb-[25px] sm:max-md:!mb-[25px] font-Jakarta">Engagement
                                Analytics</span>
                            <!-- Title -->
                            <h2
                                class="s-46 w--700 xl:!text-[2.875rem] lg:max-xl:!text-[2.625rem] md:max-lg:!text-[2.35294rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.8125rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Data-driven digital marketing</h2>
                            <!-- List -->
                            <ul class="simple-list">
                                <li class="list-item">
                                    <p>Tempor sapien quaerat undo ipsum laoreet purus and sapien dolor ociis ultrice
                                        ipsum aliquam undo congue dolor cursus congue varius magnis
                                    </p>
                                </li>
                                <li class="list-item">
                                    <p class="!mb-0">Cursus purus suscipit vitae cubilia magnis diam volute egestas
                                        sapien ultrice auctor
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END TEXT BLOCK -->
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TEXT CONTENT -->
        <!-- INTEGRATIONS-1 ============================================= -->
        <section id="integrations-1"
            class=" py--100 py-[100px] lg:max-xl:py-[80px] md:max-lg:py-[70px] integrations-section">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-8/12 lg:max-xl:w-8/12 xl:w-8/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                Automate your workflow with our integrations</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- INTEGRATIONS-1 WRAPPER -->
                <div class="integrations-1-wrapper">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  row-cols-1 row-cols-md-2 row-cols-lg-3 rows-2">
                        <!-- TOOL #1 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-1 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-1.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Zapier</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #1 -->
                        <!-- TOOL #2 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-2 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-2.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Google Analytics</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #2 -->
                        <!-- TOOL #3 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-3 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-3.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Amplitude</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #3 -->
                        <!-- TOOL #4 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-4 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-4.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Hubspot</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #4 -->
                        <!-- TOOL #5 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-5 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-5.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        MailChimp</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Import data</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #5 -->
                        <!-- TOOL #6 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-6 rounded-[12px] mb--30 xl:!mb-[30px] wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-6.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Slack</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #6 -->
                        <!-- TOOL #7 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-7 rounded-[12px] mb--30 wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-7.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Dropbox</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Import data</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #7 -->
                        <!-- TOOL #8 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-8 rounded-[12px] mb--30 wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-8.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Trello</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Share findings</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #8 -->
                        <!-- TOOL #9 -->
                        <div
                            class="md:w-6/12 lg:w-4/12 xl:w-4/12 flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                            <a href="#"
                                class="in_tool !flex relative items-stretch justify-start border px-[20px] py-[22px] border-solid border-[#ccc] hover:shadow-[0_4px_12px_0_rgba(0,0,0,0.08)] hover:border-transparent [flex-flow:row_wrap] lg:max-xl:px-[20px] lg:max-xl:py-4 md:max-lg:!p-[16px] sm:max-md:!p-[25px] xsm:max-sm:px-[25px] xsm:max-sm:py-[20px] it-9 rounded-[12px] mb--30 wow fadeInUp">
                                <!-- Icon -->
                                <div class="in_tool-logo-wrap">
                                    <div class="in_tool-logo ico-60 relative mr-[20px]">
                                        <img class="img-fluid xl:!w-[60px] xl:!h-[60px] lg:max-xl:!w-[48px] lg:max-xl:!h-[48px] md:max-lg:!w-[52px] md:max-lg:!h-[52px]"
                                            src="images/png_icons/tool-9.png" alt="brand-logo">
                                    </div>
                                </div>
                                <!-- Text -->
                                <div class="in_tool-txt overflow-hidden flex-1 max-w-full">
                                    <h6
                                        class="s-20 w--200 xl:!text-[1.25rem] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.397058rem] md:max-lg:!leading-[1.3] !font-bold font-Jakarta mt-[5px] md:max-lg:!mt-[2px] sm:max-md:!text-[1.4rem] sm:max-md:!leading-none sm:max-md:!mt-[4px] xsm:max-sm:!text-[1.4rem] xsm:max-sm:leading-none xsm:max-sm:!mt-[4px] leading-none !mb-0">
                                        Google Drive</h6>
                                    <p
                                        class="p-sm mt-[5px] !mb-0 md:max-lg:!text-[1.0625rem] md:max-lg:!mt-0 sm:max-md:!text-[1.0625rem] sm:max-md:!mt-1.5 xsm:max-sm:!text-[1.0625rem] xsm:max-sm:!mt-1.5">
                                        Import data</p>
                                </div>
                            </a>
                        </div>
                        <!-- END FEATURE BOX #9 -->
                    </div>
                </div>
                <!-- END INTEGRATIONS-1 WRAPPER -->
                <!-- MORE BUTTON -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                    <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div
                            class="more-btn !text-center  mt--60 mt-[60px] lg:max-xl:!mt-[50px] md:max-lg:!mt-[50px]  wow fadeInUp">
                            <a href="integrations.html" class="btn btn--tra-black hover--theme">View all
                                integrations</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End container -->
        </section>
        <!-- END INTEGRATIONS-1 -->
        <!-- TESTIMONIALS-1 ============================================= -->
        <section id="reviews-1"
            class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]   after:absolute after:content-[''] after:z-[-1] after:w-[150%] after:!h-3/4 after:-left-1/4 after:!top-0 xsm:max-sm:after:!h-[92%]   shape--gr-whitesmoke after:bg-[linear-gradient(180deg,rgba(244,244,249,0.8)_50%,rgba(244,244,249,0.05)_100%)]  reviews-section">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title mb--70 xl:!mb-[70px] lg:max-xl:!mb-[60px] md:max-lg:!mb-[50px] !text-center">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold lg:max-xl:!mb-[20px] md:max-lg:!mb-[15px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[15px] xl:!mb-[26px] xl:!leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35] !tracking-[-0.5px]">
                                Our Happy Customers</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-[12px] sm:max-md:!text-[1.21875rem] sm:max-md:!mt-[12px] xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-[12px] xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- TESTIMONIALS CONTENT -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] ">
                    <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div class="owl-carousel owl-theme reviews-1-wrapper">
                            <!-- TESTIMONIAL #1 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>Etiam sapien sagittis congue augue a massa varius egestas ultrice varius magna
                                        a tempus aliquet undo cursus suscipit
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-1.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Scott Boxer</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">@scott_boxer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #1 -->
                            <!-- TESTIMONIAL #2 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>At sagittis congue augue diam egestas magna an ipsum vitae purus ipsum primis
                                        and cubilia laoreet augue egestas a luctus donec ltrice ligula porta augue magna
                                        suscipit lectus gestas
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-2.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Joel Peterson</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">Internet Surfer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #2 -->
                            <!-- TESTIMONIAL #3 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>Mauris gestas magnis a sapien etiam sapien congue an augue egestas and ultrice
                                        vitae purus diam an integer congue magna ligula egestas magna suscipit
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-3.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Marisol19</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">@marisol19</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #3 -->
                            <!-- TESTIMONIAL #4 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>Mauris donec a magnis sapien etiam pretium a congue augue volutpat lectus
                                        aenean magna and undo mauris lectus laoreet tempor egestas rutrum
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-4.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Leslie D.</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">Web Developer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #4 -->
                            <!-- TESTIMONIAL #5 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>An augue cubilia undo laoreet magna suscipit egestas ipsum lectus purus ipsum
                                        and primis augue an ultrice ligula egestas suscipit a lectus gestas auctor
                                        tempus
                                        feugiat impedit
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-5.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Jennifer Harper</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">App Developer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #5 -->
                            <!-- TESTIMONIAL #6 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>An augue cubilia laoreet undo magna ipsum semper suscipit egestas magna ipsum
                                        ligula a vitae purus and ipsum primis cubilia magna suscipit
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-6.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Jonathan Barnes</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">jQuery Programmer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #6 -->
                            <!-- TESTIMONIAL #7 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>Augue egestas porta tempus volutpat egestas augue cubilia laoreet a magna
                                        suscipit luctus dolor blandit vitae purus neque tempus an aliquet porta gestas
                                        rutrum blandit vitae
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-7.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Mike Harris</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">Graphic Designer</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #7 -->
                            <!-- TESTIMONIAL #8 -->
                            <div
                                class="review-1 bg--white-100 block-shadow rounded-[8px] !m-[0_10px_30px] pt-[40px] !pb-[30px] px-[40px] lg:max-xl:pt-[35px] lg:max-xl:!pb-[25px] lg:max-xl:px-[25px] sm:max-md:pt-[35px] sm:max-md:!pb-[30px] sm:max-md:px-8 xsm:max-sm:!mt-0 xsm:max-sm:!mb-[20px] xsm:max-sm:mx-[6px] xsm:max-sm:pt-[35px] xsm:max-sm:!pb-[30px] xsm:max-sm:px-[20px] md:max-lg:pt-[35px] md:max-lg:!pb-[25px] md:max-lg:px-[25px] shadow-[0_4px_12px_0_rgba(0,0,0,0.08)]">
                                <!-- Quote Icon -->
                                <div class="review-ico ico-65 relative mt-[-25px] opacity-10 -ml-[10px]"><span
                                        class="flaticon-quote"></span></div>
                                <!-- Text -->
                                <div
                                    class="review-txt relative mt-[-45px] lg:max-xl:!mt-[-42px] md:max-lg:!mt-[-38px] sm:max-md:!mt-[-43px] xsm:max-sm:-mt-[40px]">
                                    <!-- Text -->
                                    <p>Augue at vitae purus tempus egestas volutpat augue undo cubilia laoreet magna
                                        suscipit luctus dolor blandit at purus tempus feugiat impedit
                                    </p>
                                    <!-- Author -->
                                    <div
                                        class="author-data clearfix mt-[22px] lg:max-xl:!mt-[15px] md:max-lg:!mt-0 sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                        <!-- Avatar -->
                                        <div class="review-avatar float-left !m-[0_auto]">
                                            <img class=" !w-[54px] !h-[54px] rounded-[100%] lg:max-xl:!w-[44px] lg:max-xl:!h-[44px] md:max-lg:!w-[40px] md:max-lg:!h-[40px] sm:max-md:!w-[52px] sm:max-md:!h-[52px] xsm:max-sm:!w-[52px] xsm:max-sm:!h-[52px]"
                                                src="images/review-author-8.jpg" alt="review-avatar">
                                        </div>
                                        <!-- Data -->
                                        <div
                                            class="review-author !mt-1 md:max-lg:!mt-[3px] sm:max-md:!mt-[3px] xsm:max-sm:!mt-[3px] relative inline-block !text-left p-[0_0_0_15px] lg:max-xl:!pl-[12px] lg:max-xl:pr-0 lg:max-xl:py-0 md:max-lg:!pl-[12px] md:max-lg:pr-0 md:max-lg:py-0 sm:max-md:!pl-[12px] sm:max-md:pr-0 sm:max-md:py-0 xsm:max-sm:!pl-[12px] xsm:max-sm:pr-0 xsm:max-sm:py-0">
                                            <h6
                                                class="s-18 w--700 xl:!text-[0.975rem] lg:max-xl:!text-[1rem] md:max-lg:!text-[1rem] sm:max-md:!text-[1.25rem] xsm:max-sm:!text-[1.2rem] !font-bold leading-none xl:!mb-[8px] lg:max-xl:!mb-[8px] md:max-lg:!mb-[5px] sm:max-md:!mb-[8px] xsm:max-sm:!mb-[8px] font-Jakarta">
                                                Evelyn Martinez</h6>
                                            <p class="p-sm leading-none !font-light !mb-0">WordPress Consultant</p>
                                        </div>
                                    </div>
                                    <!-- End Author -->
                                </div>
                                <!-- End Text -->
                            </div>
                            <!-- END TESTIMONIAL #8 -->
                        </div>
                    </div>
                </div>
                <!-- END TESTIMONIALS CONTENT -->
            </div>
            <!-- End container -->
        </section>
        <!-- END TESTIMONIALS-1 -->
        <!-- FAQs-3  ============================================= -->
        <section id="faqs-3" class="pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px] faqs-section">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]  justify-center">
                    <div
                        class="md:w-10/12 lg:max-xl:w-9/12 xl:w-9/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                        <div
                            class="section-title !text-center mb--70 xl:!mb-[70px] lg:max-xl:!mb-[55px] md:max-lg:!mb-[45px] sm:max-md:!mb-[40px] xsm:max-sm:!mb-[40px]">
                            <!-- Title -->
                            <h2
                                class="s-50 w--700 xl:!text-[3.125rem] lg:max-xl:!text-[2.875rem] md:max-lg:!text-[2.64705rem] sm:max-md:!text-[2.375rem] xsm:max-sm:!text-[2.0625rem] !font-bold !tracking-[-0.5px] leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                Questions & Answers</h2>
                            <!-- Text -->
                            <p
                                class="s-21 color--grey xl:!text-[1.3125rem] xl:!mt-[18px] !mb-0 lg:max-xl:!mt-[15px] lg:max-xl:!text-[1.18755rem] md:max-lg:!text-[1.32352rem] md:max-lg:!mt-3 sm:max-md:!text-[1.21875rem] sm:max-md:!mt-3 xsm:max-sm:!text-[1.1875rem] xsm:max-sm:!mt-3 xsm:max-sm:px-[3%] xsm:max-sm:py-0">
                                Ligula risus auctor tempus magna feugiat lacinia.</p>
                        </div>
                    </div>
                </div>
                <!-- FAQs-3 QUESTIONS -->
                <div class="faqs-3-questions">
                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                        <!-- QUESTIONS HOLDER -->
                        <div
                            class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                                <!-- QUESTION #1 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">1.</span> Getting started with Martex
                                    </h5>
                                    <!-- Answer -->
                                    <p class="color--grey">Etiam amet mauris suscipit in odio integer congue metus
                                        and vitae arcu mollis blandit ultrice ligula egestas magna suscipit lectus magna
                                        suscipit luctus blandit and laoreet
                                    </p>
                                </div>
                                <!-- QUESTION #2 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">2.</span> What's inside the package?
                                    </h5>
                                    <!-- Answer -->
                                    <p class="color--grey">An enim nullam tempor sapien gravida donec ipsum and enim
                                        porta justo integer at velna vitae auctor integer congue undo magna laoreet
                                        augue pretium purus pretium ligula
                                    </p>
                                </div>
                                <!-- QUESTION #3 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">3.</span> How do I choose a plan?
                                    </h5>
                                    <!-- Answer -->
                                    <ul class="simple-list color--grey">
                                        <li class="list-item">
                                            <p>Fringilla risus, luctus mauris orci auctor purus ligula euismod pretium
                                                purus pretium rutrum tempor sapien
                                            </p>
                                        </li>
                                        <li class="list-item">
                                            <p>Nemo ipsam egestas volute undo turpis purus lipsum primis aliquam sapien
                                                quaerat sodales pretium a purus
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END QUESTIONS HOLDER -->
                        <!-- QUESTIONS WRAPPER -->
                        <div
                            class="xl:w-6/12 lg:max-xl:w-6/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full ">
                            <div class="questions-holder px-[10px] py-0 lg:max-xl:!p-0 md:max-lg:!p-0">
                                <!-- QUESTION #4 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">4.</span> How does Martex handle my privacy?
                                    </h5>
                                    <!-- Answer -->
                                    <p class="color--grey">Quaerat sodales sapien euismod blandit purus a purus
                                        ipsum primis in cubilia laoreet augue luctus dolor luctus
                                    </p>
                                    <!-- Answer -->
                                    <p class="color--grey">An enim nullam tempor sapien gravida donec congue metus.
                                        Vitae arcu mollis blandit integer nemo volute velna
                                    </p>
                                </div>
                                <!-- QUESTION #5 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">5.</span> I have an issue with my account
                                    </h5>
                                    <!-- Answer -->
                                    <p class="color--grey">Cubilia laoreet augue egestas and luctus donec curabite
                                        diam vitae dapibus libero and quisque gravida donec neque blandit justo
                                        aliquam molestie nunc sapien justo
                                    </p>
                                </div>
                                <!-- QUESTION #6 -->
                                <div class="question mb--35 !mb-[35px] wow fadeInUp">
                                    <!-- Question -->
                                    <h5
                                        class="s-22 w--700 xl:!text-[1.375rem] lg:max-xl:!text-[1.25rem] md:max-lg:!text-[1.397058rem] sm:max-md:!text-[1.4375rem] xsm:max-sm:!text-[1.3125rem] !font-bold xl:!mb-[20px] lg:max-xl:!mb-[15px] md:max-lg:!mb-[12px] sm:max-md:!mb-[15px] xsm:max-sm:!mb-[15px] leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                        <span class=" mr-[5px]">6.</span> Can I cancel at anytime?
                                    </h5>
                                    <!-- Answer -->
                                    <p class="color--grey">An enim nullam tempor sapien gravida donec ipsum and enim
                                        porta justo integer at velna vitae auctor integer congue undo magna laoreet
                                        augue pretium purus pretium ligula
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- END QUESTIONS HOLDER -->
                    </div>
                    <!-- End row -->
                </div>
                <!-- END FAQs-3 QUESTIONS -->
                <!-- MORE QUESTIONS LINK -->
                <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                    <div class="flex-[0_0_auto] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                        <div
                            class="more-questions !text-center mt--40 mt-[40px] lg:max-xl:!mt-[30px] md:max-lg:!mt-[30px] ">
                            <div
                                class="more-questions-txt bg--white-400 rounded-[100px] inline-block px-[46px] py-[22px] lg:max-xl:px-11 lg:max-xl:py-[18px] md:max-lg:px-[42px] md:max-lg:py-[18px] sm:max-md:px-[42px] sm:max-md:py-[18px] xsm:max-sm:px-9 xsm:max-sm:py-[18px]">
                                <p
                                    class="p-lg leading-none !mb-0 lg:max-xl:!text-[1.125rem] md:max-lg:!text-[1.125rem] sm:max-md:!text-[1.125rem] xsm:max-sm:!text-[1.125rem]">
                                    Have any questions?
                                    <a href="contacts.html"
                                        class="color--theme font-medium !underline hover:text-[#353f4f] hover:!underline">Get
                                        in
                                        Touch</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End container -->
        </section>
        <!-- END FAQs-3 -->
        <!-- BANNER-3 ============================================= -->
        <section id="banner-3" class=" pt--100 pt-[100px] lg:max-xl:pt-[80px] md:max-lg:pt-[70px]  banner-section">
            <div class="container">
                <!-- BANNER-3 WRAPPER -->
                <div
                    class="banner-3-wrapper bg--03 bg--scroll rounded-[16px] relative overflow-hidden !text-center sm:max-md:mr-[-15px] sm:max-md:ml-[-15px] sm:max-md:my-0 sm:max-md:rounded-[0_0] xsm:max-sm:mr-[-15px] xsm:max-sm:ml-[-15px] xsm:max-sm:my-0 xsm:max-sm:rounded-[0_0] bg-no-repeat bg-[center_center] bg-cover !bg-fixed bg-[url(./images/bg-03.jpg)]">
                    <div
                        class="banner-overlay pt-[75px] !pb-[85px] px-[20%] md:max-lg:pt-[45px] md:max-lg:!pb-[55px] md:max-lg:px-[20%] lg:max-xl:pt-[60px] lg:max-xl:!pb-[70px] lg:max-xl:px-[22%] sm:max-md:pt-[55px] sm:max-md:!pb-[65px] sm:max-md:px-[60px] xsm:max-sm:pt-[60px] xsm:max-sm:!pb-[70px] xsm:max-sm:px-[30px] w-full h-full">
                        <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                            <!-- BANNER-3 TEXT -->
                            <div class="col flex-[1_0_0%] w-full max-w-full px-[calc(0.5*_1.5rem)]">
                                <div class="banner-3-txt color--white">
                                    <!-- Title -->
                                    <h2
                                        class="s-48 w--700 xl:!text-[3rem] lg:max-xl:!text-[2.75rem] md:max-lg:!text-[2.5rem] sm:max-md:!text-[2.25rem] xsm:max-sm:!text-[1.9375rem] !font-bold leading-[1.25] font-Jakarta sm:max-md:!leading-[1.35] xsm:max-sm:!leading-[1.35]">
                                        Starting with Martex is easy, fast and free</h2>
                                    <!-- Text -->
                                    <p
                                        class="p-xl mt-[20px] lg:max-xl:!mt-[15px] md:max-lg:!mt-[10px] sm:max-md:!mt-3 xsm:max-sm:!mt-3 xsm:max-sm:!text-[1.125rem] xl:!mb-[25px] lg:max-xl:!mb-[25px] md:max-lg:!mb-[20px] sm:max-md:!mb-[20px] xsm:max-sm:!mb-[20px]">
                                        It only takes a few clicks to get started</p>
                                    <!-- Button -->
                                    <a href="#" class="btn  !rounded-[4px]  btn--theme hover--tra-white"
                                        data-bs-toggle="modal" data-bs-target="#modal-3">Get started - it's free</a>
                                    <!-- Button Text -->
                                    <p
                                        class="p-sm btn-txt ico-15 !m-[20px_0_0_0] lg:max-xl:!mt-[15px] lg:max-xl:!mb-0 lg:max-xl:mx-0 md:max-lg:!mt-[13px] md:max-lg:!mb-0 md:max-lg:mx-0 xsm:max-sm:!mt-[18px] xsm:max-sm:!mb-0 sm:max-md:!mt-[15px] sm:max-md:!mb-0 sm:max-md:mx-0">
                                        <span class="flaticon-check relative right-[2px] top-[0.5px]"></span> Free for
                                        14 days, no
                                        credit card required.
                                    </p>
                                </div>
                            </div>
                            <!-- END BANNER-3 TEXT -->
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- End banner overlay -->
                </div>
                <!-- END BANNER-3 WRAPPER -->
            </div>
            <!-- End container -->
        </section>
        <!-- END BANNER-3 -->
        <!-- MODAL WINDOW (NEWSLETTER FORM) ============================================= -->
        <div id="modal-2" class="modal fade" tabindex="-1">
            <div
                class="modal-dialog modal-dialog-centered xl:!w-[440px] lg:max-xl:!w-[350px] md:max-lg:!w-[320px] sm:max-md:!w-[390px] xsm:max-sm:!w-[340px] xsm:max-sm:m-auto">
                <div class="modal-content overflow-hidden !rounded-[10px]">
                    <!-- CLOSE BUTTON -->
                    <button type="button"
                        class="btn-close ico-10 white-color !absolute !h-[1.5rem] !w-[1.5rem] opacity-90 z-[9999] !p-0 rounded-[50%] right-[15px] top-[15px] !bg-[rgba(255,255,255,1)] !text-black focus:no-underline focus:[outline:none] cursor-pointer"
                        data-bs-dismiss="modal" aria-label="Close">
                        <span class="flaticon-cancel relative leading-6 -top-[2px]"></span>
                    </button>
                    <!-- MODAL CONTENT -->
                    <div class="modal-body !text-center !p-0 relative flex-[1_1_auto]">
                        <!-- IMAGE -->
                        <div class="modal-body-img">
                            <img class="img-fluid" src="images/modal-newsletter-violet.jpg" alt="content-image">
                        </div>
                        <!-- NEWSLETTER FORM -->
                        <div
                            class="modal-body-content xl:!pt-[35px] xl:!pb-[15px] px-[40px] lg:max-xl:pt-[30px] lg:max-xl:!pb-[10px] lg:max-xl:px-[30px] md:max-lg:pt-[30px] md:max-lg:!pb-[10px] md:max-lg:px-[30px] sm:max-md:pt-[25px] sm:max-md:!pb-[5px] sm:max-md:px-[30px] xsm:max-sm:pt-[25px] xsm:max-sm:!pb-[5px] xsm:max-sm:px-[30px]">
                            <!-- Title -->
                            <h5
                                class="s-24 w--700 xl:!text-[1.5rem] lg:max-xl:!text-[1.375rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                Stay up to date with our news, ideas and updates</h5>
                            <!-- Form -->
                            <form
                                class="newsletter-form purple-focus mt-[25px] lg:max-xl:!mt-[20px] md:max-lg:!mt-[20px] sm:max-md:!mt-[20px] xsm:max-sm:!mt-[20px]">
                                <div class="input-group relative flex flex-wrap items-stretch w-full">
                                    <input type="email" autocomplete="off"
                                        class="form-control block w-full !text-center xl:!h-[56px] bg-[#f5f6f8] border xl:!text-[1rem] !text-[#353f4f] !font-normal shadow-none !mt-0 !mb-[15px] mx-0 p-[0_15px] rounded-[6px] border-solid border-transparent lg:max-xl:!h-[50px] lg:max-xl:!text-[0.975rem] md:max-lg:!h-[50px] md:max-lg:!text-[0.975rem] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[52px] xsm:max-sm:!text-[1rem] focus:shadow-none focus:border-[#1e90ff] placeholder:text-[#aaa] focus:[outline:0]"
                                        placeholder="Your email address" required id="s-email">
                                    <span class="input-group-btn block w-full">
                                        <button type="submit"
                                            class="btn btn--theme hover--theme block w-full xl:!h-[56px] !m-0 lg:max-xl:!h-[50px] lg:max-xl:!text-[0.975rem] md:max-lg:!h-[50px] md:max-lg:!text-[0.975rem] sm:max-md:!h-[54px] sm:max-md:!text-[1.0625rem] xsm:max-sm:!h-[52px] xsm:max-sm:!text-[1rem]">Subscribe
                                            Now</button>
                                    </span>
                                </div>
                                <!-- Newsletter Form Notification -->
                                <label for="s-email" class="form-notification"></label>
                            </form>
                        </div>
                        <!-- END NEWSLETTER FORM -->
                    </div>
                    <!-- END MODAL CONTENT -->
                </div>
            </div>
        </div>
        <!-- END MODAL WINDOW (NEWSLETTER FORM) -->
        <!-- MODAL WINDOW (REQUEST FORM) ============================================= -->
        <div id="modal-3" class="modal auto-off fade" tabindex="-1" role="dialog"
            aria-labelledby="modal-3">
            <div
                class="modal-dialog modal-xl modal-dialog-centered xl:!w-[750px] lg:max-xl:!w-[700px] md:max-lg:!max-w-[600px] sm:max-md:!w-[400px] xsm:max-sm:!w-[360px] xsm:max-sm:m-auto">
                <div class="modal-content overflow-hidden !rounded-[10px]">
                    <!-- CLOSE BUTTON -->
                    <button type="button"
                        class="btn-close ico-10 white-color !absolute !h-[1.5rem] !w-[1.5rem] opacity-90 z-[9999] !p-0 rounded-[50%] right-[15px] top-[15px] !bg-[rgba(14,14,14,0.3)] !text-black focus:no-underline focus:[outline:none]"
                        data-bs-dismiss="modal" aria-label="Close">
                        <span class="flaticon-cancel relative leading-[24px] -top-[2px]"></span>
                    </button>
                    <!-- MODAL CONTENT -->
                    <div class="modal-body !p-0 relative flex-[1_1_auto]">
                        <div class="container">
                            <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                <!-- BACKGROUND IMAGE -->
                                <div
                                    class="md:w-5/12 lg:max-xl:w-5/12 xl:w-5/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full bg-img hidden sm:max-md:flex md:max-lg:flex lg:max-xl:flex xl:flex items-end bg-[left_center] ![background-size:initial] bg-[url(./images/modal-request.jpg)]">
                                </div>
                                <!-- REQUEST FORM -->
                                <div
                                    class="md:max-lg:w-7/12 lg:max-xl:w-7/12 xl:w-7/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full">
                                    <div
                                        class="modal-body-content pt-[60px] !pb-[50px] px-[35px] lg:max-xl:pt-[50px] lg:max-xl:!pb-[40px] lg:max-xl:px-[30px] md:max-lg:pt-[40px] md:max-lg:!pb-[30px] md:max-lg:px-[25px] sm:max-md:pt-[40px] sm:max-md:!pb-[30px] sm:max-md:px-[25px] xsm:max-sm:pt-[30px] xsm:max-sm:!pb-[20px] xsm:max-sm:px-[15px]">
                                        <!-- TEXT -->
                                        <div class="request-form-title">
                                            <!-- Title 	-->
                                            <h3
                                                class="s-28 w--700 xl:!text-[1.75rem] lg:max-xl:!text-[1.625rem] md:max-lg:!text-[1.470588rem] sm:max-md:!text-[1.625rem] xsm:max-sm:!text-[1.4375rem] !font-bold leading-[1.35] font-Jakarta sm:max-md:!leading-[1.4] xsm:max-sm:!leading-[1.4]">
                                                Get started for Free!</h3>
                                            <!-- Text -->
                                            <p
                                                class="color--grey xl:!mt-[18px] xl:!mb-[25px] lg:max-xl:!mt-[15px] lg:max-xl:!mb-[20px] md:max-lg:!mt-[15px] md:max-lg:!mb-[20px] xsm:max-sm:!mt-[15px] xsm:max-sm:!mb-[20px]">
                                                Aliquam augue suscipit, luctus neque purus ipsum
                                                neque dolor primis libero
                                            </p>
                                        </div>
                                        <!-- FORM -->
                                        <form name="requestForm"
                                            class="flex flex-wrap mx-[calc(-0.5*_1.5rem)] request-form !m-0">
                                            <!-- Form Input -->
                                            <div
                                                class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full !p-0">
                                                <input type="text" name="name"
                                                    class="form-control block w-full name !text-left xl:!m-[0_0_25px_0] md:max-lg:!mt-0 md:max-lg:!mb-[20px] md:max-lg:mx-0 xl:!h-[58px] bg-[#f5f6f8] [border:1px_solid_transparent] !text-[#666] xl:!text-[1rem] !font-normal transition-all duration-[400ms] ease-[ease-in-out] lg:max-xl:!h-[54px] md:max-lg:!h-[48px] md:max-lg:!text-[1.0625rem] md:max-lg:px-[14px] md:max-lg:py-0 sm:max-md:!h-[56px] sm:max-md:!text-[1.0625rem] sm:max-md:px-[14px] sm:max-md:py-0 xsm:max-sm:!h-[56px] xsm:max-sm:!text-[1.0625rem] xsm:max-sm:px-[14px] xsm:max-sm:py-0 leading-normal bg-clip-padding appearance-none p-[.375rem_.75rem] rounded-[0.375rem] focus:bg-white focus:shadow-none focus:border-[#1680fb] focus:[outline:0] placeholder:text-[#666]"
                                                    placeholder="Enter Your Name*" autocomplete="off" required>
                                            </div>
                                            <!-- Form Input -->
                                            <div
                                                class="w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full !p-0">
                                                <input type="email" name="email"
                                                    class="form-control block w-full email !text-left xl:!m-[0_0_25px_0] md:max-lg:!mt-0 md:max-lg:!mb-[20px] md:max-lg:mx-0 xl:!h-[58px] bg-[#f5f6f8] [border:1px_solid_transparent] !text-[#666] xl:!text-[1rem] !font-normal transition-all duration-[400ms] ease-[ease-in-out] lg:max-xl:!h-[54px] md:max-lg:!h-[48px] md:max-lg:!text-[1.0625rem] md:max-lg:px-[14px] md:max-lg:py-0 sm:max-md:!h-[56px] sm:max-md:!text-[1.0625rem] sm:max-md:px-[14px] sm:max-md:py-0 xsm:max-sm:!h-[56px] xsm:max-sm:!text-[1.0625rem] xsm:max-sm:px-[14px] xsm:max-sm:py-0 leading-normal bg-clip-padding appearance-none p-[.375rem_.75rem] rounded-[0.375rem] focus:bg-white focus:shadow-none focus:border-[#1680fb] focus:[outline:0] placeholder:text-[#666]"
                                                    placeholder="Enter Your Email*" autocomplete="off" required>
                                            </div>
                                            <!-- Form Button -->
                                            <div
                                                class="md:w-full w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full form-btn !p-0">
                                                <button type="submit"
                                                    class="btn btn--theme hover--theme submit block w-full !h-[56px] !m-0 lg:max-xl:!h-[54px] lg:max-xl:!text-[0.975rem] md:max-lg:!h-[48px] md:max-lg:!text-[0.975rem]">Get
                                                    Started Now</button>
                                            </div>
                                            <!-- Form Message -->
                                            <div
                                                class="md:w-full w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full  request-form-msg">
                                                <span class="loading"></span>
                                            </div>
                                        </form>
                                        <!-- END FORM -->
                                    </div>
                                </div>
                                <!-- END REQUEST FORM -->
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL CONTENT -->
                </div>
            </div>
        </div>
        <!-- MODAL WINDOW (REQUEST FORM) -->
    {{-- END: Main Content --}}
@endsection

@push('scripts')
    {{-- Another Scripts --}}
@endpush


