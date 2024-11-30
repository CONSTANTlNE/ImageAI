@extends('landingcomponents.layout')

@section('gallery')
    <section style="padding-bottom: 5px" class="section-space-y bg-dark">
        <div class="section-space-sm-bottom">
            <div class="container" id="container">
                <div style="display: flex;justify-content: center" class=" mt-5">
                    <div class="col-md-6">

                        <h1 class="text-gradient-primary text-center" data-cue="fadeIn" data-show="true" style="animation-name: fadeIn; animation-duration: 500ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            @if(request()->segment(4)==='flux')
                                Flux
                            @endif
                            @if(request()->segment(4)==='midjourney')
                                Midjourney
                            @endif
                        </h1>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-4" data-cues="fadeIn">
                @if(isset($fluxes))
                    @foreach($fluxes as $flux)
                        <div class="col-md-6 col-xl-4 text-center">
                            @foreach($flux->media as $media)
                                <a style="object-fit: cover" href="{{$media->getUrl()}}"
                                   class="link d-block mb-6 glightbox">
                                    <img style="border-radius: 30px;max-width: 330px;height: 312px"
                                         src="{{$media->getUrl()}}" alt="image" class="img-fluid">
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                @endif
                @if(isset($midjourneys))
                    @foreach($midjourneys as $midjourney)
                        @foreach($midjourney->media as $media)
                            @if($media->public===1)
                                <div class="col-md-6 col-xl-4 text-center">
                                    <a style="object-fit: cover" href="{{$media->getUrl()}}"
                                       class="link d-block mb-6 glightbox">
                                        <img style="border-radius: 30px;max-width: 330px;height: 312px"
                                             src="{{$media->getUrl()}}" alt="image" class="img-fluid">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>

        {{--Pagination--}}
        <div style="display: flex;justify-content: center;gap: 15px">
            <!-- Pagination Wrapper -->
            <nav class="flex items-center justify-center -space-x-px mb-3 ">
                @if(isset($data))
                    @if ($data->onFirstPage())
                        <a type="button"
                           class="btn btn-sm btn-outline-danger fs-14 rounded-pill text-center">
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" type="button"
                           class="btn btn-sm btn-outline-danger fs-14 rounded-pill text-center">
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @endif
                @endif

                @if(isset($data))
                    <button style="all: unset;color:#E842BC" type="button"
                            aria-current="page">
                        {{ $data->currentPage() }}
                    </button>
                    <button type="button" style="all: unset">
                        -
                    </button>
                    <button style="all: unset;color:#E842BC" type="button"
                            aria-current="page">
                        {{ $data->lastPage() }}
                    </button>
                @endif

                @if (isset($data))
                    <a href="{{ $data->nextPageUrl() }}" type="button"
                       class="btn btn-sm btn-outline-danger fs-14 rounded-pill">
                        <span aria-hidden="true" class="sr-only">Next</span>
                    </a>
                @endif
            </nav>
            {{-- PER PAGE AND GO TO PAGE--}}
            <div style="display: flex;justify-content: center">
                {{-- do not apply per page dropdown for midjourney--}}
                @if(request('model')!=='midjourney')
                    <div class="dropdowna">
                        <button  class="dropdowna-toggle btn btn-sm btn-outline-danger fs-14 rounded-pill">
                            @if(request()->query('perpage'))
                               <span>{{request()->query('perpage')}}</span>
                            @endif
                        </button>
                        <div style="width: 50px!important;border:none;" class="dropdowna-menu bg-dark">
                            <a
                                    @if(isset($fluxes)) href="{{route('landing.gallery.model',['model'=>'flux','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('landing.gallery.model',['model'=>'midjourney','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('landing.gallery.model',['model'=>'removebg','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                  >
                                8

                            </a>
                            <a
                                    @if(isset($fluxes)) href="{{route('landing.gallery.model',['model'=>'flux','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('landing.gallery.model',['model'=>'midjourney','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('landing.gallery.model',['model'=>'removebg','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                   >
                                16

                            </a>
                            <a
                                    @if(isset($fluxes)) href="{{route('landing.gallery.model',['model'=>'flux','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('landing.gallery.model',['model'=>'midjourney','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('landing.gallery.model',['model'=>'removebg','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    >
                                32

                            </a>
                        </div>
                    </div>
                @endif


            </div>

        </div>


        <script>
            const lightbox = GLightbox({
                selector: '.glightbox'
            });
        </script>
        <script>




            document.querySelectorAll('.dropdowna').forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdowna-toggle');
                const menu = dropdown.querySelector('.dropdowna-menu');

                toggle.addEventListener('click', () => {
                    // Toggle visibility
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                    // Get bounding rectangles
                    const menuRect = menu.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;

                    // Check space below
                    if (menuRect.bottom > viewportHeight) {
                        menu.classList.add('open-up'); // Open upwards
                    } else {
                        menu.classList.remove('open-up'); // Open downwards
                    }
                });

                // Close the dropdown when clicking outside
                document.addEventListener('click', (event) => {
                    if (!dropdown.contains(event.target)) {
                        menu.style.display = 'none';
                    }
                });
            });

        </script>
    </section>
@endsection