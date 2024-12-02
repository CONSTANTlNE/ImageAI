@extends('landingcomponents.layout')

@section('gallery')
<div class="section-space-y bg-dark">
    <div class="section-space-sm-bottom">
        <div class="container">
            <div class="row g-4 align-items-center mt-5">
{{--                <div class="col-md-6"><h2 class="text-light mb-0" data-cue="fadeIn">Our Blogs</h2></div>--}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-4" data-cues="fadeIn">

            <div class="col-md-6 col-xl-4 text-center">
                <a style="object-fit: cover" href="{{route('landing.gallery.model',['model'=>'flux'])}}" class="link d-block mb-6">
                    <img style="border-radius: 30px;max-width: 330px;height: 312px"
                            src="{{asset('assets/images/schnell.webp')}}" alt="image" class="img-fluid">
                </a>
                <a href="{{route('landing.gallery.model',['model'=>'flux'])}}" class="btn btn-sm btn-outline-danger fs-14 rounded-pill">
                    <span
                            class="d-inline-block">FLUX
                    </span>
                    <span class="d-inline-block"><i
                                class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 text-center">
                <a href="{{route('landing.gallery.model',['model'=>'midjourney'])}}" class="link d-block mb-6">
                    <img style="border-radius: 30px;max-width: 330px"
                         src="{{asset('assets/images/midjourney.jpg')}}" alt="image" class="img-fluid">
                </a>
                <a href="{{route('landing.gallery.model',['model'=>'midjourney'])}}" class="btn btn-sm btn-outline-danger fs-14 rounded-pill">
                    <span
                            class="d-inline-block">Midjourney
                    </span>
                    <span class="d-inline-block"><i
                                class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 text-center">
                <a href="blog-details.html" class="link d-block mb-6">
                    <img style="border-radius: 30px;max-width: 330px"
                         src="{{asset('assets/images/runway.png')}}" alt="image" class="img-fluid">
                </a>
                <a href="blog-details.html" class="btn btn-sm btn-outline-danger fs-14 rounded-pill">
                    <span
                            class="d-inline-block">Runway
                    </span>
                    <span class="d-inline-block"><i
                                class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection