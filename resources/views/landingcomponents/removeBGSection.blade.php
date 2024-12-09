<section  style="position: relative" class="section-space-md-y zindex ">
    <div id="particlesjs3"></div>
    {{--        <div class="hero-1--container2"></div>--}}
    <div class="container">
        <div class="row g-4 justify-content-xxl-between align-items-center">
            <div class="col-lg-6 col-xxl-5 order-2 order-lg-1">

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
            <div class="col-lg-6 customorder order-1 order-lg-2">
                <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                    {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                    {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                </div>
                <h1 class="text-gradient-primary text-center
                                       @if(app()->getLocale() === 'ka')
                          firago
                        @else
                       jakarta
                         @endif
                " data-cue="fadeIn">
                    {{__('Remove Background')}}
                </h1>
                <p class="text-light mb-
                                       @if(app()->getLocale() === 'ka')
                          firago
                        @else
                       jakarta
                         @endif
                "
                   style="text-align: justify!important;"
                   data-cue="fadeIn">
                    {{__('remove bg text')}}
                </p>
                <div class="detailsbtn mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
                     data-cue="fadeIn" data-show="true"
                     style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;width: 100%;justify-content: center">
                    <a href="contact.html"
                       class=" btn btn-primary-gradient text-white fs-14 border-0 rounded-pill"><span
                                class="d-inline-block">დეტალურად</span><span
                                class="d-inline-block"><i class="bi bi-arrow-right"></i> </span></a>

                </div>

            </div>
        </div>
    </div>
</section>