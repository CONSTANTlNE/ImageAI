<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark"
      data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    @if(request()->routeIs('bg.remove'))
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
        <link
                href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
                rel="stylesheet"
        />
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>

    @endif
    <script src="https://unpkg.com/htmx.org@2.0.3"
            integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq"
            crossorigin="anonymous"></script>

    @if(request()->routeIs('image.generate'))
        <style>
            .simplebar-content {
                padding-right: 5px !important;
                padding-left: 5px !important;
            }
        </style>
    @endif

    <style>
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

            .ai-image {
                min-height: 300px !important
            }
        }


    </style>

    <link rel="stylesheet" href="{{asset('assets/css/spin.css')}}">

    @vite('resources/js/app.js')

</head>

<body>

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
    <div class="content">

        @yield('dashboard')
        @yield('midjourney')
        @yield('removebg')
        @yield('addbg')
        @yield('add-color')
        @yield('removebg-gallery')
        @yield('fluxshnell')

    </div>
    <!-- End::content  -->

    <!-- ========== Search Modal ========== -->
    @include('user.pages.components.search-modal')
    <!-- ========== END Search Modal ========== -->

    <!-- Footer Start -->
    @include('user.pages.components.footer')
    <!-- Footer End -->

</div>


<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>

<div id="responsive-overlay"></div>

<svg id="foo" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
    <rect width="7.33" height="7.33" x="1" y="1" fill="currentColor">
        <animate id="svgSpinnersBlocksWave0" attributeName="x" begin="0;svgSpinnersBlocksWave1.end+0.2s" dur="0.6s"
                 values="1;4;1"/>
        <animate attributeName="y" begin="0;svgSpinnersBlocksWave1.end+0.2s" dur="0.6s" values="1;4;1"/>
        <animate attributeName="width" begin="0;svgSpinnersBlocksWave1.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="0;svgSpinnersBlocksWave1.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="1;4;1"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="1;4;1"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="1;4;1"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="1;4;1"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor">
        <animate attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
    <rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor">
        <animate id="svgSpinnersBlocksWave1" attributeName="x" begin="svgSpinnersBlocksWave0.begin+0.4s" dur="0.6s"
                 values="15.66;18.66;15.66"/>
        <animate attributeName="y" begin="svgSpinnersBlocksWave0.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/>
        <animate attributeName="width" begin="svgSpinnersBlocksWave0.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/>
        <animate attributeName="height" begin="svgSpinnersBlocksWave0.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/>
    </rect>
</svg>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Switch JS -->
<script src="{{asset('assets/js/switch.js')}}"></script>

<!-- Preline JS -->
<script src="{{asset('assets/libs/preline/preline.js')}}"></script>

<!-- popperjs -->
<script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>

<!-- Color Picker JS -->
<script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>

<!-- sidebar JS -->
<script src="{{asset('assets/js/defaultmenu.js')}}"></script>

<!-- sticky JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>

<!-- Simplebar JS -->
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

<!-- Apex Charts JS -->
{{--<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>--}}

<!-- Jobs-Dashboard -->
{{--<script src="../assets/js/jobs-dashboard.js"></script>--}}

<!-- Custom-Switcher JS -->
<script src="{{asset('assets/js/custom-switcher.js')}}"></script>

@if(request()->routeIs('image.generate') || request()->routeIs('flux-schnell'))
    <!-- Chat JS -->
    <script src="{{asset('assets/js/chat.js')}}"></script>
@endif

@if(request()->routeIs('bg.remove'))

    <script>

        const inputElement = document.querySelector('.filepond');

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginImageValidateSize,
        );

        const multipleInput = document.getElementById('multiple');
        FilePond.create(inputElement, {
            labelIdle: `მოათავსეთ ფოტო Drag & Drop-ით ან <span class="filepond--label-action">ატვირთეთ</span>`,
            onupdatefiles: (files) => {
                // When FilePond updates, update the hidden input with the FilePond files
                const fileArray = files.map(fileItem => fileItem.file);
                const dataTransfer = new DataTransfer();

                // Add each file from FilePond to the hidden input
                fileArray.forEach(file => {
                    dataTransfer.items.add(file);
                });

                // Set the files in the hidden input
                multipleInput.files = dataTransfer.files;
            },
        });

    </script>

@endif

<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>


@if(session()->has('alert_error'))
    <script>
        Swal.fire({
                html: `
    <div class="flex justify-center">
<span style="color:red;font-size:50px" class="material-symbols-outlined">error</span>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_error')}}</p>
  `,
                timer: 1800,
                showConfirmButton: false,

            },
        )
    </script>
    @php
        session()->forget('alert_error');
    @endphp
@endif
@if(session()->has('alert_success'))
    <script>
        Swal.fire({
                icon: 'success',
                showConfirmButton: false,
                timer: 1800,
                text: '{{session()->get('alert_success')}}',
            },
        )
    </script>
    @php
        session()->forget('alert_success');
    @endphp
@endif
@if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            html: '{!! implode('<br>', $errors->all()) !!}',
            showConfirmButton: false,
            timer: 2800,
        });
    </script>
@endif
<script type="module" src="{{asset('assets/js/spin.js')}}"></script>

<script type="module">
    import {Spinner} from '../../../../assets/js/spin.js';

    var opts = {
        lines: 13, // The number of lines to draw
        length: 38, // The length of each line
        width: 17, // The line thickness
        radius: 45, // The radius of the inner circle
        scale: 1, // Scales overall size of the spinner
        corners: 1, // Corner roundness (0..1)
        speed: 1, // Rounds per second
        rotate: 0, // The rotation offset
        animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#ffffff', // CSS color or array of colors
        fadeColor: 'transparent', // CSS color or array of colors
        top: '50%', // Top position relative to parent
        left: '50%', // Left position relative to parent
        shadow: '0 0 1px transparent', // Box-shadow for the lines
        zIndex: 2000000000, // The z-index (defaults to 2e9)
        className: 'spinner', // The CSS class to assign to the spinner
        position: 'absolute', // Element positioning
    };

    var target = document.getElementById('foo');
    var spinner = new Spinner(opts).spin(target);
</script>

</body>

</html>