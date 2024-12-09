@extends('user.pages.layout')

@section('gallery')
    <div class="main-content">
        <!-- Page Header -->
        <div class="block justify-center page-header md:flex mb-1">
            <form class="flex justify-center gap-5" id="modelForm" action="">
                <select
                        onchange="document.getElementById('modelForm').action = baseUrl + '/'+'{{app()->getLocale()}}' + '/gallery/' + this.value; document.getElementById('modelForm').submit();"
                        style="width: 150px" class="ti-form-select rounded-sm !py-2 !px-3">
                    <option @if(request('model')=='flux-schnell') selected @endif value="flux-schnell">Flux Schnell</option>
                    <option @if(request('model')=='midjourney') selected @endif value="midjourney">Midjourney</option>
                    <option @if(request('model')=='removebg') selected @endif value="removebg">Remove BG</option>
                    <option @if(request('model')=='runway') selected @endif value="runway">Runway</option>
                    <option @if(request('model')=='colorize') selected @endif value="colorize">Colorize</option>
                </select>

                <div class="flex items-center justify-center gap-3">
                    <p>{{__('Total')}}:</p>
                    <span class="max-w-40 truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-lg text-xs font-medium bg-primary/10 text-primary/80">
                         {{$count}}
                    </span>
                </div>

            </form>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="grid grid-cols-12 gap-x-6 mb-1">
            @if($model==='flux-schnell')
                @foreach($fluxes as $indexFlux => $flux)
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                        <div class="flex justify-center gap-2">
                            {{--Delete--}}
                            <form class="mb-2" action="{{route('flux-schnell.delete',$flux->id)}}" method="post">
                                @csrf
                                <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$indexFlux}}">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="30" height="30" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                    </svg>
                                </a>
                                <div id="staticBackdrop{{$indexFlux}}"
                                     class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h6 class="modal-title text-[1rem] font-semibold">Delete</h6>
                                                <button type="button"
                                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                        data-hs-overlay="#staticBackdrop{{$indexFlux}}">
                                                    <span class="sr-only">Close</span>
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                            <div class="ti-modal-body px-4">
                                                <p>
                                                    Are you sure you want to delete this image?
                                                </p>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#staticBackdrop{{$indexFlux}}">
                                                    Close
                                                </button>
                                                <button class="ti-btn bg-primary text-white !font-medium">Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{--Download--}}
                            <form class="mb-2" action="{{route('flux.download')}}">
                                <input type="hidden" name="id" value="{{$flux->id}}">
                                <button>
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="30" height="30" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                    </svg>
                                </button>
                            </form>
                            {{--Copy--}}
                            <button class="mb-2" data-hs-overlay="#actionsmodal" onclick="
                                    navigator.clipboard.writeText('{{$flux->media->first()->getUrl()}}');
                            copyUrl3()">
                                <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                     width="30" height="30" viewBox="0 0 512 512">
                                    <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                          stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="32"
                                          d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                </svg>
                            </button>
                            {{--Share--}}
                            <form action="{{route('flux.make.public')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$flux->id}}">
                                <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop2{{$indexFlux}}">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="30" height="30" viewBox="0 0 24 24">
                                        <path {{$flux->public===1? "fill=green" : "fill=currentColor"}} fill-rule="evenodd"
                                              d="M14.25 5.5a3.25 3.25 0 1 1 .833 2.173l-2.717 1.482l-3.04 1.737a3.25 3.25 0 0 1 .31 2.464l5.447 2.971a3.25 3.25 0 1 1-.719 1.316l-5.447-2.97a3.25 3.25 0 1 1-.652-4.902l3.37-1.926l2.729-1.489a3.3 3.3 0 0 1-.114-.856m3.25-1.75a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m-11 7a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m9.25 7.75a1.75 1.75 0 1 1 3.5 0a1.75 1.75 0 0 1-3.5 0"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <div id="staticBackdrop2{{$indexFlux}}"
                                     class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h6 class="modal-title text-[1rem] font-semibold">{{__('Make Public')}}</h6>
                                                <button type="button"
                                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                        data-hs-overlay="#staticBackdrop2{{$indexFlux}}">
                                                    <span class="sr-only">Close</span>
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                            <div class="ti-modal-body px-4">
                                                <p>
                                                    {{__('Make the photo available to everyone')}}
                                                </p>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#staticBackdrop2{{$indexFlux}}">
                                                    {{__('Close')}}
                                                </button>
                                                <button class="ti-btn bg-primary text-white !font-medium">{{__('share')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @foreach($flux->media as $media)
                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img style="object-fit: cover;max-height: 290px" src="{{$media->getUrl()}}" alt="image">
                            </a>
                        @endforeach
                    </div>
                @endforeach
            @endif
            @if($model==='colorize')
                    @foreach($colorizations as $indexColorize=> $colorized)
                        <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                            <div class="flex justify-center gap-2">
                                {{--Delete--}}
                                <form class="mb-2" action="{{route('colorize.delete',$colorized->id)}}" method="post">
                                    @csrf
                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$indexColorize}}">
                                        <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                             width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                        </svg>
                                    </a>
                                    <div id="staticBackdrop{{$indexColorize}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                                            <div class="ti-modal-content">
                                                <div class="ti-modal-header">
                                                    <h6 class="modal-title text-[1rem] font-semibold">Delete</h6>
                                                    <button type="button"
                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                            data-hs-overlay="#staticBackdrop{{$indexColorize}}">
                                                        <span class="sr-only">Close</span>
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                                <div class="ti-modal-body px-4">
                                                    <p>
                                                        Are you sure you want to delete this image?
                                                    </p>
                                                </div>
                                                <div class="ti-modal-footer">
                                                    <button type="button"
                                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                            data-hs-overlay="#staticBackdrop{{$indexColorize}}">
                                                        Close
                                                    </button>
                                                    <button class="ti-btn bg-primary text-white !font-medium">Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{--Download--}}
                                <form class="mb-2" action="{{route('colorize.download')}}">
                                    <input type="hidden" name="id" value="{{$colorized->id}}">
                                    <button>
                                        <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                             width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                        </svg>
                                    </button>
                                </form>
                                {{--Copy--}}
                                <button class="mb-2" data-hs-overlay="#actionsmodal" onclick="
                                    navigator.clipboard.writeText('{{$colorized->media->first()->getUrl()}}');
                            copyUrl3()">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="30" height="30" viewBox="0 0 512 512">
                                        <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                              stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="32"
                                              d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                    </svg>
                                </button>
                                {{--Share--}}
{{--                                <form action="{{route('flux.make.public')}}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="id" value="{{$colorized->id}}">--}}
{{--                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop2{{$indexColorize}}">--}}
{{--                                        <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                             width="30" height="30" viewBox="0 0 24 24">--}}
{{--                                            <path {{$colorized->public===1? "fill=green" : "fill=currentColor"}} fill-rule="evenodd"--}}
{{--                                                  d="M14.25 5.5a3.25 3.25 0 1 1 .833 2.173l-2.717 1.482l-3.04 1.737a3.25 3.25 0 0 1 .31 2.464l5.447 2.971a3.25 3.25 0 1 1-.719 1.316l-5.447-2.97a3.25 3.25 0 1 1-.652-4.902l3.37-1.926l2.729-1.489a3.3 3.3 0 0 1-.114-.856m3.25-1.75a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m-11 7a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m9.25 7.75a1.75 1.75 0 1 1 3.5 0a1.75 1.75 0 0 1-3.5 0"--}}
{{--                                                  clip-rule="evenodd"/>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                    <div id="staticBackdrop2{{$indexColorize}}"--}}
{{--                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">--}}
{{--                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">--}}
{{--                                            <div class="ti-modal-content">--}}
{{--                                                <div class="ti-modal-header">--}}
{{--                                                    <h6 class="modal-title text-[1rem] font-semibold">{{__('Make Public')}}</h6>--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"--}}
{{--                                                            data-hs-overlay="#staticBackdrop2{{$indexColorize}}">--}}
{{--                                                        <span class="sr-only">Close</span>--}}
{{--                                                        <i class="ri-close-line"></i>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="ti-modal-body px-4">--}}
{{--                                                    <p>--}}
{{--                                                        {{__('Make the photo available to everyone')}}--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <div class="ti-modal-footer">--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"--}}
{{--                                                            data-hs-overlay="#staticBackdrop2{{$indexColorize}}">--}}
{{--                                                        {{__('Close')}}--}}
{{--                                                    </button>--}}
{{--                                                    <button class="ti-btn bg-primary text-white !font-medium">{{__('share')}}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                            </div>
                            @foreach($colorized->media as $media)
                                <a  href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                    <img style="object-fit: cover;max-height: 290px" src="{{$media->getUrl()}}" alt="image">
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            @if($model==='midjourney')
                @foreach($midjourneys as $midjourney)
                    @foreach($midjourney->media as $mediaindex=> $media)
                        <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                            <div class="flex justify-center gap-2">
                               {{--DELETE--}}
                                <form class="mb-2" action="{{route('midjourney.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="mediaid" value="{{$media->id}}">
                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop2{{$media->id}}">
                                        <svg class="badge bg-primary/10  text-primary"
                                             xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                        </svg>
                                    </a>
                                    <div id="staticBackdrop2{{$media->id}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <div class="ti-modal-content">
                                                <div class="ti-modal-header">
                                                    <h6 class="modal-title text-[1rem] font-semibold">{{__('Delete')}}</h6>
                                                    <button type="button"
                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                            data-hs-overlay="#staticBackdrop2{{$media->id}}">
                                                        <span class="sr-only">Close</span>
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                                <div class="ti-modal-body px-4">
                                                    <p>
                                                        {{__('Are you sure ?')}}
                                                    </p>
                                                </div>
                                                <div class="ti-modal-footer">
                                                    <button type="button"
                                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                            data-hs-overlay="#staticBackdrop2{{$media->id}}">
                                                        {{__('Close')}}
                                                    </button>
                                                    <button class="ti-btn bg-primary text-white !font-medium">{{__('Delete')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{--DOWNLOAD--}}
                                <form class="mb-2" action="{{route('midjourney.download')}}">
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="index" value="{{$mediaindex}}">
                                    <button>
                                        <svg class="badge bg-primary/10  text-primary"
                                             xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                        </svg>
                                    </button>
                                </form>
                                {{--COPY--}}
                                <button class="mb-2" data-hs-overlay="#actionsmodal" onclick="
                                    navigator.clipboard.writeText('{{$media->getUrl()}}');
                            copyUrl3()
                            ">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="30" height="30" viewBox="0 0 512 512">
                                        <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                              stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="32"
                                              d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                    </svg>
                                </button>
                                {{--Share--}}
                                <form action="{{route('midjourney.make.public')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="mediaid" value="{{$media->id}}">
                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop3{{$media->id}}">
                                        <svg class="badge bg-primary/10  text-primary"
                                             xmlns="http://www.w3.org/2000/svg"
                                             width="30" height="30" viewBox="0 0 24 24">
                                            <path {{$media->public===1? "fill=green" : "fill=currentColor"}} fill-rule="evenodd"
                                                  d="M14.25 5.5a3.25 3.25 0 1 1 .833 2.173l-2.717 1.482l-3.04 1.737a3.25 3.25 0 0 1 .31 2.464l5.447 2.971a3.25 3.25 0 1 1-.719 1.316l-5.447-2.97a3.25 3.25 0 1 1-.652-4.902l3.37-1.926l2.729-1.489a3.3 3.3 0 0 1-.114-.856m3.25-1.75a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m-11 7a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5m9.25 7.75a1.75 1.75 0 1 1 3.5 0a1.75 1.75 0 0 1-3.5 0"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <div id="staticBackdrop3{{$media->id}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
                                            <div class="ti-modal-content">
                                                <div class="ti-modal-header">
                                                    <h6 class="modal-title text-[1rem] font-semibold">{{__('Make Public')}}</h6>
                                                    <button type="button"
                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                            data-hs-overlay="#staticBackdrop3{{$media->id}}">
                                                        <span class="sr-only">Close</span>
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                                <div class="ti-modal-body px-4">
                                                    <p>
                                                        @if($media->public===0)
                                                            {{__('Make the photo available to everyone')}}
                                                        @else
                                                            {{__('Remove photo from public gallery')}}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="ti-modal-footer">
                                                    <button type="button"
                                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                            data-hs-overlay="#staticBackdrop3{{$media->id}}">
                                                        {{__('Close')}}
                                                    </button>
                                                    <button class="ti-btn bg-primary text-white !font-medium">
                                                        @if($media->public===0)
                                                            {{__('share')}}
                                                        @else
                                                            {{__('Remove2')}}
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img src="{{$media->getUrl()}}" alt="image">
                            </a>
                        </div>
                    @endforeach
                @endforeach
            @endif
            @if($model==='removebg')
                @foreach($removebgs as $indexBg => $removebg)
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                        <div class="flex justify-center gap-3">
                            <form class="mb-2" action="{{route('bg.delete',$removebg->id)}}" method="post">
                                @csrf
                                <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$indexBg}}">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                    </svg>
                                </a>
                                <div id="staticBackdrop{{$indexBg}}"
                                     class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h6 class="modal-title text-[1rem] font-semibold">Modal title</h6>
                                                <button type="button"
                                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                        data-hs-overlay="#staticBackdrop{{$indexBg}}">
                                                    <span class="sr-only">Close</span>
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                            <div class="ti-modal-body px-4">
                                                <p>
                                                    Are you sure you want to delete this image?
                                                </p>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#staticBackdrop{{$indexBg}}">
                                                    Close
                                                </button>
                                                <button class="ti-btn bg-primary text-white !font-medium">Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="mb-2" action="{{route('bg.download',$removebg->id)}}">
                                <input type="hidden" name="id" value="{{$removebg->id}}">
                                <button>
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                    </svg>
                                </button>
                            </form>
                            {{--share Button--}}
                            <button class="mb-2" data-hs-overlay="#actionsmodal" onclick="
                                    navigator.clipboard.writeText('{{$removebg->media->first()?->getUrl()}}');
                            copyUrl3()
                            ">
                                <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                     width="35" height="35" viewBox="0 0 512 512">
                                    <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                          stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="32"
                                          d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                </svg>
                            </button>
                        </div>
                        @foreach($removebg->media as $media)
                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img src="{{$media->getUrl()}}" alt="image">
                            </a>
                        @endforeach
                    </div>
                @endforeach
            @endif
            @if($model==='runway')
                @foreach($runways as $runwayindex => $runway)
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                        <div class="flex justify-center gap-3 mt-5">
                            <form class="mb-2" action="{{route('runway.delete',$runway->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$runway->id}}">
                                <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$runwayindex}}">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                    </svg>
                                </a>
                                <div id="staticBackdrop{{$runwayindex}}"
                                     class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h6 class="modal-title text-[1rem] font-semibold">{{__('Delete Video')}}</h6>
                                                <button type="button"
                                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                        data-hs-overlay="#staticBackdrop{{$runwayindex}}">
                                                    <span class="sr-only">Close</span>
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </div>
                                            <div class="ti-modal-body px-4">
                                                <p>
                                                    {{__('Are you sure you want to delete this video?')}}
                                                </p>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <button type="button"
                                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                        data-hs-overlay="#staticBackdrop{{$runwayindex}}">
                                                    {{__('Close')}}
                                                </button>
                                                <button class="ti-btn bg-primary text-white !font-medium">{{__('Delete')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="mb-2" action="{{route('runway.download',$runway->id)}}">
                                <input type="hidden" name="id" value="{{$runway->id}}">
                                <button>
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                         width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                    </svg>
                                </button>
                            </form>
                            {{--share Button--}}
                            <button class="mb-2" data-hs-overlay="#actionsmodal" onclick="
                                    navigator.clipboard.writeText('{{$runway->video_url}}');
                            copyUrl3()
                            ">
                                <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg"
                                     width="35" height="35" viewBox="0 0 512 512">
                                    <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                          stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="32"
                                          d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                </svg>
                            </button>
                        </div>
                        @foreach($runway->getMedia('runway_image') as $media)
                            <a style="position: relative" aria-label="anchor" href="javascript:void(0);"
                               data-hs-overlay="#hs-extralarge-modal"
                               onclick="document.getElementById('modalvideo').src='{{$runway->video_url}}'
                                            document.getElementById('videoprompt').innerHTML = '{{$runway->prompt}}'
                                            "
                               class="chat-media ">
                                <img style="object-fit: cover" src="{{$media->getUrl()}}" alt="">
                                <svg style="position:absolute;top:50%;left:50%;transform: translate(-50%,-50%);color:#845ADF"
                                     xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                     viewBox="0 0 16 16">
                                    <path fill="currentColor"
                                          d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0m4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
        {{--PAGINATION--}}
        <div class="grid justify-center sm:flex sm:items-center gap-2 flex-wrap">
            <!-- Pagination Wrapper -->
            <nav class="flex items-center justify-center -space-x-px mb-3">
                @if(isset($data))
                    @if ($data->onFirstPage())
                        <a type="button"
                           class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <i class="ri-arrow-left-s-line align-middle rtl:rotate-180"></i>
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" type="button"
                           class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <i class="ri-arrow-left-s-line align-middle rtl:rotate-180"></i>
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @endif
                @endif

                @if(isset($data))
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-primary text-white border border-gray-200 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-primary dark:border-white/10 dark:text-white dark:focus:bg-gray-500"
                            aria-current="page">

                        {{ $data->currentPage() }}
                    </button>
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-gray-200 text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        -
                    </button>
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-primary text-white border border-gray-200 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-primary dark:border-white/10 dark:text-white dark:focus:bg-gray-500"
                            aria-current="page">
                        {{ $data->lastPage() }}
                    </button>
                @endif

                @if (isset($data))
                    <a href="{{ $data->nextPageUrl() }}" type="button"
                       class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        <span aria-hidden="true" class="sr-only">Next</span>
                        <i class="ri-arrow-right-s-line align-middle rtl:rotate-180"></i>
                    </a>
                @endif
            </nav>
            {{-- PER PAGE AND GO TO PAGE--}}
            <div class="flex justify-center items-center gap-x-5 mb-3">
                {{-- do not apply per page dropdown for midjourney--}}
                @if(request('model')!=='midjourney')
                    <div class="hs-dropdown ti-dropdown [--placement:top-left]">
                        <button id="hs-pagination-dropdown-bordered-group1" type="button"
                                class="hs-dropdown-toggle !py-2 !px-2.5 ti-dropdown-toggle">
                            {{request()->query('perpage',8)}}
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu ti-dropdown-menu hidden"
                             aria-labelledby="hs-pagination-dropdown-bordered-group1">
                            <a
                                    @if(isset($fluxes)) href="{{route('gallery',['model'=>'flux-schnell','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('gallery',['model'=>'midjourney','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('gallery',['model'=>'removebg','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($colorizations)) href="{{route('gallery',['model'=>'colorize','perpage'=>$perpage1,'page'=>request()->query('page')])}}"
                                    @endif
                                    type="button" class="ti-dropdown-item w-full justify-between">
                                8 image
                                @if(request()->query('perpage')==8)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                            <a
                                    @if(isset($fluxes)) href="{{route('gallery',['model'=>'flux-schnell','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('gallery',['model'=>'midjourney','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('gallery',['model'=>'removebg','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($colorizations)) href="{{route('gallery',['model'=>'colorize','perpage'=>$perpage2,'page'=>request()->query('page')])}}"
                                    @endif
                                    type="button" class="ti-dropdown-item w-full justify-between">
                                16 image
                                @if(request()->query('perpage')==16)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                            <a
                                    @if(isset($fluxes)) href="{{route('gallery',['model'=>'flux-schnell','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($midjourneys)) href="{{route('gallery',['model'=>'midjourney','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($removebgs)) href="{{route('gallery',['model'=>'removebg','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    @if(isset($colorizations)) href="{{route('gallery',['model'=>'colorize','perpage'=>$perpage3,'page'=>request()->query('page')])}}"
                                    @endif
                                    type="button" class="ti-dropdown-item w-full justify-between">
                                32 image
                                @if(request()->query('perpage')==32)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                @endif


                <!-- Go To Page -->
                <form action="">
                    <div class="flex justify-center sm:justify-start items-center gap-x-2">
                                            <span class="text-sm text-gray-800 whitespace-nowrap dark:text-white">
                                                {{__('Go to page')}}
                                            </span>
                        <input type="number" name="page"
                               class="min-h-[32px] py-2 px-2.5 block w-12 border-gray-200 rounded-md text-sm text-center focus:border-primary focus:ring-primary [&amp;::-webkit-outer-spin-button]:appearance-none [&amp;::-webkit-inner-spin-button]:appearance-none disabled:opacity-50 disabled:pointer-events-none dark:bg-bodybg dark:border-white/10 dark:text-gray-400 dark:focus:ring-gray-600">


                        <button style="height: 100%!important;"
                                class="text-sm text-gray-800 whitespace-nowrap dark:text-white ">
                            <span class="badge bg-primary/10  text-primary ms-1">GO</span>
                        </button>
                    </div>
                </form>
                <!-- End Go To Page -->
            </div>

        </div>

        {{--    VIDEO MODAL--}}
        <div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
                <div class="ti-modal-content">
                    <div class="ti-modal-header">
                        <h6 id="videoprompt" class="ti-modal-title">
                            Modal title
                        </h6>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                                data-hs-overlay="#hs-extralarge-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                        fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body">
                        <video id="modalvideo"
                               controls autoplay
                               style="width: 100%; height: 100%">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const baseUrl = "{{ url('/') }}";
        </script>
        {{--Copy link functionality--}}
        <script>
            function copyUrl3() {

                Swal.fire({
                        html: `
    <div class="flex justify-center">
    <svg style="color:green;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">დაკოპირდა</p>
  `,
                        showConfirmButton: false,
                        timer: 2500,
                            {{--text: '{{session()->get('alert_success')}}',--}}
                    },
                )

            }
        </script>
@endsection