<nav class="navbar navbar-expand-lg navbar-overlay z-3 navbar--dark">
    <div class="container">
        <a href="{{route('index')}}" class="logo d-block">
            <img
                    src="{{asset('landingassets/img/onix.jpeg')}}" alt="logo"
                    class="logo__img"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryMenu"
                aria-controls="primaryMenu" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div style="" class="collapse navbar-collapse" id="primaryMenu">
            <ul class="navbar-nav justify-content-end align-items-lg-center w-100">
{{--                <li class="nav-item has-sub active ms-lg-auto"><a class="nav-link fs-14" href="#">Home</a>--}}
{{--                    <ul class="list sub-menu">--}}
{{--                        <li class="sub-menu__list"><a href="index.html" class="link sub-menu__link fs-14">Home 1</a>--}}
{{--                        </li>--}}
{{--                        <li class="sub-menu__list"><a href="index-2.html" class="link sub-menu__link fs-14">Home--}}
{{--                                2</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="index-3.html" class="link sub-menu__link fs-14">Home--}}
{{--                                3</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-sub"><a class="nav-link fs-14" href="#">Blog</a>--}}
{{--                    <ul class="list sub-menu">--}}
{{--                        <li class="sub-menu__list"><a href="blog.html" class="link sub-menu__link fs-14">Blog--}}
{{--                                Grid</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="blog-list.html" class="link sub-menu__link fs-14">Blog--}}
{{--                                List</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="blog-details.html" class="link sub-menu__link fs-14">Blog--}}
{{--                                Details</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item has-sub"><a class="nav-link fs-14" href="#">Pages</a>--}}
{{--                    <ul class="list sub-menu">--}}
{{--                        <li class="sub-menu__list"><a href="service.html"--}}
{{--                                                      class="link sub-menu__link fs-14">Service</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="service-details.html" class="link sub-menu__link fs-14">Service--}}
{{--                                Details</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="about.html" class="link sub-menu__link fs-14">About</a>--}}
{{--                        </li>--}}
{{--                        <li class="sub-menu__list"><a href="pricing.html"--}}
{{--                                                      class="link sub-menu__link fs-14">Pricing</a></li>--}}
{{--                        <li class="sub-menu__list"><a href="faq.html" class="link sub-menu__link fs-14">FAQ</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="nav-item"><a class="nav-link fs-14">Contact</a></li>--}}
                <li class="nav-item ms-lg-auto">
                    <ul style="display: flex;justify-content: center!important;" class="list list-row gap-2 flex">
                        <li>
                            <a href="{{route('landing.gallery',['locale'=>app()->getLocale()])}}"
                               class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                                        <span
                                                class="d-inline-block">გალერეა
                                        </span>
                            </a>
                        </li>
                        <li>
                            @auth()
                                <a href="{{route('flux-schnell',['locale'=>app()->getLocale()])}}"
                                   class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                                        <span
                                                class="d-inline-block">{{__('AI chat')}}</span>
                                </a>
                            @else
                                <a href="{{route('login',['locale'=>app()->getLocale()])}}"
                                   class="btn btn-primary-gradient text-white fs-14 border-0 rounded-pill">
                                        <span
                                                class="d-inline-block">{{__('Login')}}
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