<section class="hero-1--container"><!-- Hero 1 -->
    <div class="hero-1">
        <div class="section-space-y">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7 col-xl-6">
                        <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4
                          @if(app()->getLocale() === 'ka')
                          firago
                        @else
                       jakarta
                         @endif

                        "
                             data-cue="fadeIn">
                        </div>
                        <h1 style="font-size: 2.5rem;

                          text-align: center"
                            class="text-light">{{__('h1')}}
                            <span class="text-gradient-primary">{{__('h2')}}</span>
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