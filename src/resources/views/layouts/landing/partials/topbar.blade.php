{{-- START : Header --}}
<header id="header" class="tra-menu navbar-dark inner-page-header white-scroll w-full block !pt-0">
    <div class="header-wrapper fixed z-[1030] top-0 inset-x-0">
        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <span
                class="smllogo md:max-lg:!block md:max-lg:!mt-[22px] md:max-lg:!pl-[22px] sm:max-md:!block sm:max-md:!mt-[23px] sm:max-md:!pl-[18px] xsm:max-sm:!block xsm:max-sm:!mt-[23px] xsm:max-sm:!pl-[16px]"><img
                    class="md:w-auto  md:max-lg:!max-w-[inherit] md:max-lg:!max-h-[34px] sm:max-md:!w-auto sm:max-md:!max-w-[inherit] sm:max-md:!max-h-[34px] xsm:max-sm:!w-auto xsm:max-sm:!max-w-[inherit] xsm:max-sm:!max-h-[34px]"
                    src="{{ URL::asset('assets/landing/images/logo-pink.png') }}" alt="mobile-logo"></span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>
        <!-- NAVIGATION MENU -->
        <div
            class="wsmainfull menu clearfix !text-[#b1b7cd] p-[20px_0] w-full h-auto z-[1031] [transition:all_450ms_ease-in-out]">
            <div class="wsmainwp clearfix">
                <!-- HEADER BLACK LOGO -->
                <div class="desktoplogo">
                    <a href="#hero-2" class="logo-black">
                        <img class="light-theme-img w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                            src="{{ URL::asset('assets/landing/images/logo-pink.png') }}" alt="logo">
                        <img class="dark-theme-img w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px]"
                            src="{{ URL::asset('assets/landing/images/logo-blue-white.png') }}" alt="logo">
                    </a>
                </div>
                <!-- HEADER WHITE LOGO -->
                <div class="desktoplogo">
                    <a href="#hero-2" class="logo-white">
                        <img class=" w-auto max-w-[inherit] !max-h-[38px] lg:max-xl:!max-h-[34px] inline-block"
                            src="{{ URL::asset('assets/landing/images/logo-white.png') }}" alt="logo"></a>
                </div>
                <!-- MAIN MENU -->
                <nav class="wsmenu clearfix">
                    <div class="overlapblackbg"></div>
                    <ul class="wsmenu-list nav-theme">
                        <!-- DROPDOWN SUB MENU -->
                        <li aria-haspopup="true">
                            <a href="#" class="h-link">About <span class="wsarrow"></span></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="#lnk-1">Why Martex?</a></li>
                                <li aria-haspopup="true"><a href="#lnk-2">Integrations</a></li>
                                <li aria-haspopup="true"><a href="#lnk-3">How It Works</a></li>
                                <li aria-haspopup="true"><a href="#features-2">Best Solutions</a></li>
                                <li aria-haspopup="true"><a href="#reviews-1">Testimonials</a></li>
                            </ul>
                        </li>
                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a href="#features-6"
                                class="h-link">Features</a>
                        </li>
                        <!-- MEGAMENU -->
                        <li aria-haspopup="true" class="mg_link">
                            <a href="#" class="h-link">Pages <span class="wsarrow"></span></a>
                            <div class="wsmegamenu w-75 clearfix">
                                <div class="container">
                                    <div class="flex flex-wrap mx-[calc(-0.5*_1.5rem)]">
                                        <!-- MEGAMENU LINKS -->
                                        <ul
                                            class="lg:w-3/12 xl:w-3/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full link-list">
                                            <li class="fst-li"><a href="about.html">About Us</a></li>
                                            <li><a href="team.html">Our Team</a></li>
                                            <li><a href="careers.html">Careers <span
                                                        class="sm-info">4</span></a></li>
                                            <li><a href="career-role.html">Career Details</a></li>
                                            <li><a href="contacts.html">Contact Us</a></li>
                                        </ul>
                                        <!-- MEGAMENU LINKS -->
                                        <ul
                                            class="lg:w-3/12 xl:w-3/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full link-list">
                                            <li><a href="features.html">Core Features</a></li>
                                            <li class="fst-li"><a href="projects.html">Our Projects</a></li>
                                            <li><a href="project-details.html">Project Details</a></li>
                                            <li><a href="reviews.html">Testimonials</a></li>
                                            <li><a href="download.html">Download Page</a></li>
                                        </ul>
                                        <!-- MEGAMENU LINKS -->
                                        <ul
                                            class="lg:w-3/12 xl:w-3/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full link-list">
                                            <li class="fst-li"><a href="pricing-1.html">Pricing Page #1</a>
                                            </li>
                                            <li><a href="pricing-2.html">Pricing Page #2</a></li>
                                            <li><a href="faqs.html">FAQs Page</a></li>
                                            <li><a href="help-center.html">Help Center</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                        </ul>
                                        <!-- MEGAMENU LINKS -->
                                        <ul
                                            class="lg:w-3/12 xl:w-3/12 w-full flex-[0_0_auto] px-[calc(0.5*_1.5rem)] max-w-full link-list">
                                            <li class="fst-li"><a href="blog-listing.html">Blog Listing</a>
                                            </li>
                                            <li><a href="single-post.html">Single Blog Post</a></li>
                                            <li><a href="login-2.html">Login Page</a></li>
                                            <li><a href="signup-2.html">Signup Page</a></li>
                                            <li><a href="reset-password.html">Reset Password</a></li>
                                        </ul>
                                    </div>
                                    <!-- End row -->
                                </div>
                                <!-- End container -->
                            </div>
                            <!-- End wsmegamenu -->
                        </li>
                        <!-- END MEGAMENU -->
                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a href="pricing-1.html"
                                class="h-link">Pricing</a>
                        </li>
                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a href="#faqs-3" class="h-link">FAQs</a>
                        </li>
                        <!-- SIGN IN LINK -->
                        <li class="nl-simple reg-fst-link mobile-last-link" aria-haspopup="true">
                            <a href="{{ route('login') }}" class="h-link">Sign in</a>
                        </li>
                        <!-- SIGN UP BUTTON -->
                        <li class="nl-simple" aria-haspopup="true">
                            <a href="{{ route('register') }}"
                                class="btn r-04 btn--theme hover--tra-black last-link">Sign up</a>
                        </li>
                    </ul>
                </nav>
                <!-- END MAIN MENU -->
            </div>
        </div>
        <!-- END NAVIGATION MENU -->
    </div>
    <!-- End header-wrapper -->
</header>
{{-- END : Header --}}