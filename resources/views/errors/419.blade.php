<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" class="dark"
      data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> YNEX - Tailwind Admin Template </title>
  <meta name="description"
        content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
  <meta name="keywords"
        content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">


  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/images/brand-logos/favicon.ico">

  <!-- Main Theme Js -->
  <script src="{{asset('assets/js/authentication-main.js')}}"></script>

  <!-- Style Css -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

  <!-- Simplebar Css -->
  <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">

  <!-- Color Picker Css -->
  <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">

  <!-- Simplebar Css -->
  <link id="style" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">

  <!-- Swiper Css -->
  <link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">


</head>
<body>

<!-- ========== Switcher  ========== -->
<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader" >

</div>
<!-- Loader -->

<div class="page error-bg dark:!bg-bodybg" id="particles-js">
  <!-- Start::error-page -->
  <div class="error-page">
    <div class="container text-defaulttextcolo dark:text-defaulttextcolor/70r text-defaultsize">
      <div class="text-center p-5 my-auto">
        <div class="flex items-center justify-center h-full !text-defaulttextcolor">
          <div class="xl:col-span-3"></div>
          <div class="xl:col-span-6 col-span-12">
            <p class="error-text sm:mb-0 mb-2">419</p>
            <p class="text-[1.125rem] font-semibold mb-4">Oops &#128557;,The page you are looking for is not available.</p>
            <div class="flex justify-center items-center mb-[3rem]">
              <div class="xl:col-span-6 w-[50%]">
                <p class="mb-0 opacity-[0.7]">We are sorry for the inconvenience,The page you are trying to access has
                  been removed or never been existed.</p>
              </div>
            </div>
            <a onclick="window.history.back()"  class="ti-btn bg-primary text-white font-semibold"><i
                      class="ri-arrow-left-line align-middle inline-block"></i>RETURN BACK</a>
          </div>
          <div class="xl:col-span-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Particles JS -->
<script src="{{asset('assets/libs/particles.js/particles.js')}}"></script>

<!-- Error JS -->
<script src="{{asset('assets/js/error.js')}}"></script>

</body>

</html>