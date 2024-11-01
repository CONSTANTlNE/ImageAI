@extends('user.pages.layout')

@section('gallery')
    <div class="main-content">
        <!-- Page Header -->
        <div class="block justify-center page-header md:flex mb-5">
            <form class="flex justify-center" id="modelForm" action="">
                <select
                        onchange="document.getElementById('modelForm').action = baseUrl + '/gallery/' + this.value; document.getElementById('modelForm').submit();"
                        style="width: 150px" class="ti-form-select rounded-sm !py-2 !px-3">
                    <option @if(request('model')=='flux-schnell') selected @endif value="flux-schnell">Flux Schnell
                    </option>
                    <option @if(request('model')=='midjourney') selected @endif value="midjourney">Midjourney</option>
                    <option @if(request('model')=='removebg') selected @endif value="removebg">Remove BG</option>
                </select>
            </form>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="grid grid-cols-12 gap-x-6">
            @if($model==='flux-schnell')
                @foreach($fluxes as $indexFlux => $flux)
                    <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                        <div class="flex justify-around">
                            <form class="mb-2" action="{{route('flux-schnell.delete',$flux->id)}}" method="post">
                                @csrf
                                <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$indexFlux}}">
                                    <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                                </a>
                                <div id="staticBackdrop{{$indexFlux}}"
                                     class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h6 class="modal-title text-[1rem] font-semibold">Modal title</h6>
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
                            <form class="mb-2" action="{{route('flux.download')}}">
                                <input type="hidden" name="id" value="{{$flux->id}}">
                                <button>
                                    <svg  class="badge bg-primary/10  text-primary"  xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                                </button>
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
            @if($model==='midjourney')
                @foreach($midjourneys as $midjourney)
                    @foreach($midjourney->media as $mediaindex=> $media)
                        <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                            <div class="flex justify-around">
                                <form class="mb-2" action="{{route('midjourney.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="index" value="{{$mediaindex}}">
                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop2{{$mediaindex}}">
                                        <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                                    </a>
                                    <div id="staticBackdrop2{{$mediaindex}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <div class="ti-modal-content">
                                                <div class="ti-modal-header">
                                                    <h6 class="modal-title text-[1rem] font-semibold">Modal title</h6>
                                                    <button type="button"
                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                            data-hs-overlay="#staticBackdrop2{{$mediaindex}}">
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
                                                            data-hs-overlay="#staticBackdrop2{{$mediaindex}}">
                                                        Close
                                                    </button>
                                                    <button class="ti-btn bg-primary text-white !font-medium">Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form class="mb-2" action="{{route('midjourney.download')}}">
                                    <input type="hidden" name="id" value="{{$midjourney->id}}">
                                    <input type="hidden" name="index" value="{{$mediaindex}}">
                                    <button>
                                        <svg  class="badge bg-primary/10  text-primary"  xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
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
            @if($model==='removebg')
                    @foreach($removebgs as $indexBg => $removebg)
                        <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-6">
                            <div class="flex justify-around">
                                <form class="mb-2" action="{{route('bg.delete',$removebg->id)}}" method="post">
                                    @csrf
                                    <a href="javascript:void(0);" data-hs-overlay="#staticBackdrop{{$indexBg}}">
                                        <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
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
                                        <svg  class="badge bg-primary/10  text-primary"  xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                                    </button>
                                </form>
                            </div>
                            @foreach($removebg->media as $media)
                                <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                    <img src="{{$media->getUrl()}}" alt="image">
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
                <!-- Dropdown -->
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
                                type="button" class="ti-dropdown-item w-full justify-between">
                            32 image
                            @if(request()->query('perpage')==32)
                                <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                            @endif
                        </a>
                    </div>
                </div>
                <!-- End Dropdown -->

                <!-- Go To Page -->
                <form action="">
                    <div class="flex justify-center sm:justify-start items-center gap-x-2">
                                            <span class="text-sm text-gray-800 whitespace-nowrap dark:text-white">
                                                Go to page
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
        <script>
            const baseUrl = "{{ url('/') }}";
        </script>
@endsection