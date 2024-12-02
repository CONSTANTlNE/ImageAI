<section  style="position: relative" class="section-space-md-y zindex ">
    <div id="particles-js2"></div>
    <div class="container">
        <div class="row g-4 justify-content-xxl-between align-items-center">
            <div class="col-lg-6">
                <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4" data-cue="fadeIn">
                    {{--                        <div class="flex-shrink-0 d-inline-block w-100 h-2px bg-primary-gradient"></div>--}}
                    {{--                        <span class="d-block fw-medium text-light fs-20">About Us</span>--}}
                </div>
                <h1 class="text-gradient-primary text-center" data-cue="fadeIn">
                    Colorize
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
                   Colorize - საუკეთესო ხელოვნური ინტელექტი ძველი შავ-თეთრი ფოტოებისათვის ახალი სიცოცხლის შესაძენად. მისი დახმარებით მოგონებების და ისტორიის გაფერადებაც შეგიძლიათ.
                </p>
                <div class="detailsbtn mb-5 d-inline-flex align-items-center flex-wrap justify-center  row-gap-2 column-gap-6"
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
                    <div style="display: flex;align-items: center" class="swiper-wrapper">
                        <!-- Slides -->
                        <div  class="swiper-slide text-center flex align-middle">
                            <a  href="{{asset('landingassets/img/colorize/5.jpg')}}" class="glightbox">
                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/5.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/5-5.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/5-5.jpg')}}" alt="">
                            </a>
                        </div>
                        <div  class="swiper-slide text-center flex align-middle">
                            <a  href="{{asset('landingassets/img/colorize/8.jpg')}}" class="glightbox">
                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/8.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/8-8.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/8-8.jpg')}}" alt="">
                            </a>

                        </div>
                        <div  class="swiper-slide text-center flex align-middle">
                            <a  href="{{asset('landingassets/img/colorize/6.jpg')}}" class="glightbox">
                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/6.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/6-6.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/6-6.jpg')}}" alt="">
                            </a>

                        </div>
                        <div  class="swiper-slide text-center flex align-middle">
                            <a  href="{{asset('landingassets/img/colorize/1.jpg')}}" class="glightbox">
                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/1.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/1-1.png')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/1-1.png')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/2.jpg')}}" class="glightbox">
                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/2.jpg')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/2-2.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/2-2.jpg')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/3.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/3.jpg')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/3-3.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/3-3.jpg')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a  href="{{asset('landingassets/img/colorize/4.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/4.jpg')}}" alt="">
                            </a>

                        </div>
                        <div class="swiper-slide text-center">
                            <a href="{{asset('landingassets/img/colorize/4-4.jpg')}}" class="glightbox">

                                <img class="img-fluid"
                                     style="object-fit: cover;border-radius: 15px"
                                     src="{{asset('landingassets/img/colorize/4-4.jpg')}}" alt="">
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