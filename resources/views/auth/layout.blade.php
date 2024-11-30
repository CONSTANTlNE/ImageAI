<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" class="dark"
      data-header-styles="dark" data-menu-styles="dark" data-toggled="close">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONIX</title>
    <meta name="description"
          content="">
    <meta name="keywords"
          content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('landingassets/img/onix.jpeg')}}">

    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/authentication-main.js')}}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">


    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('')}}../assets/libs/@simonwep/pickr/themes/nano.min.css">


    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{asset('')}}../assets/libs/swiper/swiper-bundle.min.css">

    <style>

        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            z-index: 10; /* Behind the spinner's z-index */
            display: none; /* Hidden by default */
        }

        #foo {
            position: absolute; /* Positioned absolutely relative to the container */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust position to center */

            z-index:  1999999999; /* Ensure it sits above background items */
        }

        .desktop-dark,
        .desktop-logo {
            max-width: 300px !important;
        }

        @media only screen and (max-width: 400px) {
            .desktop-dark,
            .desktop-logo {
                max-width: 200px !important;
            }

            .registerdiv{
                padding-top:10px!important
            }
        }
    </style>
</head>

<body  class="bg-white dark:!bg-bodybg text-defaulttextcolor dark:text-defaulttextcolor/70 text-defaultsize">

