<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" class="dark"
      data-header-styles="dark" data-menu-styles="dark" data-toggled="close">

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
    <script src="../assets/js/authentication-main.js"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">


</head>

<body class="bg-white dark:!bg-bodybg">

<!-- ========== END Switcher  ========== -->

<!-- Loader -->
{{--    <div id="loader" >--}}
{{--        <img src="../assets/images/media/loader.svg" alt="">--}}
{{--    </div>--}}
<!-- Loader -->

<div class="page error-bg dark:!bg-bodybg" id="particles-js">
    <!-- Start::error-page -->
    <div class="error-page">
        <div class="container text-defaulttextcolor text-defaultsize">
            <div class="text-center p-5 my-auto">
                <div class="flex items-center justify-center h-full ">
                    <div class="xl:col-span-3"></div>
                    <div class="xl:col-span-6 col-span-12">
                        <div class="flex flex-col justify-center gap-4  items-center mb-[3rem]">
                            @if(auth()->user()->mobile===null)
                                <p style="font-size: 20px;background: -webkit-linear-gradient(45deg, #e8428c, #704ee7); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                                   class=" mb-2">გთხოვთ შეიყვანოთ ნომერი</p>
                                <form style="max-width: 170px" action="{{route('verify.mobile.store')}}"
                                      method="post">
                                    @csrf
                                    <input name="mobile" type="tel"
                                           class="form-control form-control-lg !border-s border-defaultborder dark:border-defaultborder/10 !rounded-e-none"
                                           placeholder="Mobile 5XX-XXX-XXX">
                                    @error('mobile')
                                    <p class="text-danger " role="alert">{{$message}}</p>
                                    @enderror
                                    <button class="ti-btn ti-btn-light ti-btn-wave mt-3">შენახვა</button>
                                </form>
                            @else
                                <p style="font-size: 20px;background: -webkit-linear-gradient(45deg, #e8428c, #704ee7); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                                   class=" mb-2">შეიყვანეთ კოდი</p>
                                <form style="max-width: 170px" action="{{route('verify.mobile')}}"
                                      method="post">
                                    @csrf
                                    <input name="code" type="tel"
                                           class="form-control form-control-lg !border-s border-defaultborder dark:border-defaultborder/10 !rounded-e-none"
                                           placeholder="SMS Code">
                                    @error('code')
                                    <p class="text-danger " role="alert">{{$message}}</p>
                                    @enderror
                                    <button class="ti-btn ti-btn-light ti-btn-wave mt-3">ვერიფიკაცია</button>
                                </form>
                            <div class="flex justify-center gap-4">
                                <form action="{{route('verify.mobile.resend')}}" method="post">
                                    @csrf
                                    <button style="padding: 5px" class="ti-btn ti-btn-light ti-btn-wave mt-3">ხელახლა გაგზავნა</button>
                                </form>
                                <form action="{{route('verify.mobile.change')}}" method="post">
                                    @csrf
                                    <button style="padding: 5px" class="ti-btn ti-btn-light ti-btn-wave mt-3">მობილურის შეცვლა</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        {{-- <a href="index.html" class="ti-btn bg-primary text-white font-semibold dark:border-defaultborder/10"><i class="ri-arrow-left-line align-middle inline-block"></i>BACK TO HOME</a>--}}
                    </div>
                    <div class="xl:col-span-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Particles JS -->
<script src="../assets/libs/particles.js/particles.js"></script>

<!-- Error JS -->
<script src="../assets/js/error.js"></script>
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
@if(session()->has('alert_success'))
    <script>
        Swal.fire({
                html: `
    <div class="flex justify-center">
    <svg style="color:green;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_success')}}</p>
  `,
                showConfirmButton: false,
                timer: 2500,
                    {{--text: '{{session()->get('alert_success')}}',--}}
            },
        )
    </script>
    @php
        session()->forget('alert_success');
    @endphp
@endif
</body>

</html>