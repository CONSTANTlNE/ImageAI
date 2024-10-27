@extends('user.pages.layout')

@section('removebg')

    <div class="main-content">


        <div class="flex justify-center align-middle mt-8">
            <form class="text-center" style="width: 400px!important;" action="{{route('remove')}}"
                  enctype="multipart/form-data" method="post">
                @csrf
                <input id="multiple" style="display: none" type="file" name="images[]">
                <input type="file"
                       class="filepond"
                       data-allow-reorder="true"

                >
                <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white mt-3">დამუშავება</button>
            </form>
        </div>

        <div class="grid grid-cols-12 gap-x-6 mt-8">
            @foreach($images as $image)
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-12">


                    @foreach($image->media as $media)
                        <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                            <img class="img" style="height: 380px;object-fit: cover" src="{{$media->getUrl()}}"
                                 alt="image">
                        </a>
                    @endforeach
                    <div class="flex flex-wrap justify-around mb-3">
                        <div class="hs-dropdown ti-dropdown">
                            <a aria-label="anchor" href="javascript:void(0);"
                               class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white mt-3"
                               aria-expanded="false">
                                მოქმედება
                            </a>
                            <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                <li>
                                    <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                       href="{{$image->url}}">
                                        <span class="material-symbols-outlined">download</span>
                                        ორიგინალი
                                    </a>
                                </li>
                                <li>

                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="{{route('bg.download',['id'=>$image->id])}}">
                                            <span class="material-symbols-outlined">download</span>
                                            კომპრესირებული
                                        </a>

                                </li>
                                <li>
                                    <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                       href="{{$image->url}}">
                                        ფონის შეცვლა (ფოტო)
                                    </a>
                                </li>
                                <li>
                                    <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                       href="{{route('bg.add.color',['removebg'=>$image->id])}}">
                                        ფონის შეცვლა (ფერი)
                                    </a>
                                </li>
                                <li>
                                    <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                       href="javascript:void(0);">Year</a></li>
                            </ul>
                        </div>
                        {{--                        @if($image->url!==null)--}}
                        {{--                            <a href="{{$image->url}}" class=" ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"--}}
                        {{--                               type="button">--}}
                        {{--                                <span class="material-symbols-outlined">download</span>--}}
                        {{--                                ორიგინალი--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}
                        {{--                            <a href="{{route('bg.download',['id'=>$image->id])}}"--}}
                        {{--                               class="downloadcompressed ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"--}}
                        {{--                               type="button">--}}
                        {{--                                <span class="material-symbols-outlined">download</span>--}}
                        {{--                                კომპრესირებული--}}
                        {{--                            </a>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{--    <form class="text-center"  style="width: 800px!important;" action="{{route('remove')}}"  enctype="multipart/form-data" method="post">--}}
    {{--        @csrf--}}
    {{--        <input type="file"--}}
    {{--               class="filepond"--}}
    {{--               multiple--}}
    {{--               name="images"--}}
    {{--        >--}}
    {{--        <button>send</button>--}}
    {{--    </form>--}}
    <script>

        const lightbox = GLightbox({
            selector: '.glightbox'
        });

    </script>
@endsection