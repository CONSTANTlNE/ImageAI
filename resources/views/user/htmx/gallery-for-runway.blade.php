

<div class="grid grid-cols-2 gap-2">
    @if(isset($fluxes))
        @foreach($fluxes as $index => $image)
            <div class="">
                <a href="javascript:void(0);"
                   class=" staticBackdrop2 p-4 selectImage items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                    <div>
                        @foreach($image->media as  $media)
                            <img src="{{$media->getUrl()}}" alt="figma"
                                 style="height: 110px!important;object-fit: cover"
                                 class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                        @endforeach
                        <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                            <p style="color:#845ADF" class="mt-3">Flux {{$index+1}} {{__('select')}} </p>
                        </div>
                        <p class="numeration" style="display: none">Flux {{$index+1}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
    @if(isset($midjourneys))
        @foreach($midjourneys as $index=> $image)
            @foreach($image->media as $index2=> $media)
                <div class="">
                    <a href="javascript:void(0);"
                       class=" staticBackdrop2 p-4 selectImage items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                        <div>

                            <img src="{{$media->getUrl()}}" alt="figma"
                                 style="height: 110px!important;object-fit: cover"
                                 class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">

                            <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                <p style="color:#845ADF" class="mt-3">Midjourney {{$index+1}}-{{$index2+1}} {{__('select')}}  </p>
                            </div>
                            <p class="numeration" style="display: none">Midjourney {{$index+1}}-{{$index2+1}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    @endif
</div>
{{--PAGINATION--}}
<div class="grid justify-center sm:flex sm:items-center gap-2 flex-wrap mt-2">
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
                <a
{{--                   href="{{ $data->previousPageUrl() }}" --}}
                   hx-get="{{ $data->previousPageUrl()  }}"
                   hx-target="#galleryTarget"
                   type="button"
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
            <a
                    {{--href="{{ $data->nextPageUrl() }}"--}}
                    hx-get="{{ $data->nextPageUrl() }}"
                    hx-target="#galleryTarget"
                    type="button"
                    class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <span aria-hidden="true" class="sr-only">Next</span>
                <i class="ri-arrow-right-s-line align-middle rtl:rotate-180"></i>
            </a>
        @endif
    </nav>
    {{--  GO TO PAGE--}}
    <div class="flex justify-center items-center gap-x-5 mb-3">

        <!-- Go To Page -->
        <form
{{--                action="{{request()->fullUrl()}}"--}}
        hx-get="{{request()->fullUrl()}}"
        hx-target="#galleryTarget"
        >
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
{{--when user clicks on image Put flux or midjourney image in form of remove bg or runway--}}



<script>
    selectImage = document.querySelectorAll('.selectImage')

    selectImage.forEach((element, index) => {
        element.addEventListener('click', function () {
            const imageSrc = this.querySelector('img').src
            const imageUrl = document.getElementById('imageUrl')
            imageUrl.value = imageSrc
            const runwayPhotoName2 = document.getElementById('runwayPhotoName2')
            const numeration = document.querySelectorAll('.numeration')
            runwayPhotoName2.innerHTML = numeration[index].innerHTML
        })
    });
    // Close modal when choosing photo
    staticBackdrop2 = document.querySelectorAll('.staticBackdrop2')
    staticBackdrop2.forEach(element => {
        element.addEventListener('click', function () {
            document.getElementById('closeGallery').click()
        })
    });

</script>