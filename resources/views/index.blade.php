<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Travel, Tour and Hotel Booking HTML Template">
    <meta name="keywords" content="booking, travel, tour, hotel, bootstrap">
    <meta name="author" content="Asaduzzaman Sarker">
    <title>Zenith AI - AI Startup &amp; Technology HTML Template</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('landingassets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/ff-1.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/style.css')}}">
{{--    <link rel="stylesheet" href="{{asset('landingassets/css/particles.css')}}">--}}
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <style>
        @media only screen and (max-width: 990px) {
            .customorder{
                order: -1;
            }
        }

        .logo{
            height: 60px!important;
        }

        #particles-js, #particles-js2 {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1; /* Set behind the content */
        }

           #particlesjs3, #particlesjs4 {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1; /* Set behind the content */
        }

    </style>
    <link rel="manifest" href="{{ asset('manifest.json') }}">


</head>
<body>
{{--<div class="preloader">--}}
{{--    <div class="preloader__img"><img src="{{asset('landingassets/img/logo-light.png')}}" alt="image"></div>--}}
{{--</div>--}}
<div class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-overlay z-3 navbar--dark">
        <div class="container">
            <a href="index.html" class="logo d-block">
                <img
                        src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo"
                        class="logo__img"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryMenu"
                    aria-controls="primaryMenu" aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="primaryMenu">
                <ul class="navbar-nav justify-content-end align-items-lg-center w-100">
                    <li class="nav-item has-sub active ms-lg-auto"><a class="nav-link fs-14" href="#">Home</a>
                        <ul class="list sub-menu">
                            <li class="sub-menu__list"><a href="index.html" class="link sub-menu__link fs-14">Home 1</a>
                            </li>
                            <li class="sub-menu__list"><a href="index-2.html" class="link sub-menu__link fs-14">Home
                                    2</a></li>
                            <li class="sub-menu__list"><a href="index-3.html" class="link sub-menu__link fs-14">Home
                                    3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-sub"><a class="nav-link fs-14" href="#">Blog</a>
                        <ul class="list sub-menu">
                            <li class="sub-menu__list"><a href="blog.html" class="link sub-menu__link fs-14">Blog
                                    Grid</a></li>
                            <li class="sub-menu__list"><a href="blog-list.html" class="link sub-menu__link fs-14">Blog
                                    List</a></li>
                            <li class="sub-menu__list"><a href="blog-details.html" class="link sub-menu__link fs-14">Blog
                                    Details</a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-sub"><a class="nav-link fs-14" href="#">Pages</a>
                        <ul class="list sub-menu">
                            <li class="sub-menu__list"><a href="service.html"
                                                          class="link sub-menu__link fs-14">Service</a></li>
                            <li class="sub-menu__list"><a href="service-details.html" class="link sub-menu__link fs-14">Service
                                    Details</a></li>
                            <li class="sub-menu__list"><a href="about.html" class="link sub-menu__link fs-14">About</a>
                            </li>
                            <li class="sub-menu__list"><a href="pricing.html"
                                                          class="link sub-menu__link fs-14">Pricing</a></li>
                            <li class="sub-menu__list"><a href="faq.html" class="link sub-menu__link fs-14">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link fs-14">Contact</a></li>
                    <li class="nav-item ms-lg-auto">
                        <ul class="list list-row gap-2">
                            <li>
                                @auth()
                                    <a href="{{route('flux-schnell',['locale'=>app()->getLocale()])}}"
                                       class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                                        <span
                                                class="d-inline-block">Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{route('login',['locale'=>app()->getLocale()])}}"
                                       class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                                        <span
                                                class="d-inline-block">Login
                                        </span>
                                    </a>
                                @endauth
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="hero-1--container"><!-- Hero 1 -->
        <div class="hero-1">
            <div class="section-space-y">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 col-xl-6">
                            <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4"
                                 data-cue="fadeIn">
                            </div>
                            <h1 style="font-size: 2.5rem; font-family: FiraGO,serif!important;text-align: center"
                                class="text-light">შექმენი უნიკალური ფოტო-ვიდეო
                                <span class="text-gradient-primary">ხელოვნური ინტელექტის დახმარებით</span>
                            </h1>
                            {{--                            <p class="text-light mb-8 max-text-11" data-cue="fadeIn">It is a long established fact that--}}
                            {{--                                a reader will be distracted by the readable content of a page when looking at its--}}
                            {{--                                layout. The point of using it has a more-or less normal of letters, as more.</p>--}}
                            {{--                            <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-6"--}}
                            {{--                                 data-cue="fadeIn">--}}
                            {{--                                <a href="contact.html"--}}
                            {{--                                   class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span--}}
                            {{--                                            class="d-inline-block">Try Zenith Ai Chat for free </span><span--}}
                            {{--                                            class="d-inline-block"><i class="bi bi-arrow-right"></i> </span></a>--}}

                            {{--                            </div>--}}
                        </div>
                        <div class="col-lg-5 col-xl-6">
                            {{--                            <img src="{{asset('landingassets/img/hero-img-1.png')}}" alt="image"--}}
                            {{--                                                            class="img-fluid" data-cue="fadeIn">--}}
                            <div class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/1.webp')}}" class="glightbox">
                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/1.webp')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/3.webp')}}" class="glightbox">

                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/3.webp')}}" alt="">
                                        </a>

                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/7.webp')}}" class="glightbox">
                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/7.webp')}}" alt="">
                                        </a>

                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/8.webp')}}" class="glightbox">

                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/8.webp')}}" alt="">
                                        </a>

                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/mid5.webp')}}" class="glightbox">

                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/mid5.webp')}}" alt="">
                                        </a>

                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/6.webp')}}" class="glightbox">

                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/6.webp')}}" alt="">
                                        </a>

                                    </div>
                                    <div class="swiper-slide text-center">
                                        <a href="{{asset('landingassets/img/general/4.webp')}}" class="glightbox">

                                            <img class="img-fluid"
                                                 style="object-fit: cover;border-radius: 15px"
                                                 src="{{asset('landingassets/img/general/4.webp')}}" alt="">
                                        </a>

                                    </div>
                                </div>
                                {{--                                <!-- If we need pagination -->--}}
                                {{--                                <div class="swiper-pagination"></div>--}}

                                {{--                                <!-- If we need navigation buttons -->--}}
                                {{--                                <div class="swiper-button-prev"></div>--}}
                                {{--                                <div class="swiper-button-next"></div>--}}

                                {{--                                <!-- If we need scrollbar -->--}}
                                {{--                                <div class="swiper-scrollbar"></div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /Hero 1 --><!-- Trusted Brand  -->

    </section>
    <button id="install-button" >Install App</button>

    <!-- Midjourney Section -->
    <section  style="position: relative"  class="section-space-md-y">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row g-4 justify-content-xxl-between align-items-center">
                <div class="col-lg-6 col-xxl-5">

                    <div class="swiper" style="height: 100%">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/1.webp')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/1.webp')}}" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/2.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/2.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/3.webp')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/3.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/4.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/4.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/5.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/5.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/6.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/6.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/midjourney/7.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/midjourney/7.webp')}}" alt="">
                                </a>

                            </div>
                        </div>
                        {{--                                <!-- If we need pagination -->--}}
                        {{--                                <div class="swiper-pagination"></div>--}}

                        {{--                                <!-- If we need navigation buttons -->--}}
                        {{--                                <div class="swiper-button-prev"></div>--}}
                        {{--                                <div class="swiper-button-next"></div>--}}

                        {{--                                <!-- If we need scrollbar -->--}}
                        {{--                                <div class="swiper-scrollbar"></div>--}}
                    </div>

                </div>
                <div class="col-lg-6 customorder">
                    <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                        {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                        {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                    </div>
                    <h1 class="text-gradient-primary text-center" data-cue="fadeIn">
                        Midjourney
                    </h1>
                    <p class="text-light mb-5"
                       style="font-family: FiraGO,serif!important;text-align: justify!important;"
                       data-cue="fadeIn">
                        ერთ-ერთი ყველაზე ცნობილი ხელოვნური ინტელექტი რომელმაც შექმნის დღიდან უზარმაზარი ინტერესი და
                        "აურზაურიც" კი გამოიწვია. Midjourney დღესაც ერთ-ერთი საუკეთესო ხელსაწყოა. მას გააჩნია საუკეთესო
                        "ფანტაზიის" უნარი რომლის დახმარებითაც უნიკალური ფოტოების
                        შექნა შეუძლია. ერთადერთი მინუსი ფოტოს გენერაციის დროა, ვინაიდან იგი საკმაო კომპტიუტერულ რესურსს
                        მოიხმარს, თუმცა დანამდვილებით შეგვიძლია გითხრათ რომ შედეგი ღირს ლოდინად!!!
                    </p>
                    <div class="mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
                         data-cue="fadeIn" data-show="true"
                         style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;width: 100%;justify-content: center">
                        <a href="contact.html"
                           class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span
                                    class="d-inline-block">დეტალურად</span><span
                                    class="d-inline-block"><i class="bi bi-arrow-right"></i> </span></a>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Flux-schnell Section -->
    <section  style="position: relative" class="section-space-md-y">
        <div id="particles-js2"></div>
        <div class="container">
            <div class="row g-4 justify-content-xxl-between align-items-center">
                <div class="col-lg-6">
                    <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                        {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                        {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                    </div>
                    <h1 class="text-gradient-primary text-center" data-cue="fadeIn">
                        Flux Schnell
                    </h1>
                    <p class="text-light mb-5"
                       style="font-family: FiraGO,serif!important;text-align: justify!important;"
                       data-cue="fadeIn">
                        Black Forest Labs - ის მიერ შექმნილი Flux-ი არის 12 მილიარდიანი პარამეტრის მქონე ხელოვნური
                        ინტელექტი რომელსაც შეუძლია შექმნას როგორც მაღალი ხარისხის რეალისტური, ასევე სხვადასხვა
                        ანიმაციური
                        ტიპის ფოტოები. ჩვენ ვიყენებთ აღნიშნული მოდელის Schenll ვერსიას რომელიც საუკეთესო ვარიანტია ფასს
                        ხარისხსა და სისწრაფეს შორის.
                    </p>
                    <div class="mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
                         data-cue="fadeIn" data-show="true"
                         style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;width: 100%;justify-content: center">
                        <a href="contact.html"
                           class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span
                                    class="d-inline-block">დეტალურად</span><span
                                    class="d-inline-block"><i class="bi bi-arrow-right"></i> </span></a>

                    </div>

                </div>
                <div class="col-lg-6 col-xxl-5">

                    <div class="swiper" style="height: 100%">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/9.webp')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/9.webp')}}" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/5.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/5.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/6.webp')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/6.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/3.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/3.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/11.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/11.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/8.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/8.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/flux-schnell/10.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/flux-schnell/10.webp')}}" alt="">
                                </a>

                            </div>
                        </div>
                        {{--                                <!-- If we need pagination -->--}}
                        {{--                                <div class="swiper-pagination"></div>--}}

                        {{--                                <!-- If we need navigation buttons -->--}}
                        {{--                                <div class="swiper-button-prev"></div>--}}
                        {{--                                <div class="swiper-button-next"></div>--}}

                        {{--                                <!-- If we need scrollbar -->--}}
                        {{--                                <div class="swiper-scrollbar"></div>--}}
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Remove BG Section -->
    <section  style="position: relative" class="section-space-md-y">
        <div id="particlesjs3"></div>
        <div class="container">
            <div class="row g-4 justify-content-xxl-between align-items-center">
                <div class="col-lg-6 col-xxl-5">

                    <div class="swiper" style="height: 100%">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/1.png')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/1.png')}}" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/1-1.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/1-1.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/2.jpeg')}}" class="glightbox">
                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/2.jpeg')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/2-2.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/2-2.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/3.jpg')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/3.jpg')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/3-3.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/3-3.webp')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/5.png')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/5.png')}}" alt="">
                                </a>

                            </div>
                            <div class="swiper-slide text-center">
                                <a href="{{asset('landingassets/img/removebg/5-5.webp')}}" class="glightbox">

                                    <img class="img-fluid"
                                         style="object-fit: cover;border-radius: 15px"
                                         src="{{asset('landingassets/img/removebg/5-5.webp')}}" alt="">
                                </a>

                            </div>
                        </div>
                        {{--                                <!-- If we need pagination -->--}}
                        {{--                                <div class="swiper-pagination"></div>--}}

                        {{--                                <!-- If we need navigation buttons -->--}}
                        {{--                                <div class="swiper-button-prev"></div>--}}
                        {{--                                <div class="swiper-button-next"></div>--}}

                        {{--                                <!-- If we need scrollbar -->--}}
                        {{--                                <div class="swiper-scrollbar"></div>--}}
                    </div>

                </div>
                <div  class="col-lg-6 customorder">
                    <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                        {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                        {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                    </div>
                    <h1 class="text-gradient-primary text-center" data-cue="fadeIn">
                        ფონის გასუფთავება
                    </h1>
                    <p class="text-light mb-5"
                       style="font-family: FiraGO,serif!important;text-align: justify!important;"
                       data-cue="fadeIn">
                        ხშირად ამა თუ იმ მიზეზის გამო გვსურს ფოტოზე ფონის მოცილება, აღნიშნული საკმაოდ მარტივია თუ გაქვთ
                        Photoshop-ი და იცით მისი გამოყენება, თუმცა ხელოვნური ინტელექტის მეშვეობითვ ფონის მოცილება ერთი
                        "კლიკით" არის შესაძლებელი. ფოტოები ფონის გარეშე ხშირად გამოიყენება ელ.კომერციაში , კვების
                        ობიექტის ციფრულ მენიუებსა და სხვა მიზნებისათვის.
                    </p>
                    <div class="mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
                         data-cue="fadeIn" data-show="true"
                         style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;width: 100%;justify-content: center">
                        <a href="contact.html"
                           class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span
                                    class="d-inline-block">დეტალურად</span><span
                                    class="d-inline-block"><i class="bi bi-arrow-right"></i> </span></a>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section  style="position: relative" class="section-space-md-y">
        <div id="particlesjs4"></div>
        <div class="section-space-top section-space-md-bottom">
            <div class="section-space-sm-bottom">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-8">
                            <div class="d-flex justify-content-center align-items-center flex-wrap row-gap-2 column-gap-4"
                                 data-cue="fadeIn">
                                <div class="flex-shrink-0 d-inline-block w-10 h-2px bg-primary-gradient"></div>
                                <span class="d-block fw-medium text-light fs-20">Pricing Plan</span></div>
                            <h2 class="text-light text-center mb-0" data-cue="fadeIn">Choose Your Most Suitable Pricing
                                Plan</h2></div>
                    </div>
                </div>
            </div>
            <div class="section-space-xsm-bottom">
                <div class="container">
                    <div class="row" data-cue="fadeIn">
                        <div class="col-12">
                            <div class="d-flex justify-content-center align-items-center row-gap-2 column-gap-4">
                                <button type="button"
                                        class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span
                                            class="d-inline-block">Billed Monthly </span><span class="d-inline-block"><i
                                                class="bi bi-arrow-right"></i></span></button>
                                <button type="button" class="btn btn-outline-danger fs-14 rounded-pill"><span
                                            class="d-inline-block">Billed Yearly </span><span class="d-inline-block"><i
                                                class="bi bi-arrow-right"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-4 align-items-center" data-cues="fadeIn">
                    <div class="col-md-6 col-lg-4">
                        <div class="process-card rounded-5 p-6 p-xl-8 text-center"><h4 class="text-light">Basic</h4>
                            <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>
                            <hr class="my-8">
                            <h2 class="text-light">18.99/<span class="fs-16 fw-normal">month</span></h2><span
                                    class="d-block fs-14 text-light text-opacity-50">This package is ideal for individual students, bloggers, and casual isers.</span>
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li>Basic Content Generation</li>
                                <li class="text-opacity-50 text-light">User-Friendly Interface</li>
                                <li class="text-opacity-50 text-light">Template Variety</li>
                                <li class="text-opacity-50 text-light">Content Exploration Tools</li>
                                <li class="text-opacity-50 text-light">Priority Customer Support</li>
                            </ul>
                            <hr class="my-8">
                            <button type="button" class="btn btn-outline-danger fs-14 rounded-pill"><span
                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i
                                            class="bi bi-arrow-right"></i></span></button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="process-card rounded-5 text-center overflow-hidden">
                            <div class="bg-primary-gradient d-flex justify-content-center gap-2 px-6 px-xl-8 py-2 fs-14">
                            <span class="d-inline-block text-light"><i
                                        class="bi bi-lightning-charge-fill"></i> </span><span
                                        class="d-inline-block text-light fw-medium">Most Popular</span></div>
                            <div class="p-6 p-xl-8"><h4 class="text-light">Exclusive</h4>
                                <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>
                                <hr class="my-8">
                                <h2 class="text-light">99.99/<span class="fs-16 fw-normal">month</span></h2><span
                                        class="d-block fs-14 text-light text-opacity-50">This package is ideal for individual students, bloggers, and casual isers.</span>
                                <hr class="my-8">
                                <ul class="list gap-4">
                                    <li>Basic Content Generation</li>
                                    <li>User-Friendly Interface</li>
                                    <li class="text-opacity-50 text-light">Template Variety</li>
                                    <li class="text-opacity-50 text-light">Content Exploration Tools</li>
                                    <li class="text-opacity-50 text-light">Priority Customer Support</li>
                                </ul>
                                <hr class="my-8">
                                <button type="button"
                                        class="btn btn-primary-gradient text-light fs-14 rounded-pill border-0"><span
                                            class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i
                                                class="bi bi-arrow-right"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="process-card rounded-5 p-6 p-xl-8 text-center"><h4 class="text-light">
                                Enterprise</h4>
                            <p class="text-light text-opacity-50 mb-0">Exclusive for small business</p>
                            <hr class="my-8">
                            <h2 class="text-light">29.99/<span class="fs-16 fw-normal">month</span></h2><span
                                    class="d-block fs-14 text-light text-opacity-50">This package is ideal for individual students, bloggers, and casual isers.</span>
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li>Basic Content Generation</li>
                                <li>User-Friendly Interface</li>
                                <li>Template Variety</li>
                                <li>Content Exploration Tools</li>
                                <li>Priority Customer Support</li>
                            </ul>
                            <hr class="my-8">
                            <button type="button" class="btn btn-outline-danger fs-14 rounded-pill"><span
                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i
                                            class="bi bi-arrow-right"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /Pricing --><!-- FAQ  -->
        <!-- /FAQ  -->
        <div class="section-space-md-y">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4"
                             data-cue="fadeIn">
                            <div class="flex-shrink-0 d-inline-block w-20 h-2px bg-primary-gradient"></div>
                            <span class="d-block fw-medium text-light fs-20">FAQ</span></div>
                        <h2 class="text-light" data-cue="fadeIn">Frequently Asked Questions</h2>
                        <p data-cue="fadeIn">Many desktop publishing packages and web page editors now use as their
                            default
                            model text, and a search for will uncover many web sites still in their infancy. is
                            untrammelled
                            and when nothing prevents our</p>
                        <p class="mb-0" data-cue="fadeIn">Various versions have evolved over the years, sometimes by
                            accident sometimes on purpose</p></div>
                    <div class="col-lg-6">
                        <div class="bg-dark-gradient p-6 p-xl-8 rounded-5">
                            <div class="accordion accordion--dark accordion-separate-body accordion--faq"
                                 id="faqAccordion"
                                 data-cues="fadeIn">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faqAccordion1" aria-expanded="true"
                                                aria-controls="faqAccordion1">How Can I Get Started With Power AI’s
                                            Services?
                                        </button>
                                    </h2>
                                    <div id="faqAccordion1" class="accordion-collapse collapse show"
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                            page
                                            editors now uand a search for will uncover many web sites still in their
                                            infancy.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#faqAccordion2" aria-expanded="false"
                                                aria-controls="faqAccordion2">What is Artificial Intelligence AI?
                                        </button>
                                    </h2>
                                    <div id="faqAccordion2" class="accordion-collapse collapse"
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                            page
                                            editors now uand a search for will uncover many web sites still in their
                                            infancy.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#faqAccordion3" aria-expanded="false"
                                                aria-controls="faqAccordion3">What Services Does Power Ai Provide?
                                        </button>
                                    </h2>
                                    <div id="faqAccordion3" class="accordion-collapse collapse"
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                            page
                                            editors now uand a search for will uncover many web sites still in their
                                            infancy.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#faqAccordion4" aria-expanded="false"
                                                aria-controls="faqAccordion4">Is Power AI Suitable For Small Businesses?
                                        </button>
                                    </h2>
                                    <div id="faqAccordion4" class="accordion-collapse collapse"
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body bg-dark">Many desktop publishing packages and web
                                            page
                                            editors now uand a search for will uncover many web sites still in their
                                            infancy.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog -->
        <div class="section-space-md-y">
            <div class="section-space-sm-bottom">
                <div class="container">
                    <div class="row g-4 align-items-center" data-cues="fadeIn">
                        <div class="col-md-6"><h2 class="text-light mb-0">Our Blogs</h2></div>
                        <div class="col-md-6">
                            <div class="text-md-end"><a href="blog.html"
                                                        class="btn btn-outline-danger fs-14 rounded-pill"><span
                                            class="d-inline-block">View All Post </span><span class="d-inline-block"><i
                                                class="bi bi-arrow-right"></i></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-4" data-cues="fadeIn">
                    <div class="col-md-6 col-xl-4"><a href="blog-details.html" class="link d-block mb-6"><img
                                    src="{{asset('landingassets/img/blog-img-1.png')}}" alt="image"
                                    class="img-fluid"></a>
                        <div class="d-flex align-items-center flex-wrap gap-4 mb-2"><a href="blog.html"
                                                                                       class="link d-inline-block text-light hover:text-primary fs-14">Creative </a><span
                                    class="d-inline-block fs-14 d-inline-block text-light text-opacity-50">Oct 12, 2024</span>
                        </div>
                        <h5><a href="blog-details.html" class="link d-inline-block text-light hover:text-primary">Generation
                                Create AI Chatbots</a></h5>
                        <p class="fs-14 mb-6">publishing packages and web page editors now use as their default model
                            text,
                            and a search for will uncover many web sites</p><a href="blog-details.html"
                                                                               class="btn btn-sm btn-outline-danger fs-14 rounded-pill"><span
                                    class="d-inline-block">Read More </span><span class="d-inline-block"><i
                                        class="bi bi-arrow-right"></i></span></a></div>
                    <div class="col-md-6 col-xl-4"><a href="blog-details.html" class="link d-block mb-6"><img
                                    src="{{asset('landingassets/img/blog-img-2.png')}}" alt="image"
                                    class="img-fluid"></a>
                        <div class="d-flex align-items-center flex-wrap gap-4 mb-2"><a href="blog.html"
                                                                                       class="link d-inline-block text-light hover:text-primary fs-14">Realistic </a><span
                                    class="d-inline-block fs-14 d-inline-block text-light text-opacity-50">Oct 12, 2024</span>
                        </div>
                        <h5><a href="blog-details.html" class="link d-inline-block text-light hover:text-primary">A
                                Game-Changer For E-Commerce</a></h5>
                        <p class="fs-14 mb-6">publishing packages and web page editors now use as their default model
                            text,
                            and a search for will uncover many web sites</p><a href="blog-details.html"
                                                                               class="btn btn-sm btn-outline-danger fs-14 rounded-pill"><span
                                    class="d-inline-block">Read More </span><span class="d-inline-block"><i
                                        class="bi bi-arrow-right"></i></span></a></div>
                    <div class="col-md-6 col-xl-4"><a href="blog-details.html" class="link d-block mb-6"><img
                                    src="{{asset('landingassets/img/blog-img-3.png')}}" alt="image"
                                    class="img-fluid"></a>
                        <div class="d-flex align-items-center flex-wrap gap-4 mb-2"><a href="blog.html"
                                                                                       class="link d-inline-block text-light hover:text-primary fs-14">AI
                                Chatbots </a><span
                                    class="d-inline-block fs-14 d-inline-block text-light text-opacity-50">Oct 12, 2024</span>
                        </div>
                        <h5><a href="blog-details.html" class="link d-inline-block text-light hover:text-primary">Breaking
                                The Barriers of Creativity</a></h5>
                        <p class="fs-14 mb-6">publishing packages and web page editors now use as their default model
                            text,
                            and a search for will uncover many web sites</p><a href="blog-details.html"
                                                                               class="btn btn-sm btn-outline-danger fs-14 rounded-pill"><span
                                    class="d-inline-block">Read More </span><span class="d-inline-block"><i
                                        class="bi bi-arrow-right"></i></span></a></div>
                </div>
            </div>
        </div>

        <footer class="footer-1">
            <div class="section-space-md-y">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-6 col-xl-4"><a href="index.html" class="logo d-block mb-6"><img
                                        src="{{asset('landingassets/img/logo-light.png')}}" alt="logo"
                                        class="logo__img"></a>
                            <p class="mb-6">Many desktop publishing packages and web page editors now use as their
                                default</p><h6 class="text-light">Join On Our Newsletter</h6>
                            <div class="d-flex align-items-center border-bottom border-light border-opacity-50"><input
                                        class="form-control bg-transparent border-0 flex-grow-1" type="email"
                                        placeholder="Email Address">
                                <button type="submit"
                                        class="border-0 bg-transparent d-inline-block flex-shrink-0 text-light"><i
                                            class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="row g-4">
                                <div class="col-sm-6 col-md-3"><h5 class="text-light mb-8">Company</h5>
                                    <ul class="list gap-2">
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">About
                                                Us</a></li>
                                        <li><a href="service.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Our
                                                Mission</a></li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Company
                                                History</a></li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Testimonials</a>
                                        </li>
                                        <li><a href="contact.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Careers</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-md-3"><h5 class="text-light mb-8">Support</h5>
                                    <ul class="list gap-2">
                                        <li><a href="contact.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Contact
                                                Us</a></li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Privacy
                                                Policy</a></li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Terms
                                                Conditions</a></li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Cookies</a>
                                        </li>
                                        <li><a href="faq.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Faq</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-md-3"><h5 class="text-light mb-8">Product</h5>
                                    <ul class="list gap-2">
                                        <li><a href="blog-list.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Recents</a>
                                        </li>
                                        <li><a href="blog.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Upcoming</a>
                                        </li>
                                        <li><a href="service.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Builder</a>
                                        </li>
                                        <li><a href="about.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">On
                                                Sale</a></li>
                                        <li><a href="contact.html"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Live
                                                Demo</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-md-3"><h5 class="text-light mb-8">Follow Us</h5>
                                    <ul class="list gap-2">
                                        <li><a href="#"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Facebook</a>
                                        </li>
                                        <li><a href="#"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Twitter</a>
                                        </li>
                                        <li><a href="#"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Instagram</a>
                                        </li>
                                        <li><a href="#"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Linkedin</a>
                                        </li>
                                        <li><a href="#"
                                               class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Pinterest</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-space-xsm-y">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6"><p class="mb-0 fs-14">&copy; All CopyCopyright Reserved</p></div>
                        <div class="col-md-6">
                            <ul class="list list-row justify-content-md-end row-gap-2 column-gap-4">
                                <li><a href="#"
                                       class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Teams
                                        Of Services</a></li>
                                <li><a href="#"
                                       class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Privacy
                                        Policy</a></li>
                                <li><a href="#"
                                       class="link d-inline-block text-light text-opacity-70 hover:text-opacity-100 fs-14">Cooke
                                        Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- /Footer  -->
    </section>
    <!-- Scripts -->
</div>
<script src="{{asset('landingassets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('landingassets/js/plugins.js')}}"></script>
<script src="{{asset('landingassets/js/app.js')}}"></script>
<script src="{{asset('landingassets/js/particles/particles.min.js')}}"></script>
<script src="{{asset('landingassets/js/particles/particles2.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<script>

    document.querySelectorAll(['data-swiper-autoplay'])


    const swiper = new Swiper('.swiper', {
        speed: 200,
        spaceBetween: 100,
        loop: true,
        autoplay: {
            delay: 2500, // 3000ms (3 seconds) delay between slides
            disableOnInteraction: false, // Keep autoplay running even after interaction
        },
    });

</script>

<script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
</script>


{{--SERVICE WORKER FOR PWA--}}
<script>


    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('{{asset('service-worker.js')}}')
                .then((registration) => {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch((error) => {
                    console.error('Service Worker registration failed:', error);
                });
        });
    }

</script>

{{--Install button for pwa--}}
<script>
    let deferredPrompt; // Variable to hold the event

    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the mini-info bar from appearing on mobile
        e.preventDefault();
        // Stash the event so it can be triggered later
        deferredPrompt = e;
        // Show the install button
        document.getElementById('install-button').style.display = 'block';
    });

    document.getElementById('install-button').addEventListener('click', (e) => {
        // Hide the button
        document.getElementById('install-button').style.display = 'none';
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the install prompt');
            } else {
                console.log('User dismissed the install prompt');
            }
            deferredPrompt = null; // Clear the stored event
        });
    });
</script>


</body>
</html>