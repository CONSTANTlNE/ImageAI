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
                            <p style="color:#845ADF" class="mt-3">Flux {{$index+1}} არჩევა </p>
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
                                <p style="color:#845ADF" class="mt-3">Midjourney {{$index+1}}-{{$index2+1}} არჩევა </p>
                            </div>
                            <p class="numeration" style="display: none">Midjourney {{$index+1}}-{{$index2+1}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    @endif
</div>

{{--Put flux or midjourney image in form--}}
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