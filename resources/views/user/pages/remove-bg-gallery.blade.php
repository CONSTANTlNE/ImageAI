@extends('user.pages.layout')

@section('removebg-gallery')

    <div class="main-content">

        <div class="grid grid-cols-12 gap-x-6 mt-8">
            @foreach($images as $image)
                <div class="lg:col-span-3 md:col-span-3 sm:col-span-6 col-span-12">

                    @if($image->media->isNotEmpty())
                        @foreach($image->media as $media)
                            <a href="{{$media->getUrl()}}" class="glightbox box" data-gallery="gallery1">
                                <img class="img" style="height: 380px;object-fit: cover" src="{{$media->getUrl()}}"
                                     alt="image">
                            </a>
                        @endforeach
                            <input style="display: none" type="file" class="formfile" name="image">
                    @else
                        <a href="{{$image->url}}" class="glightbox box" data-gallery="gallery1">
                            <img class="img" style="height: 380px;object-fit: cover" src="" alt="image">
                        </a>
                        <form action="{{route('bg.save')}}" method="post" class="text-center mt-4 mb-2"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$image->id}}">
                            <input style="display: none" type="file" class="formfile" name="image">
                            <button class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white">
                                <span class="material-symbols-outlined">save</span>
                                შენახვა
                            </button>
                        </form>
                    @endif

                    <div class="flex flex-wrap justify-around mb-3">
                        @if($image->url!==null)
                            <a href="{{$image->url}}" class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"
                               type="button">
                                <span class="material-symbols-outlined">download</span>
                                ორიგინალი
                            </a>
                        @endif

                        <a href="{{route('bg.download',['id'=>$image->id])}}"  class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white" type="button">
                            <span class="material-symbols-outlined">download</span>
                            კომპრესირებული
                        </a>
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
        const images = {!! json_encode($images) !!};
        const imgview = document.querySelectorAll('.img')
        const formfile = document.querySelectorAll('.formfile')
console.log(formfile)
        images.forEach((element, index) => {

            if (element['saved'] === 0) {

                const imageUrl = element['url'];

                if (!imageUrl) return;

                const img = new Image();
                img.crossOrigin = "Anonymous"; // Handle cross-origin images

                img.onload = function () {
                    const canvas = document.createElement("canvas");
                    canvas.width = img.width; // Keep original width
                    canvas.height = img.height; // Keep original height

                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    // Compress the image without changing the size (just adjust quality)
                    canvas.toBlob(
                        (blob) => {
                            const compressedImageUrl = URL.createObjectURL(blob);
                            imgview[index].src = compressedImageUrl;

                            // ATTACH TO INPUTS
                            // Create a File object from the Blob
                            const file = new File([blob], "compressed_image.jpg", {type: "image/jpeg"});

                            // Simulate "attaching" the file to a form submission
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);

                            // Assign it to the file input (this doesn't make the file visible in the input, but works for form submission)
                            formfile[index].files = dataTransfer.files;


                            // Optional: Do something with the compressed Blob (e.g., upload it)
                            // console.log("Compressed Blob:", blob);
                        },
                        "image/jpeg", // Output format: JPEG for better compression
                        0.5 // Quality level (0.5 = 50%)
                    );
                };

                img.onerror = function () {
                    console.error("Failed to load image.");
                };

                img.src = imageUrl;
            }
        })


        const lightbox = GLightbox({
            selector: '.glightbox'
        });


    </script>
@endsection