<!-- ========== Switcher  ========== -->
<div id="hs-overlay-switcher" class="hs-overlay hidden ti-offcanvas ti-offcanvas-right" tabindex="-1">
    <div class="ti-offcanvas-header z-10 relative">
        <h5 class="ti-offcanvas-title">
            Switcher
        </h5>
        <button type="button"
                class="ti-btn flex-shrink-0 p-0 !mb-0  transition-none text-defaulttextcolor dark:text-defaulttextcolor/70 hover:text-gray-700 focus:ring-gray-400 focus:ring-offset-white  dark:hover:text-white/80 dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                data-hs-overlay="#hs-overlay-switcher">
            <span class="sr-only">Close modal</span>
            <i class="ri-close-circle-line leading-none text-lg"></i>
        </button>
    </div>
    <div class="ti-offcanvas-body !p-0 !border-b dark:border-white/10 z-10 relative !h-auto">
        <div class="flex rtl:space-x-reverse" aria-label="Tabs" role="tablist">
            <button type="button"
                    class="hs-tab-active:bg-success/20 w-full !py-2 !px-4 hs-tab-active:border-b-transparent text-defaultsize border-0 hs-tab-active:text-success dark:hs-tab-active:bg-success/20 dark:hs-tab-active:border-b-white/10 dark:hs-tab-active:text-success -mb-px bg-white font-semibold text-center  text-defaulttextcolor dark:text-defaulttextcolor/70 rounded-none hover:text-gray-700 dark:bg-bodybg dark:border-white/10  active"
                    id="switcher-item-1" data-hs-tab="#switcher-1" aria-controls="switcher-1" role="tab">
                Theme Style
            </button>
            <button type="button"
                    class="hs-tab-active:bg-success/20 w-full !py-2 !px-4 hs-tab-active:border-b-transparent text-defaultsize border-0 hs-tab-active:text-success dark:hs-tab-active:bg-success/20 dark:hs-tab-active:border-b-white/10 dark:hs-tab-active:text-success -mb-px  bg-white font-semibold text-center  text-defaulttextcolor dark:text-defaulttextcolor/70 rounded-none hover:text-gray-700 dark:bg-bodybg dark:border-white/10  dark:hover:text-gray-300"
                    id="switcher-item-2" data-hs-tab="#switcher-2" aria-controls="switcher-2" role="tab">
                Theme Colors
            </button>
        </div>
    </div>
    <div class="ti-offcanvas-body" id="switcher-body">
        <div id="switcher-1" role="tabpanel" aria-labelledby="switcher-item-1" class="">
            <div class="">
                <p class="switcher-style-head">Theme Color Mode:</p>
                <div class="grid grid-cols-3 switcher-style">
                    <div class="flex items-center">
                        <input type="radio" name="theme-style" class="ti-form-radio" id="switcher-light-theme" checked>
                        <label for="switcher-light-theme"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Light</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="theme-style" class="ti-form-radio" id="switcher-dark-theme">
                        <label for="switcher-dark-theme"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Dark</label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Directions:</p>
                <div class="grid grid-cols-3  switcher-style">
                    <div class="flex items-center">
                        <input type="radio" name="direction" class="ti-form-radio" id="switcher-ltr" checked>
                        <label for="switcher-ltr" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">LTR</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="direction" class="ti-form-radio" id="switcher-rtl">
                        <label for="switcher-rtl" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">RTL</label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Navigation Styles:</p>
                <div class="grid grid-cols-3  switcher-style">
                    <div class="flex items-center">
                        <input type="radio" name="navigation-style" class="ti-form-radio" id="switcher-vertical" checked>
                        <label for="switcher-vertical"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Vertical</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="navigation-style" class="ti-form-radio" id="switcher-horizontal">
                        <label for="switcher-horizontal"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Horizontal</label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Navigation Menu Style:</p>
                <div class="grid grid-cols-2 gap-2 switcher-style">
                    <div class="flex">
                        <input type="radio" name="navigation-data-menu-styles" class="ti-form-radio" id="switcher-menu-click"
                               checked>
                        <label for="switcher-menu-click" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Menu
                            Click</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="navigation-data-menu-styles" class="ti-form-radio" id="switcher-menu-hover">
                        <label for="switcher-menu-hover" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Menu
                            Hover</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="navigation-data-menu-styles" class="ti-form-radio" id="switcher-icon-click">
                        <label for="switcher-icon-click" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Icon
                            Click</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="navigation-data-menu-styles" class="ti-form-radio" id="switcher-icon-hover">
                        <label for="switcher-icon-hover" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Icon
                            Hover</label>
                    </div>
                </div>
                <div class="px-4 text-secondary text-xs"><b class="me-2">Note:</b>Works same for both Vertical and
                    Horizontal
                </div>
            </div>
            <div class=" sidemenu-layout-styles">
                <p class="switcher-style-head">Sidemenu Layout Syles:</p>
                <div class="grid grid-cols-2 gap-2 switcher-style">
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-default-menu" checked>
                        <label for="switcher-default-menu"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold ">Default
                            Menu</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-closed-menu">
                        <label for="switcher-closed-menu" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold ">
                            Closed
                            Menu</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-icontext-menu">
                        <label for="switcher-icontext-menu" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold ">Icon
                            Text</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-icon-overlay">
                        <label for="switcher-icon-overlay" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold ">Icon
                            Overlay</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-detached">
                        <label for="switcher-detached"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold ">Detached</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="sidemenu-layout-styles" class="ti-form-radio" id="switcher-double-menu">
                        <label for="switcher-double-menu" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Double
                            Menu</label>
                    </div>
                </div>
                <div class="px-4 text-secondary text-xs"><b class="me-2">Note:</b>Navigation menu styles won't work
                    here.</div>
            </div>
            <div>
                <p class="switcher-style-head">Page Styles:</p>
                <div class="grid grid-cols-3  switcher-style">
                    <div class="flex">
                        <input type="radio" name="data-page-styles" class="ti-form-radio" id="switcher-regular" checked>
                        <label for="switcher-regular"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Regular</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="data-page-styles" class="ti-form-radio" id="switcher-classic">
                        <label for="switcher-classic"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Classic</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="data-page-styles" class="ti-form-radio" id="switcher-modern">
                        <label for="switcher-modern"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold"> Modern</label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Layout Width Styles:</p>
                <div class="grid grid-cols-3 switcher-style">
                    <div class="flex">
                        <input type="radio" name="layout-width" class="ti-form-radio" id="switcher-full-width" checked>
                        <label for="switcher-full-width"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">FullWidth</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="layout-width" class="ti-form-radio" id="switcher-boxed">
                        <label for="switcher-boxed" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Boxed</label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Menu Positions:</p>
                <div class="grid grid-cols-3  switcher-style">
                    <div class="flex">
                        <input type="radio" name="data-menu-positions" class="ti-form-radio" id="switcher-menu-fixed" checked>
                        <label for="switcher-menu-fixed"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Fixed</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="data-menu-positions" class="ti-form-radio" id="switcher-menu-scroll">
                        <label for="switcher-menu-scroll"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Scrollable </label>
                    </div>
                </div>
            </div>
            <div>
                <p class="switcher-style-head">Header Positions:</p>
                <div class="grid grid-cols-3 switcher-style">
                    <div class="flex">
                        <input type="radio" name="data-header-positions" class="ti-form-radio" id="switcher-header-fixed" checked>
                        <label for="switcher-header-fixed" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">
                            Fixed</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="data-header-positions" class="ti-form-radio" id="switcher-header-scroll">
                        <label for="switcher-header-scroll"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Scrollable
                        </label>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="switcher-style-head">Loader:</p>
                <div class="grid grid-cols-3 switcher-style">
                    <div class="flex">
                        <input type="radio" name="page-loader" class="ti-form-radio" id="switcher-loader-enable" checked>
                        <label for="switcher-loader-enable" class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">
                            Enable</label>
                    </div>
                    <div class="flex">
                        <input type="radio" name="page-loader" class="ti-form-radio" id="switcher-loader-disable">
                        <label for="switcher-loader-disable"
                               class="text-defaultsize text-defaulttextcolor dark:text-defaulttextcolor/70 ms-2  font-semibold">Disable
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div id="switcher-2" class="hidden" role="tabpanel" aria-labelledby="switcher-item-2">
            <div class="theme-colors">
                <p class="switcher-style-head">Menu Colors:</p>
                <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-white" type="radio" name="menu-colors"
                               id="switcher-menu-light" checked>
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Light Menu
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-dark" type="radio" name="menu-colors"
                               id="switcher-menu-dark" checked>
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Dark Menu
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-primary" type="radio" name="menu-colors"
                               id="switcher-menu-primary">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Color Menu
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-gradient" type="radio" name="menu-colors"
                               id="switcher-menu-gradient">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Gradient Menu
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-transparent" type="radio" name="menu-colors"
                               id="switcher-menu-transparent">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Transparent Menu
            </span>
                    </div>
                </div>
                <div class="px-4 text-[#8c9097] dark:text-white/50 text-[.6875rem]"><b class="me-2">Note:</b>If you want to change color Menu
                    dynamically
                    change from below Theme Primary color picker.</div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Header Colors:</p>
                <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-white !border" type="radio" name="header-colors"
                               id="switcher-header-light" checked>
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Light Header
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-dark" type="radio" name="header-colors"
                               id="switcher-header-dark">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Dark Header
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-primary" type="radio" name="header-colors"
                               id="switcher-header-primary">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Color Header
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-gradient" type="radio" name="header-colors"
                               id="switcher-header-gradient">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Gradient Header
            </span>
                    </div>
                    <div class="hs-tooltip ti-main-tooltip ti-form-radio switch-select ">
                        <input class="hs-tooltip-toggle ti-form-radio color-input color-transparent" type="radio"
                               name="header-colors" id="switcher-header-transparent">
                        <span
                                class="hs-tooltip-content ti-main-tooltip-content !py-1 !px-2 !bg-black text-xs font-medium !text-white shadow-sm dark:!bg-black"
                                role="tooltip">
              Transparent Header
            </span>
                    </div>
                </div>
                <div class="px-4 text-[#8c9097] dark:text-white/50 text-[.6875rem]"><b class="me-2">Note:</b>If you want to change color
                    Header dynamically
                    change from below Theme Primary color picker.</div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Theme Primary:</p>
                <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-primary-1" type="radio" name="theme-primary"
                               id="switcher-primary" checked>
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-primary-2" type="radio" name="theme-primary"
                               id="switcher-primary1">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-primary-3" type="radio" name="theme-primary"
                               id="switcher-primary2">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-primary-4" type="radio" name="theme-primary"
                               id="switcher-primary3">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-primary-5" type="radio" name="theme-primary"
                               id="switcher-primary4">
                    </div>
                    <div class="ti-form-radio switch-select ps-0 mt-1 color-primary-light">
                        <div class="theme-container-primary"></div>
                        <div class="pickr-container-primary"></div>
                    </div>
                </div>
            </div>
            <div class="theme-colors">
                <p class="switcher-style-head">Theme Background:</p>
                <div class="flex switcher-style space-x-3 rtl:space-x-reverse">
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-bg-1" type="radio" name="theme-background"
                               id="switcher-background" checked>
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-bg-2" type="radio" name="theme-background"
                               id="switcher-background1">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-bg-3" type="radio" name="theme-background"
                               id="switcher-background2">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-bg-4" type="radio" name="theme-background"
                               id="switcher-background3">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio color-input color-bg-5" type="radio" name="theme-background"
                               id="switcher-background4">
                    </div>
                    <div class="ti-form-radio switch-select ps-0 mt-1 color-bg-transparent">
                        <div class="theme-container-background hidden"></div>
                        <div class="pickr-container-background"></div>
                    </div>
                </div>
            </div>
            <div class="menu-image theme-colors">
                <p class="switcher-style-head">Menu With Background Image:</p>
                <div class="flex switcher-style space-x-3 rtl:space-x-reverse flex-wrap gap-3">
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio bgimage-input bg-img1" type="radio" name="theme-images" id="switcher-bg-img">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio bgimage-input bg-img2" type="radio" name="theme-images" id="switcher-bg-img1">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio bgimage-input bg-img3" type="radio" name="theme-images" id="switcher-bg-img2">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio bgimage-input bg-img4" type="radio" name="theme-images" id="switcher-bg-img3">
                    </div>
                    <div class="ti-form-radio switch-select">
                        <input class="ti-form-radio bgimage-input bg-img5" type="radio" name="theme-images" id="switcher-bg-img4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ti-offcanvas-footer sm:flex justify-between">
        <a href="javascript:void(0);" id="reset-all" class="w-full ti-btn ti-btn-danger-full m-1">Reset</a>
    </div>
