<section  style="position: relative" class="section-space-md-y zindex ">
    <div id="particlesjs4"></div>
    <div class="section-space-top section-space-md-bottom">
        <div class="section-space-sm-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="d-flex justify-content-center align-items-center flex-wrap row-gap-2 column-gap-4"
                             data-cue="fadeIn">
                            <div class="flex-shrink-0 d-inline-block w-10 h-2px bg-primary-gradient">
                            </div>
                            <span class="d-block fw-medium text-light fs-20
                          @if(app()->getLocale() === 'ka')
                          firago
                        @else
                       jakarta
                         @endif
                            ">{{__('Pricing')}}
                            </span>
                            <div class="flex-shrink-0 d-inline-block w-10 h-2px bg-primary-gradient">
                            </div>
                        </div>
                        <h1 style="font-size: 13px;line-height: 20px" class="text-light text-center mb-1 mt-1
                        @if(app()->getLocale() === 'ka')
                          firago
                        @else
                       jakarta
                         @endif

                        "
                            data-cue="fadeIn">
                            {{__('Pricing Header')}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row g-4 align-items-center" data-cues="fadeIn">
                {{--Midjourney price--}}
                <div class="col-md-6 col-lg-4">
                    <div class="process-card rounded-5 text-center overflow-hidden">
                        <div class="bg-primary-gradient d-flex justify-content-center gap-2 px-6 px-xl-8 py-2 fs-14">
                            {{--                            <span class="d-inline-block text-light"><i--}}
                            {{--                                        class="bi bi-lightning-charge-fill"></i>--}}
                            {{--                            </span>--}}
                            <span class="d-inline-block text-light fw-medium">Midjourney</span>
                        </div>
                        <div class="p-6 p-xl-8">
                            {{--                            <h4 class="text-light">Exclusive</h4>--}}
                            {{--                            <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>--}}
                            <hr class="my-8">
                            <h2 class="text-light">0.25 ₾
                                {{--                                <span class="fs-16 fw-normal">month</span>--}}
                            </h2>
                            {{--                            <span--}}
                            {{--                                    class="d-block fs-14 text-light text-opacity-50">--}}
                            {{--                                This package is ideal for individual students, bloggers, and casual isers.--}}
                            {{--                            </span>--}}
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li class="
                        @if(app()->getLocale() === 'ka')
                           firago
                        @else
                           jakarta
                         @endif
                                ">
                                    {{(__('Generates 4 photos'))}}
                                </li>
                            </ul>
                            <hr class="my-8">
                            {{--                            <button type="button"--}}
                            {{--                                    class="btn btn-primary-gradient text-light fs-14 rounded-pill border-0"><span--}}
                            {{--                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i--}}
                            {{--                                            class="bi bi-arrow-right"></i></span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>
                {{--flux price--}}
                <div class="col-md-6 col-lg-4">
                    <div class="process-card rounded-5 text-center overflow-hidden">
                        <div class="bg-primary-gradient d-flex justify-content-center gap-2 px-6 px-xl-8 py-2 fs-14">
                            {{--                            <span class="d-inline-block text-light"><i--}}
                            {{--                                        class="bi bi-lightning-charge-fill"></i>--}}
                            {{--                            </span>--}}
                            <span class="d-inline-block text-light fw-medium">Flux</span>
                        </div>
                        <div class="p-6 p-xl-8">
                            {{--                            <h4 class="text-light">Exclusive</h4>--}}
                            {{--                            <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>--}}
                            <hr class="my-8">
                            <h2 class="text-light">0.03 ₾
                                {{--                                <span class="fs-16 fw-normal">month</span>--}}
                            </h2>
                            {{--                            <span--}}
                            {{--                                    class="d-block fs-14 text-light text-opacity-50">--}}
                            {{--                                This package is ideal for individual students, bloggers, and casual isers.--}}
                            {{--                            </span>--}}
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li class="
                        @if(app()->getLocale() === 'ka')
                           firago
                        @else
                           jakarta
                         @endif
                                ">
                                    {{(__('1 photo'))}}
                                </li>
                            </ul>
                            <hr class="my-8">
                            {{--                            <button type="button"--}}
                            {{--                                    class="btn btn-primary-gradient text-light fs-14 rounded-pill border-0"><span--}}
                            {{--                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i--}}
                            {{--                                            class="bi bi-arrow-right"></i></span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>
                {{--Remove BG price--}}
                <div class="col-md-6 col-lg-4">
                    <div class="process-card rounded-5 text-center overflow-hidden">
                        <div class="bg-primary-gradient d-flex justify-content-center gap-2 px-6 px-xl-8 py-2 fs-14">
                            {{--                            <span class="d-inline-block text-light"><i--}}
                            {{--                                        class="bi bi-lightning-charge-fill"></i>--}}
                            {{--                            </span>--}}
                            <span class="d-inline-block text-light fw-medium">{{__('Remove Background')}}</span>
                        </div>
                        <div class="p-6 p-xl-8">
                            {{--                            <h4 class="text-light">Exclusive</h4>--}}
                            {{--                            <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>--}}
                            <hr class="my-8">
                            <h2 class="text-light">0.02 ₾
                                {{--                                <span class="fs-16 fw-normal">month</span>--}}
                            </h2>
                            {{--                            <span--}}
                            {{--                                    class="d-block fs-14 text-light text-opacity-50">--}}
                            {{--                                This package is ideal for individual students, bloggers, and casual isers.--}}
                            {{--                            </span>--}}
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li class="
                        @if(app()->getLocale() === 'ka')
                           firago
                        @else
                           jakarta
                         @endif
                                ">
                                    {{(__('1 photo'))}}
                                </li>
                            </ul>
                            <hr class="my-8">
                            {{--                            <button type="button"--}}
                            {{--                                    class="btn btn-primary-gradient text-light fs-14 rounded-pill border-0"><span--}}
                            {{--                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i--}}
                            {{--                                            class="bi bi-arrow-right"></i></span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>
                {{--Runway price--}}
                <div class="col-md-6 col-lg-4 ms-auto me-auto">
                    <div class="process-card rounded-5 text-center overflow-hidden">
                        <div class="bg-primary-gradient d-flex justify-content-center gap-2 px-6 px-xl-8 py-2 fs-14">
                            {{--                            <span class="d-inline-block text-light"><i--}}
                            {{--                                        class="bi bi-lightning-charge-fill"></i>--}}
                            {{--                            </span>--}}
                            <span class="d-inline-block text-light fw-medium">Runway</span>
                        </div>
                        <div class="p-6 p-xl-8">
                            {{--                            <h4 class="text-light">Exclusive</h4>--}}
                            {{--                            <p class="text-light text-opacity-50 mb-0">The Most Basic Plan</p>--}}
                            <hr class="my-8">
                            <h2 class="text-light">1.50 ₾ / 3.00 ₾
                                {{--                                <span class="fs-16 fw-normal">month</span>--}}
                            </h2>
                            {{--                            <span--}}
                            {{--                                    class="d-block fs-14 text-light text-opacity-50">--}}
                            {{--                                This package is ideal for individual students, bloggers, and casual isers.--}}
                            {{--                            </span>--}}
                            <hr class="my-8">
                            <ul class="list gap-4">
                                <li class="
                        @if(app()->getLocale() === 'ka')
                           firago
                        @else
                           jakarta
                         @endif
                                ">
                                    {{(__('runway_pricing_text'))}}
                                </li>
                            </ul>
                            <hr class="my-8">
                            {{--                            <button type="button"--}}
                            {{--                                    class="btn btn-primary-gradient text-light fs-14 rounded-pill border-0"><span--}}
                            {{--                                        class="d-inline-block">Choose This Plan </span><span class="d-inline-block"><i--}}
                            {{--                                            class="bi bi-arrow-right"></i></span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /Pricing --><!-- FAQ  -->
    <!-- /FAQ  -->
    <div class="section-space-md-y">

        <div class="container">
            <div style="display: flex;flex-direction: column;justify-content: center;align-items: center">
                <div class="d-inline-flex align-items-center flex-wrap row-gap-2 column-gap-4 mb-2"
                     data-cue="fadeIn">
                    <div class="flex-shrink-0 d-inline-block w-20 h-2px bg-primary-gradient"></div>
                    <span class="d-block fw-medium text-light fs-20">FAQ</span>
                    <div class="flex-shrink-0 d-inline-block w-20 h-2px bg-primary-gradient"></div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-dark-gradient p-6 p-xl-8 rounded-5">
                        <div class="accordion accordion--dark accordion-separate-body accordion--faq"
                             id="faqAccordion"
                             data-cues="fadeIn">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqAccordion1" aria-expanded="true"
                                            aria-controls="faqAccordion1">
                                        ბალანსის შევსება
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
                                            aria-controls="faqAccordion2">თანხის დაბრუნება
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