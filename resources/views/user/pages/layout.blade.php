<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="dark" data-header-styles="dark" data-menu-styles="dark"
      data-toggled="close">

<head>
    <script>
        if(localStorage.getItem('hs_theme')=='light'){
            let html = document.querySelector("html");
            html.className='light';
            html.setAttribute('data-header-styles', 'light');
        }
    </script>
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


        }

        .hide-gallery {
            display: none !important;
        }

        @media only screen and (max-width: 1400px) {
            .hideX {
                display: block;
            }

            .hide-gallery {
                display: flex !important;
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

        .custom-chat-content {
            max-height: calc(100vh - 14rem) !important;
        }

        .responcive-image-history {
            max-width: 250px !important;
        }

        .td-width {
            width: 250px !important;
        }

        .history-pagination {
            margin-top: 10px;
        }


        @media only screen and (max-width: 400px) {
            .responcive-image-history {
                max-width: 190px !important;
            }

            .td-width {
                width: 100px !important;
            }
        }

        .custom-height {
            height: calc(100vh - 5rem) !important;

        }

    </style>

    @if(request()->routeIs('userbalance.history'))
        <style>
            .simplebar-content {
                padding: 0px !important;

            }

            @media only screen and (max-width: 465px) {
                #answer {
                    width: 94% !important;
                }
            }

        </style>
    @endif

    <link rel="stylesheet" href="{{asset('assets/css/spin.css')}}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
<!-- Fill Balance Modal -->

<div id="responsive-overlay"></div>
<div id="spinnerOverlay" class="spinner-overlay"></div>
@include('user.pages.components.scripts')
<div id="fillballance" class="hs-overlay hidden ti-modal">
    <div style="width: 240px"
         class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center ">
        <div class="ti-modal-content" id="bogtarget">
            <form action="{{route('bog.payment.request')}}" method="post">
                @csrf
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel2">ბალანსის შევსება
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#fillballance">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                  fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body flex flex-col gap-3 justify-center align-middle">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="მინიმიმუმ 3 ლარი">
                    <button class="flex justify-center">
                        <img style="border-radius: 20px;height: 50px;object-fit: cover" src="{{asset('bog-dark.png')}}"
                             alt="">
                    </button>
                </div>
                <div style="display: flex;justify-content: center" class="ti-modal-footer ">
                    {{--                    <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-secondary-full"--}}
                    {{--                            data-hs-overlay="#fillballance">--}}
                    {{--         f               Close--}}
                    {{--                    </button>--}}
                </div>
            </form>
        </div>
    </div>
</div>
<iframe id="hiddenIframe" name="hiddenIframe" style="display: none;"></iframe>


</body>
</html>