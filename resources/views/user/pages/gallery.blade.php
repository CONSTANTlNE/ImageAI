@extends('user.pages.layout')

@section('gallery')
    <div class="main-content">
        <!-- Page Header -->
        <div class="block justify-between page-header md:flex">
            <div>
                <h3 class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">{{$model}}</h3>
            </div>
            <ol class="flex items-center whitespace-nowrap min-w-0">
                <li class="text-[0.813rem] ps-[0.5rem]">
                    <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate"
                       href="javascript:void(0);">
                        Apps
                        <i class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                    </a>
                </li>
                <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 "
                    aria-current="page">
                    {{$model}}
                </li>
            </ol>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="grid grid-cols-12 gap-x-6">
            @if($model==='Schnell')
                @foreach($fluxes as $flux)
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-12">
                        <div class="flex justify-around">
                            <form class="mb-2" action="{{route('flux-schnell.delete',$flux->id)}}" method="post">
                                @csrf
                                <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                            <form class="mb-2" action="{{route('flux.download')}}">
                                <input type="hidden" name="id" value="{{$flux->id}}">
                                <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white">
                                    <span class="material-symbols-outlined">Download</span>
                                </button>
                            </form>
                        </div>
                        @foreach($flux->media as $media)
                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img src="{{$media->getUrl()}}" alt="image">
                            </a>
                        @endforeach

                    </div>
                @endforeach
            @endif
            @if($model==='Midjourney')
                @foreach($midjourneys as $midjourney)
                    @foreach($midjourney->media as $mediaindex=> $media)
                        <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-12">
                            <div class="flex justify-around">
                                <form class="mb-2" action="{{route('midjourney.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="index" value="{{$mediaindex}}">
                                    <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                                <form class="mb-2" action="{{route('midjourney.download')}}">
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="index" value="{{$mediaindex}}">
                                    <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white">
                                        <span class="material-symbols-outlined">Download</span>
                                    </button>
                                </form>
                            </div>

                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img src="{{$media->getUrl()}}" alt="image">
                            </a>
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>
@endsection