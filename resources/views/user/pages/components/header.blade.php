@php use Illuminate\Support\Facades\Route; @endphp
<header class="app-header">
    <nav class="main-header !h-[3.75rem]" aria-label="Global">
        <div class="main-header-container ps-[0.725rem] pe-[1rem] ">

            <div class="header-content-left">
                <!-- Start::header-element -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a href="{{route('flux-schnell')}}" class="header-logo">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="desktop-logo">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="toggle-logo">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="desktop-dark">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="toggle-dark">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="desktop-white">
                            <img src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo" class="toggle-white">
                        </a>
                    </div>
                </div>
                <!-- End::header-element -->
                <!-- Start::header-element -->
                {{--                <div class="header-element md:px-[0.325rem] !items-center">--}}
                {{--                    <!-- Start::header-link -->--}}
                {{--                    <a aria-label="Hide Sidebar"--}}
                {{--                       class="sidemenu-toggle animated-arrow  hor-toggle horizontal-navtoggle inline-flex items-center"--}}
                {{--                       href="javascript:void(0);"><span></span></a>--}}
                {{--                    <!-- End::header-link -->--}}
                {{--                </div>--}}
                <!-- End::header-element -->
            </div>


            <div class="header-content-right">

                {{--                <div class="header-element py-[1rem] md:px-[0.65rem] px-2 header-search">--}}
                {{--                    <button aria-label="button" type="button" data-hs-overlay="#search-modal"--}}
                {{--                            class="inline-flex flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium focus:ring-offset-0 focus:ring-offset-white transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10">--}}
                {{--                        <i class="bx bx-search-alt-2 header-link-icon"></i>--}}
                {{--                    </button>--}}
                {{--                </div>--}}

                <!-- start header country -->

                <div class="header-element py-[1rem] md:px-[0.65rem] px-2  header-country hs-dropdown ti-dropdown  hidden sm:block [--placement:bottom-right] rtl:[--placement:bottom-left]">

                    @php
                        $currentUrl = request()->getRequestUri();
                        $segments = explode('/', $currentUrl);
                            $routeName = Route::currentRouteName();

                    @endphp

                    @if(request()->segment(1)==='en')
                        @foreach($languages as $language)

                            @if($language->abbr==='en')
                                @php
                                    $segments[1] = 'ka';
                                    $newUrl = url('/').implode('/', $segments);
                                @endphp
                                <a href="{{$newUrl }}" id="dropdown-flag2"
                                   class="hs-dropdown-toggle ti-dropdown-toggle !p-0 flex-shrink-0  !border-0 !rounded-full !shadow-none">
                                    {!!$language->icon!!}
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @if(request()->segment(1)==='ka')
                        @foreach($languages as $language)
                            @if($language->abbr==='ka')
                                @php
                                    $segments[1] = 'en';
                                    $newUrl =   url('/').implode('/', $segments);
                                @endphp
                                <a href="{{ $newUrl}}" id="dropdown-flag"
                                   class="hs-dropdown-toggle ti-dropdown-toggle !p-0 flex-shrink-0  !border-0 !rounded-full !shadow-none">
                                    {!!$language->icon!!}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- end header country -->

                <!-- light and dark theme -->
                <div class="header-element header-theme-mode hidden !items-center sm:block !py-[1rem] md:!px-[0.65rem] px-2">
                    <a aria-label="anchor"
                       class="hs-dark-mode-active:hidden flex hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                       href="javascript:void(0);" data-hs-theme-click-value="dark">
                        <i class="bx bx-moon header-link-icon"></i>
                    </a>
                    <a aria-label="anchor"
                       class="hs-dark-mode-active:flex hidden hs-dark-mode group flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium text-defaulttextcolor  transition-all text-xs dark:bg-bodybg dark:bg-bgdark dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                       href="javascript:void(0);" data-hs-theme-click-value="light">
                        <i class="bx bx-sun header-link-icon"></i>
                    </a>
                </div>
                <!-- End light and dark theme -->

                <!-- Header Cart item -->
                {{--                <div class="header-element cart-dropdown hs-dropdown ti-dropdown md:!block !hidden py-[1rem] md:px-[0.65rem] px-2  [--placement:bottom-right] rtl:[--placement:bottom-left]">--}}
                {{--                    <button id="dropdown-cart" type="button"--}}
                {{--                            class="hs-dropdown-toggle relative ti-dropdown-toggle !p-0 !border-0 flex-shrink-0  !rounded-full !shadow-none align-middle text-xs">--}}
                {{--                        <i class="bx bx-cart header-link-icon"></i>--}}
                {{--                        <span class="flex absolute h-5 w-5 -top-[0.25rem] end-0 -me-[0.6rem]">--}}
                {{--              <span class="relative inline-flex rounded-full h-[14.7px] w-[14px] text-[0.625rem] bg-primary text-white justify-center items-center"--}}
                {{--                    id="cart-icon-badge">5</span>--}}
                {{--            </span>--}}
                {{--                    </button>--}}
                {{--                    <div class="main-header-dropdown bg-white !-mt-3 !p-0 hs-dropdown-menu ti-dropdown-menu w-[22rem] border-0 border-defaultborder hidden"--}}
                {{--                         aria-labelledby="dropdown-cart">--}}
                {{--                        <div class="ti-dropdown-header !bg-transparent flex justify-between items-center !m-0 !p-4">--}}
                {{--                            <p class="text-defaulttextcolor  !text-[1.0625rem] dark:text-[#8c9097] dark:text-white/50 font-semibold">--}}
                {{--                                Cart Items</p>--}}
                {{--                            <a href="javascript:void(0)"--}}
                {{--                               class="font-[600] py-[0.25/2rem] px-[0.45rem] rounded-[0.25rem] bg-success/10 text-success text-[0.75em] "--}}
                {{--                               id="cart-data">5 Items</a>--}}
                {{--                        </div>--}}
                {{--                        <div>--}}
                {{--                            <hr class="dropdown-divider dark:border-white/10">--}}
                {{--                        </div>--}}
                {{--                        <ul class="list-none mb-0" id="header-cart-items-scroll">--}}
                {{--                            <li class="ti-dropdown-item border-b !block dark:border-defaultborder/10 border-defaultborder ">--}}
                {{--                                <div class="flex items-start cart-dropdown-item">--}}

                {{--                                    <img src="../assets/images/ecommerce/jpg/1.jpg" alt="img"--}}
                {{--                                         class="!h-[1.75rem] !w-[1.75rem] leading-[1.75rem] text-[0.65rem] rounded-[50%] br-5 me-3">--}}

                {{--                                    <div class="grow">--}}
                {{--                                        <div class="flex items-start justify-between mb-0">--}}
                {{--                                            <div class="mb-0 !text-[0.8125rem] text-[#232323] font-semibold dark:text-white">--}}
                {{--                                                <a href="cart.html">SomeThing Phone</a>--}}
                {{--                                            </div>--}}

                {{--                                            <div class="inline-flex">--}}
                {{--                                                <span class="text-black mb-1 dark:text-white !font-medium">$1,299.00</span>--}}
                {{--                                                <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                                   class="header-cart-remove ltr:float-right rtl:float-left dropdown-item-close"><i--}}
                {{--                                                            class="ti ti-trash"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="min-w-fit flex  items-start justify-between">--}}
                {{--                                            <ul class="header-product-item dark:text-white/50 flex">--}}
                {{--                                                <li>Metallic Blue</li>--}}
                {{--                                                <li>6gb Ram</li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}

                {{--                            <li class="ti-dropdown-item border-b !block dark:border-defaultborder/10 border-defaultborder">--}}
                {{--                                <div class="flex items-start cart-dropdown-item">--}}
                {{--                                    <img src="../assets/images/ecommerce/jpg/3.jpg" alt="img"--}}
                {{--                                         class="!h-[1.75rem] !w-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-[50%] br-5 me-3">--}}
                {{--                                    <div class="grow">--}}
                {{--                                        <div class="flex items-start justify-between mb-0">--}}
                {{--                                            <div class="mb-0 text-[0.8125rem] text-[#232323] dark:text-white font-semibold">--}}
                {{--                                                <a href="cart.html">Stop Watch</a>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="inline-flex">--}}
                {{--                                                <span class="text-black dark:text-white !font-medium mb-1">$179.29</span>--}}
                {{--                                                <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                                   class="header-cart-remove ltr:float-right rtl:float-left dropdown-item-close"><i--}}
                {{--                                                            class="ti ti-trash"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="min-w-fit flex items-start justify-between">--}}
                {{--                                            <ul class="header-product-item">--}}
                {{--                                                <li>Analog</li>--}}
                {{--                                                <li><span--}}
                {{--                                                            class="font-[600] py-[0.25rem] px-[0.45rem] rounded-[0.25rem] bg-pinkmain/10 text-pinkmain text-[0.625rem]">Free--}}
                {{--                            shipping</span></li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item border-b !block dark:border-defaultborder/10 border-defaultborder">--}}
                {{--                                <div class="flex items-start cart-dropdown-item">--}}
                {{--                                    <img src="../assets/images/ecommerce/jpg/5.jpg" alt="img"--}}
                {{--                                         class="!h-[1.75rem] !w-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-[50%] br-5 me-3">--}}
                {{--                                    <div class="grow">--}}
                {{--                                        <div class="flex items-start justify-between mb-0">--}}
                {{--                                            <div class="mb-0 text-[0.8125rem] text-[#232323] font-semibold dark:text-white">--}}
                {{--                                                <a href="cart.html">Photo Frame</a>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="inline-flex">--}}
                {{--                                                <span class="text-black !font-medium mb-1 dark:text-white">$29.00</span>--}}
                {{--                                                <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                                   class="header-cart-remove ltr:float-right rtl:float-left dropdown-item-close"><i--}}
                {{--                                                            class="ti ti-trash"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="min-w-fit flex items-start justify-between">--}}
                {{--                                            <ul class="header-product-item flex">--}}
                {{--                                                <li>Decorative</li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item border-b !block dark:border-defaultborder/10 border-defaultborder">--}}
                {{--                                <div class="flex items-start cart-dropdown-item">--}}
                {{--                                    <img src="../assets/images/ecommerce/jpg/4.jpg" alt="img"--}}
                {{--                                         class="!h-[1.75rem] !w-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-[50%] br-5 me-3">--}}
                {{--                                    <div class="grow">--}}
                {{--                                        <div class="flex items-start justify-between mb-0">--}}
                {{--                                            <div class="mb-0 text-[0.8125rem] text-[#232323] font-semibold dark:text-white">--}}
                {{--                                                <a href="cart.html">Kikon Camera</a>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="inline-flex">--}}
                {{--                                                <span class="text-black !font-medium mb-1 dark:text-white">$4,999.00</span>--}}
                {{--                                                <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                                   class="header-cart-remove ltr:float-right rtl:float-left dropdown-item-close"><i--}}
                {{--                                                            class="ti ti-trash"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="min-w-fit flex items-start justify-between">--}}
                {{--                                            <ul class="header-product-item flex">--}}
                {{--                                                <li>Black</li>--}}
                {{--                                                <li>50MM</li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item !block">--}}
                {{--                                <div class="flex items-start cart-dropdown-item">--}}
                {{--                                    <img src="../assets/images/ecommerce/jpg/6.jpg" alt="img"--}}
                {{--                                         class="!h-[1.75rem] !w-[1.75rem] leading-[1.75rem] text-[0.65rem]  rounded-[50%] br-5 me-3">--}}
                {{--                                    <div class="grow">--}}
                {{--                                        <div class="flex items-start justify-between mb-0">--}}
                {{--                                            <div class="mb-0 text-[0.8125rem] text-[#232323] font-semibold dark:text-white">--}}
                {{--                                                <a href="cart.html">Canvas Shoes</a>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="inline-flex">--}}
                {{--                                                <span class="text-black !font-medium mb-1 dark:text-white">$129.00</span>--}}
                {{--                                                <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                                   class="header-cart-remove ltr:float-right rtl:float-left dropdown-item-close"><i--}}
                {{--                                                            class="ti ti-trash"></i></a>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="flex items-start justify-between">--}}
                {{--                                            <ul class="header-product-item flex">--}}
                {{--                                                <li>Gray</li>--}}
                {{--                                                <li>Sports</li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                        <div class="p-3 empty-header-item border-t">--}}
                {{--                            <div class="grid">--}}
                {{--                                <a href="checkout.html" class="w-full ti-btn ti-btn-primary-full p-2">Proceed to--}}
                {{--                                    checkout</a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="p-[3rem] empty-item hidden">--}}
                {{--                            <div class="text-center">--}}
                {{--                <span class="!w-[4rem] !h-[4rem] !leading-[4rem] rounded-[50%] avatar bg-warning/10 !text-warning">--}}
                {{--                  <i class="ri-shopping-cart-2-line text-[2rem]"></i>--}}
                {{--                </span>--}}
                {{--                                <h6 class="font-bold mb-1 mt-3 text-[1rem] text-defaulttextcolor dark:text-white">Your--}}
                {{--                                    Cart is Empty</h6>--}}
                {{--                                <span class="mb-3 !font-normal text-[0.8125rem] block text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">Add some items to make me happy :)</span>--}}
                {{--                                <a href="products.html"--}}
                {{--                                   class="ti-btn ti-btn-primary btn-wave ti-btn-wave btn-sm m-1 !text-[0.75rem] !py-[0.25rem] !px-[0.5rem]"--}}
                {{--                                   data-abc="true">continue shopping <i class="bi bi-arrow-right ms-1"></i></a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
                {{--                </div>--}}
                <!--End Header cart item  -->

                <!--Header Notifictaion -->
                {{--                <div class="header-element py-[1rem] md:px-[0.65rem] px-2 notifications-dropdown header-notification hs-dropdown ti-dropdown !hidden md:!block [--placement:bottom-left]">--}}
                {{--                    <button id="dropdown-notification" type="button"--}}
                {{--                            class="hs-dropdown-toggle relative ti-dropdown-toggle !p-0 !border-0 flex-shrink-0  !rounded-full !shadow-none align-middle text-xs">--}}
                {{--                        <i class="bx bx-bell header-link-icon  text-[1.125rem]"></i>--}}
                {{--                        <span class="flex absolute h-5 w-5 -top-[0.25rem] end-0  -me-[0.6rem]">--}}
                {{--              <span--}}
                {{--                      class="animate-slow-ping absolute inline-flex -top-[2px] -start-[2px] h-full w-full rounded-full bg-secondary/40 opacity-75"></span>--}}
                {{--              <span--}}
                {{--                      class="relative inline-flex justify-center items-center rounded-full  h-[14.7px] w-[14px] bg-secondary text-[0.625rem] text-white"--}}
                {{--                      id="notification-icon-badge">5</span>--}}
                {{--            </span>--}}
                {{--                    </button>--}}
                {{--                    <div class="main-header-dropdown !-mt-3 !p-0 hs-dropdown-menu ti-dropdown-menu bg-white !w-[22rem] border-0 border-defaultborder hidden !m-0"--}}
                {{--                         aria-labelledby="dropdown-notification">--}}

                {{--                        <div class="ti-dropdown-header !m-0 !p-4 !bg-transparent flex justify-between items-center">--}}
                {{--                            <p class="mb-0 text-[1.0625rem] text-defaulttextcolor font-semibold dark:text-[#8c9097] dark:text-white/50">--}}
                {{--                                Notifications</p>--}}
                {{--                            <span class="text-[0.75em] py-[0.25rem/2] px-[0.45rem] font-[600] rounded-sm bg-secondary/10 text-secondary"--}}
                {{--                                  id="notifiation-data">5 Unread</span>--}}
                {{--                        </div>--}}
                {{--                        <div class="dropdown-divider"></div>--}}
                {{--                        <ul class="list-none !m-0 !p-0 end-0" id="header-notification-scroll">--}}
                {{--                            <li class="ti-dropdown-item dropdown-item !block">--}}
                {{--                                <div class="flex items-start">--}}
                {{--                                    <div class="pe-2">--}}
                {{--                    <span--}}
                {{--                            class="inline-flex text-primary justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem] !bg-primary/10 !rounded-[50%]"><i--}}
                {{--                                class="ti ti-gift text-[1.125rem]"></i></span>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="grow flex items-center justify-between">--}}
                {{--                                        <div>--}}
                {{--                                            <p class="mb-0 text-defaulttextcolor dark:text-white text-[0.8125rem] font-semibold">--}}
                {{--                                                <a--}}
                {{--                                                        href="notifications.html">Your Order Has Been Shipped</a></p>--}}
                {{--                                            <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Order No: 123456--}}
                {{--                        Has Shipped To Your Delivery Address</span>--}}
                {{--                                        </div>--}}
                {{--                                        <div>--}}
                {{--                                            <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                               class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                {{--                                                        class="ti ti-x text-[1rem]"></i></a>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item dropdown-item !block">--}}
                {{--                                <div class="flex items-start">--}}
                {{--                                    <div class="pe-2">--}}
                {{--                    <span--}}
                {{--                            class="inline-flex text-secondary justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem]  bg-secondary/10 rounded-[50%]"><i--}}
                {{--                                class="ti ti-discount-2 text-[1.125rem]"></i></span>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="grow flex items-center justify-between">--}}
                {{--                                        <div>--}}
                {{--                                            <p class="mb-0 text-defaulttextcolor dark:text-white text-[0.8125rem]  font-semibold">--}}
                {{--                                                <a--}}
                {{--                                                        href="notifications.html">Discount Available</a></p>--}}
                {{--                                            <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Discount--}}
                {{--                        Available On Selected Products</span>--}}
                {{--                                        </div>--}}
                {{--                                        <div>--}}
                {{--                                            <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                               class="min-w-fit  text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                {{--                                                        class="ti ti-x text-[1rem]"></i></a>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item dropdown-item !block">--}}
                {{--                                <div class="flex items-start">--}}
                {{--                                    <div class="pe-2">--}}
                {{--                    <span--}}
                {{--                            class="inline-flex text-pinkmain justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem]  bg-pinkmain/10 rounded-[50%]"><i--}}
                {{--                                class="ti ti-user-check text-[1.125rem]"></i></span>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="grow flex items-center justify-between">--}}
                {{--                                        <div>--}}
                {{--                                            <p class="mb-0 text-defaulttextcolor dark:text-white text-[0.8125rem]  font-semibold">--}}
                {{--                                                <a--}}
                {{--                                                        href="notifications.html">Account Has Been Verified</a></p>--}}
                {{--                                            <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Your Account Has--}}
                {{--                        Been Verified Sucessfully</span>--}}
                {{--                                        </div>--}}
                {{--                                        <div>--}}
                {{--                                            <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                               class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                {{--                                                        class="ti ti-x text-[1rem]"></i></a>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item dropdown-item !block">--}}
                {{--                                <div class="flex items-start">--}}
                {{--                                    <div class="pe-2">--}}
                {{--                    <span--}}
                {{--                            class="inline-flex text-warning justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem]  bg-warning/10 rounded-[50%]"><i--}}
                {{--                                class="ti ti-circle-check text-[1.125rem]"></i></span>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="grow flex items-center justify-between">--}}
                {{--                                        <div>--}}
                {{--                                            <p class="mb-0 text-defaulttextcolor dark:text-white text-[0.8125rem]  font-semibold">--}}
                {{--                                                <a--}}
                {{--                                                        href="notifications.html">Order Placed <span--}}
                {{--                                                            class="text-warning">ID: #1116773</span></a></p>--}}
                {{--                                            <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Order Placed--}}
                {{--                        Successfully</span>--}}
                {{--                                        </div>--}}
                {{--                                        <div>--}}
                {{--                                            <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                               class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                {{--                                                        class="ti ti-x text-[1rem]"></i></a>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="ti-dropdown-item dropdown-item !block">--}}
                {{--                                <div class="flex items-start">--}}
                {{--                                    <div class="pe-2">--}}
                {{--                    <span--}}
                {{--                            class="inline-flex text-success justify-center items-center !w-[2.5rem] !h-[2.5rem] !leading-[2.5rem] !text-[0.8rem]  bg-success/10 rounded-[50%]"><i--}}
                {{--                                class="ti ti-clock text-[1.125rem]"></i></span>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="grow flex items-center justify-between">--}}
                {{--                                        <div>--}}
                {{--                                            <p class="mb-0 text-defaulttextcolor dark:text-white  text-[0.8125rem]  font-semibold">--}}
                {{--                                                <a--}}
                {{--                                                        href="notifications.html">Order Delayed <span--}}
                {{--                                                            class="text-success">ID: 7731116</span></a></p>--}}
                {{--                                            <span class="text-[#8c9097] dark:text-white/50 font-normal text-[0.75rem] header-notification-text">Order Delayed--}}
                {{--                        Unfortunately</span>--}}
                {{--                                        </div>--}}
                {{--                                        <div>--}}
                {{--                                            <a aria-label="anchor" href="javascript:void(0);"--}}
                {{--                                               class="min-w-fit text-[#8c9097] dark:text-white/50 me-1 dropdown-item-close1"><i--}}
                {{--                                                        class="ti ti-x text-[1rem]"></i></a>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}

                {{--                        <div class="p-4 empty-header-item1 border-t mt-2">--}}
                {{--                            <div class="grid">--}}
                {{--                                <a href="notifications.html" class="ti-btn ti-btn-primary-full !m-0 w-full p-2">View--}}
                {{--                                    All</a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="p-[3rem] empty-item1 hidden">--}}
                {{--                            <div class="text-center">--}}
                {{--                <span class="!h-[4rem]  !w-[4rem] avatar !leading-[4rem] !rounded-full !bg-secondary/10 !text-secondary">--}}
                {{--                  <i class="ri-notification-off-line text-[2rem]  "></i>--}}
                {{--                </span>--}}
                {{--                                <h6 class="font-semibold mt-3 text-defaulttextcolor dark:text-white text-[1rem]">No New--}}
                {{--                                    Notifications</h6>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <!--End Header Notifictaion -->

                <!-- Related Apps -->
                <div class="header-element header-apps dark:text-[#8c9097] dark:text-white/50 py-[1rem] md:px-[0.65rem] px-2 hs-dropdown ti-dropdown md:!block  [--placement:bottom-left]">

                    <button aria-label="button" id="dropdown-apps" type="button"
                            class="hs-dropdown-toggle ti-dropdown-toggle !p-0 !border-0 flex-shrink-0  !rounded-full !shadow-none text-xs">
                        <i class="bx bx-grid-alt header-link-icon text-[1.125rem]"></i>
                    </button>

                    <div class="main-header-dropdown !-mt-3 hs-dropdown-menu ti-dropdown-menu !w-[22rem] border-0 border-defaultborder   hidden"
                         aria-labelledby="dropdown-apps">

                        {{--                        <div class="p-4">--}}
                        {{--                            <div class="flex items-center justify-between">--}}
                        {{--                                <p class="mb-0 text-defaulttextcolor text-[1.0625rem] dark:text-[#8c9097] dark:text-white/50 font-semibold">--}}
                        {{--                                    Related Apps</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="dropdown-divider mb-0"></div>
                        <div class="ti-dropdown-divider divide-y divide-gray-200 dark:divide-white/10 main-header-shortcuts p-2"
                             id="header-shortcut-scroll">
                            <div class="grid grid-cols-3 gap-2 @if(request()->routeIs('userbalance.history')) p-2 @endif">
                                <div class="">
                                    <a href="{{route('flux-schnell','chat-open')}}"
                                       class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                        <div>
                                            <img src="{{asset('assets/images/schnell.webp')}}" alt="figma"
                                                 style="height: 60px!important;"
                                                 class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                            <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                                Flux Schnell
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="{{route('midjourney')}}"
                                       class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                        <img src="{{asset('assets/images/midjourney.jpg')}}"
                                             style="height: 60px!important;"

                                             class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                        <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                            Midjourney
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="{{route('runway')}}"
                                       class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                        <img src="{{asset('assets/images/runway.png')}}"
                                             style="height: 60px!important;object-fit: cover"

                                             class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                        <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                            Runway
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="{{route('colorize.index')}}"
                                       class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                        <img src="{{asset('assets/images/colorization.png')}}"
                                             style="height: 60px!important;width: 60px!important"
                                             class=" text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                        <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                            Colorize
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="{{route('bg.remove')}}"
                                       class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                        <img src="{{asset('assets/images/removebg.webp')}}"
                                             style="height: 60px!important;width: 60px!important"
                                             class=" text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                        <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                            Remove BG
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="p-4 first:pt-0 border-t">--}}
                        {{--                            --}}{{--                            <a class="w-full ti-btn ti-btn-primary-full p-2 !m-0" href="javascript:void(0);">--}}
                        {{--                            --}}{{--                                View All--}}
                        {{--                            --}}{{--                            </a>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
                <!--End Related Apps -->

                <!-- Fullscreen -->
                {{--                <div class="header-element header-fullscreen py-[1rem] md:px-[0.65rem] px-2">--}}
                {{--                    <!-- Start::header-link -->--}}
                {{--                    <a aria-label="anchor" onclick="openFullscreen();" href="javascript:void(0);"--}}
                {{--                       class="inline-flex flex-shrink-0 justify-center items-center gap-2  !rounded-full font-medium dark:hover:bg-black/20 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10">--}}
                {{--                        <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>--}}
                {{--                        <i class="bx bx-exit-fullscreen full-screen-close header-link-icon hidden"></i>--}}
                {{--                    </a>--}}
                {{--                    <!-- End::header-link -->--}}
                {{--                </div>--}}
                <!-- End Full screen -->

                <!-- Header Profile -->
                <div class="header-element md:!px-[0.65rem] px-2 hs-dropdown !items-center ti-dropdown [--placement:bottom-left]">

                    <button hx-post="{{route('userbalance.check')}}" hx-target="#userbalance"
                            hx-include="[name=_token]"
                            id="dropdown-profile" type="button"
                            class="hs-dropdown-toggle ti-dropdown-toggle !gap-2 !p-0 flex-shrink-0 sm:me-2 me-0 !rounded-full !shadow-none text-xs align-middle !border-0 !shadow-transparent ">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        {{--                        <img class="inline-block rounded-full " src="../assets/images/faces/9.jpg" width="32"--}}
                        {{--                             height="32" alt="Image Description">--}}

                        <svg id="menusvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="#845ADF"
                                  d="M8 6a2 2 0 1 1-4 0a2 2 0 0 1 4 0m0 6a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4m8-14a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m4-10a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4"/>
                        </svg>
                    </button>
                    {{--                    <div class="md:block hidden dropdown-profile">--}}
                    {{--                        <p class="font-semibold mb-0 leading-none text-[#536485] text-[0.813rem] ">Json Taylor</p>--}}
                    {{--                        <span class="opacity-[0.7] font-normal text-[#536485] block text-[0.6875rem] ">Web Designer</span>--}}
                    {{--                    </div>--}}
                    <div
                            class="hs-dropdown-menu ti-dropdown-menu !-mt-3 border-0 w-[11rem] !p-0 border-defaultborder hidden main-header-dropdown  pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="dropdown-profile">
                        <ul class="text-defaulttextcolor font-medium dark:text-[#8c9097] dark:text-white/50">
                            <li id="userbalance">
                                <span class="w-full ti-dropdown-item !text-[0.8125rem] !gap-x-0 !p-[0.65rem] !inline-flex ">
                                    <i class="ti ti-wallet text-[1.125rem] me-2 opacity-[0.7]"></i>Bal:0.00 ₾
                                </span>
                            </li>
                            <li>
                                <form action="{{route('bog.auth.htmx')}}" target="hiddenIframe">
                                    <button data-hs-overlay="#fillballance"
                                            class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex"
                                            href="javascript:void(0)">
                                        <i class="ti  text-[1.125rem] me-2 opacity-[0.7]">₾</i>{{__('Top Up')}}
                                    </button>
                                </form>
                            </li>
                            <li id="userbalance">
                                <a class="w-full ti-dropdown-item !text-[0.8125rem] !gap-x-0 !p-[0.65rem] !inline-flex "
                                   href="{{route('bog.user.request')}}">
                                    <i class="ti  text-[1.125rem] me-2 opacity-[0.7]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24">
                                            <path fill="currentcolor"
                                                  d="M12.3 8.93L9.88 6.5h5.62V10H17V5H9.88l2.42-2.43l-1.06-1.07L7 5.75L11.24 10zM12 14a3 3 0 1 0 3 3a3 3 0 0 0-3-3m-9-3v12h18V11m-2 8a2 2 0 0 0-2 2H7a2 2 0 0 0-2-2v-4a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2Z"/>
                                        </svg>
                                    </i>
                                    {{__('Refund')}}
                                </a>
                            </li>

                            <li>
                                <a class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex"
                                   href="{{route('userbalance.history')}}">
                                    <i class="ti  text-[1.125rem] me-2 opacity-[0.7]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7s-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.95 8.95 0 0 0 13 21a9 9 0 0 0 0-18m-1 5v5l4.25 2.52l.77-1.29l-3.52-2.09V8z"/>
                                        </svg>
                                    </i>{{__('History')}}
                                </a>
                            </li>
                            <li>
                                <a data-hs-overlay="#hs-vertically-centered-scrollable-modal"
                                   class="hs-dropdown-toggle w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex">
                                    <i class="ti  text-[1.125rem] me-2 opacity-[0.7]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24">
                                            <path fill="white"
                                                  d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm0-2h12V10H6zm6-3q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6zM6 20V10z"/>
                                        </svg>
                                    </i>{{__('Credentials')}}
                                </a>
                            </li>
                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="w-full ti-dropdown-item !text-[0.8125rem] !p-[0.65rem] !gap-x-0 !inline-flex"
                                            href="sign-in-cover.html"><i
                                                class="ti ti-logout text-[1.125rem] me-2 opacity-[0.7]"></i>{{__('Log Out')}}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Header Profile -->

                <!-- Switcher Icon -->
                {{--                <div class="header-element md:px-[0.48rem]">--}}
                {{--                    <button aria-label="button" type="button"--}}
                {{--                            class="hs-dropdown-toggle switcher-icon inline-flex flex-shrink-0 justify-center items-center gap-2  rounded-full font-medium  align-middle transition-all text-xs dark:text-[#8c9097] dark:text-white/50 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"--}}
                {{--                            data-hs-overlay="#hs-overlay-switcher">--}}
                {{--                        <i class="bx bx-cog header-link-icon animate-spin-slow"></i>--}}
                {{--                    </button>--}}
                {{--                </div>--}}
                <!-- Switcher Icon -->

                <!-- End::header-element -->
            </div>
        </div>
    </nav>
    {{--    Credentials Modal--}}

</header>
<div id="hs-vertically-centered-scrollable-modal" class="hs-overlay hidden ti-modal">
    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="max-h-full overflow-hidden ti-modal-content" style="min-width: 300px">
            <form action="{{route('credentials.update')}}" method="post">
                @csrf
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel3">
                        {{__('Change Credentials')}}
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#hs-vertically-centered-scrollable-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                  fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body">
                    <div class="grid grid-cols-12 ">
                        <div class="xl:col-span-12 col-span-12 mb-4">
                            <input type="text" value="{{auth()->user()->name}}" name="name"
                                   class="form-control form-control-lg w-full !rounded-md" id="signup-firstname"
                                   placeholder="სახელი">
                        </div>
                        <div class="xl:col-span-12 col-span-12 mb-4">

                            <input autocomplete="off" type="text" name="password"
                                   class="form-control form-control-lg w-full !rounded-md" placeholder="პაროლი">

                        </div>
                        <div class="xl:col-span-12 col-span-12 mb-4">

                            <input type="text" name="password_confirmation"
                                   class="form-control form-control-lg w-full !rounded-md" id="signup-confirmpassword"
                                   placeholder="დაადასტურეთ პაროლი">

                        </div>
                        <div class="xl:col-span-12 col-span-12 mb-4">

                            <input type="text" value="{{auth()->user()->mobile}}" name="mobile"
                                   class="form-control form-control-lg w-full !rounded-md" id="signup-confirmpassword"
                                   placeholder="დაადასტურეთ პაროლი">

                        </div>
                    </div>
                </div>
                <div class="ti-modal-footer ">
                    <div class="flex justify-center gap-4 w-full">
                        <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-secondary-full"
                                data-hs-overlay="#hs-vertically-centered-scrollable-modal">
                            {{__('Close')}}
                        </button>
                        <button class="ti-btn ti-btn-primary-full" href="javascript:void(0);">
                            {{__('Save')}}
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>