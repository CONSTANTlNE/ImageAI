<section  style="position: relative" class="section-space-md-y zindex ">
    <div id="particles-js2"></div>
    <div class="container">
        <div class="row g-4 justify-content-xxl-between align-items-center">
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                    {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                    {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                </div>
                <h1 class="text-gradient-primary text-center" data-cue="fadeIn">
                    Runway
                </h1>
                <p class="text-light mb-5
                        @if(app()->getLocale() === 'ka')
                          firago
                        @else
                          jakarta
                        @endif
                "
                   style="text-align: center!important;"
                   data-cue="fadeIn">
                    {{__('Runway Text')}}
                </p>
                <div class="detailsbtn mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
                     data-cue="fadeIn" data-show="true"
                     style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;width: 100%;justify-content: center">
                    <a href="contact.html"
                       class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                        <span
                                class="d-inline-block">დეტალურად</span><span
                                class="d-inline-block"><i class="bi bi-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-5  order-2 order-lg-1">

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