</div>
<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader" >
{{--    <img src="../assets/images/media/loader.svg" alt="">--}}
</div>
<!-- Loader -->


<div class="grid grid-cols-12 authentication mx-0">
    @yield('login')
    @yield('register')
    @yield('forgot-password')
    @yield('reset-password')
</div>

<!-- Swiper JS -->
<script src="{{asset('assets/libs/swiper/swiper-bundle.min.js')}}"></script>

<!-- Internal Authentication JS -->
<script src="{{asset('assets/js/authentication.js')}}"></script>

<!-- Show Password JS -->
<script src="{{asset('assets/js/show-password.js')}}"></script>

<!-- Auth Custom JS -->
<script src="{{asset('assets/js/auth-custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session()->has('alert_error'))
    <script>
        // <span style="color:red;font-size:50px" class="material-symbols-outlined">error</span>
        Swal.fire({
                html: `
    <div class="flex justify-center">
    <svg style="color:red;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m7.493.015l-.386.04c-1.873.187-3.76 1.153-5.036 2.579C.66 4.211-.057 6.168.009 8.253c.115 3.601 2.59 6.65 6.101 7.518a8.03 8.03 0 0 0 6.117-.98a8 8 0 0 0 3.544-4.904c.172-.701.212-1.058.212-1.887s-.04-1.186-.212-1.887C14.979 2.878 12.315.498 9 .064C8.716.027 7.683-.006 7.493.015m1.36 1.548a6.5 6.5 0 0 1 3.091 1.271c.329.246.976.893 1.222 1.222c.561.751.976 1.634 1.164 2.479a6.8 6.8 0 0 1 0 2.93c-.414 1.861-1.725 3.513-3.463 4.363a6.8 6.8 0 0 1-1.987.616c-.424.065-1.336.065-1.76 0c-1.948-.296-3.592-1.359-4.627-2.993a7.5 7.5 0 0 1-.634-1.332A6.2 6.2 0 0 1 1.514 8c0-1.039.201-1.925.646-2.84c.34-.698.686-1.18 1.253-1.747A6 6 0 0 1 5.16 2.16a6.45 6.45 0 0 1 3.693-.597M7.706 4.29c-.224.073-.351.201-.413.415c-.036.122-.04.401-.034 2.111c.008 1.97.008 1.971.066 2.08a.7.7 0 0 0 .346.308c.132.046.526.046.658 0a.7.7 0 0 0 .346-.308c.058-.109.058-.11.066-2.08c.008-2.152.008-2.154-.145-2.335c-.124-.148-.257-.197-.556-.205a1.7 1.7 0 0 0-.334.014m.08 6.24a.86.86 0 0 0-.467.402a.85.85 0 0 0-.025.563A.78.78 0 0 0 8 12c.303 0 .612-.22.706-.505a.85.85 0 0 0-.025-.563a.95.95 0 0 0-.348-.352c-.116-.06-.429-.089-.547-.05"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_error')}}</p>
  `,
                timer: 2500,
                showConfirmButton: false,
            },
        )
    </script>
    @php
        session()->forget('alert_error');
    @endphp
@endif

<svg id="foo" style="display: none" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><g><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.14"/><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.29" transform="rotate(30 12 12)"/><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.43" transform="rotate(60 12 12)"/><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.57" transform="rotate(90 12 12)"/><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.71" transform="rotate(120 12 12)"/><rect width="2" height="5" x="11" y="1" fill="white" opacity="0.86" transform="rotate(150 12 12)"/><rect width="2" height="5" x="11" y="1" fill="white" transform="rotate(180 12 12)"/><animateTransform attributeName="transform" calcMode="discrete" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;30 12 12;60 12 12;90 12 12;120 12 12;150 12 12;180 12 12;210 12 12;240 12 12;270 12 12;300 12 12;330 12 12;360 12 12"/></g></svg>


<div id="spinnerOverlay" class="spinner-overlay"></div>
{{--Spinner--}}
<script type="module">

    const spinner = document.querySelectorAll('.startSpinner')
    spinner.forEach((e) => {
        e.addEventListener('click', function () {
            document.getElementById('spinnerOverlay').style.display = 'block';
            var target = document.getElementById('foo');
            target.style.display = 'block';
        })
    });

</script>


</body>

</html>