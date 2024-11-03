<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark"
      data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="htmx-config" content='{"selfRequestsOnly":false}'>
    <title> IMAGEAI</title>
    <meta name="description"
          content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
    <meta name="keywords"
          content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/brand-logos/favicon.ico">

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
{{--    @if(request()->routeIs('bg.remove') || request()->routeIs('runway'))--}}
{{--        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>--}}
{{--        <link--}}
{{--                href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"--}}
{{--                rel="stylesheet"--}}
{{--        />--}}
{{--        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>--}}
{{--        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>--}}
{{--        <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>--}}
{{--        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>--}}

{{--    @endif--}}
    <script src="https://unpkg.com/htmx.org@2.0.3"
            integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq"
            crossorigin="anonymous"></script>

    @if(request()->routeIs('midjourney'))
        <style>
            .simplebar-content {
                padding-right: 5px !important;
                padding-left: 5px !important;
            }
        </style>
    @endif

    <style>
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            z-index: 1999999999; /* Behind the spinner's z-index */
            display: none; /* Hidden by default */
        }

        .hideX {
            display: none;
        }

        .filepond--item {
            width: calc(50% - 0.5em);
        }

        .gradient-text {
            background: linear-gradient(45deg, #e8428c, #704ee7) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            font-size: 2rem !important;
            font-weight: bold !important;
        }

        .box {
            background: none !important;
        }

        .box:is {
            background: none !important;
        }


        .gradient-background {
            border-radius: 25px;
            position: relative;
            background: linear-gradient(120deg, rgb(255, 100, 50) 25%, rgb(255, 0, 101) 45%, rgb(123, 46, 255) 75%);
            background-size: 200% 200%;
            animation: gradient 2s ease infinite alternate;
        }

        .gradient-background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            border-radius: inherit;
            background: linear-gradient(120deg, rgb(255, 100, 50) 25%, rgb(255, 0, 101) 45%, rgb(123, 46, 255) 75%);
            background-size: 200% 200%;
            animation: gradient 2s ease infinite alternate;
            filter: blur(12px) saturate(200%);
            opacity: 0.6;
        }

        @keyframes gradient {
            0% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0 0;
            }
        }

        .ai-image {
            min-width: 100% !important;
            min-height: 700px !important
        }

        @media only screen and (max-width: 375px) {

            .hideX {
                display: block;
            }

            .ai-image {
                min-height: 300px !important
            }

            #runwayBtn, #choosefromgallery {
                font-size: 13px;
            }

            #customwidth {
                width: 85% !important;
            }
        }

        @media only screen and (max-width: 1400px) {
            .hideX {
                display: block;
            }
        }

        .avatar::before {
            content: none !important;
        }

        @media only screen and (max-width: 990px) {

            .main-chart-wrapper {
                flex-grow: 1 !important;
                display: flex !important;
                flex-direction: column
            }

            .main-content {
                display: flex !important;
                flex-direction: column !important;
                flex-grow: 1 !important;
            }

            #main-chat {
                flex-grow: 1 !important;
            }
        }

        .custom-chat-content{
            max-height: calc(100vh - 11.5rem) !important;
        }

        .responcive-image-history{
            max-width: 250px;
        }


        @media only screen and (max-width: 400px) {
            .responcive-image-history{
                max-width: 100px;
            }

        }


    </style>

    @if(request()->routeIs('userbalance.history'))
        <style>
            .simplebar-content {
                padding: 0px!important;

            }

            @media only screen and (max-width: 465px) {
                #answer {
                    width: 94% !important;
                }
            }

        </style>
    @endif

    <link rel="stylesheet" href="{{asset('assets/css/spin.css')}}">



</head>

<body id="foo">
<div id="htmxerrors"></div>
<!-- ========== Switcher  ========== -->
@include('user.pages.components.switcher')
<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader">
    <img src="../assets/images/media/loader.svg" alt="">
</div>
<!-- Loader -->
<div class="page">

    <!-- Start::Header -->
    @include('user.pages.components.header')
    <!-- End::Header -->
    <!-- Start::app-sidebar -->

    <!-- End::app-sidebar -->

    <!-- Start::content  -->
    <div style="flex-grow: 1!important;display: flex;flex-direction: column" class="content">

        @yield('midjourney')
        @yield('removebg')
        @yield('remove-bg')
        @yield('addbg')
        @yield('add-color')
        @yield('removebg-gallery')
        @yield('fluxshnell')
        @yield('runway')
        @yield('resize')
        @yield('gallery')
        @yield('history')

    </div>
    <!-- End::content  -->

    <!-- ========== Search Modal ========== -->
    @include('user.pages.components.search-modal')
    <!-- ========== END Search Modal ========== -->

    <!-- Footer Start -->
    {{--    @include('user.pages.components.footer')--}}
    <!-- Footer End -->

</div>


<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>

<div id="responsive-overlay"></div>
<div id="spinnerOverlay" class="spinner-overlay"></div>
@include('user.pages.components.scripts')
</body>

</html>