@extends('user.pages.layout')

@section('add-color')

    {{--    @dd($removebg->media[0])--}}
    <div class="main-content">


        <div class="flex flex-col items-center justify-center gap-5 mt-8">
            <input type="color" id="colorPicker" value="#ffffff"/>
            <div id="dispnone" >
                <label for="topImageInput"
                > ატვირთეთ ფოტო ფონის გარეშე:</label>
                <input type="file" id="topImageInput" accept="image/*"/>
            </div>
            <form id="form" class="flex flex-col justify-center align-middle text-center" style="width: 100%!important;"
                  enctype="multipart/form-data" action="{{route('bg.save')}}" method="post">
                @csrf
                <input type="hidden" name="canvas_image" id="canvasImageInput">

                <div class="flex justify-center">
                    <canvas style="border: 3px solid black;border-radius: 10px"
                            id="photoCanvas"></canvas>
                </div>

                <div class="flex justify-center gap-5 mt-5">
                    <button id="submitBtn" class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white mt-3">
                        <span class="material-symbols-outlined">save</span>
                    </button>
                    <button type="button" class="ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white mt-3"
                            id="saveBtn">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                </div>

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
                        @if($image->url!==null)
                            <a href="{{$image->url}}" class=" ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"
                               type="button">
                                <span class="material-symbols-outlined">download</span>
                                ორიგინალი
                            </a>
                        @endif
                        <a href="{{route('bg.download2',['id'=>$image->id])}}"
                           class="downloadcompressed ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"
                           type="button">
                            <span class="material-symbols-outlined">download</span>
                        </a>

                        <form action="{{route('bg.delete',[$image->id])}}" method="post">
                            @csrf
                            <button
                                    class="downloadcompressed ti-btn ti-btn-dark !rounded-full ti-btn-wave text-white"
                                    type="submit">
                                <span class="material-symbols-outlined">delete</span>

                            </button>
                        </form>
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

    <script>
        // Load the image
        const img = new Image();

        @if($removebg->media->count()>0)
        const imageSrc = '{{$removebg->media[0]->getUrl()}}'
        img.src = imageSrc;
        @endif
        const canvas = document.getElementById("photoCanvas");
        const ctx = canvas.getContext("2d");
        const colorPicker = document.getElementById("colorPicker");



       // Assuming you have a default image source

        const topImageInput = document.getElementById("topImageInput");
        topImageInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result; // Set the image source to the file data URL
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });



        img.onload = function () {
            // Set canvas dimensions to match the image
            canvas.width = img.width;
            canvas.height = img.height;

            // Adjust canvas size if it exceeds the viewport
            if (canvas.width > window.innerWidth * 0.9) {
                canvas.width = window.innerWidth * 0.9;
                canvas.height = (canvas.width / img.width) * img.height; // Maintain aspect ratio
            }
            if (canvas.height > window.innerHeight * 0.9) {
                canvas.height = window.innerHeight * 0.9;
                canvas.width = (canvas.height / img.height) * img.width; // Maintain aspect ratio
            }

            // Fill canvas with the selected color
            fillCanvas(colorPicker.value);

            // Draw the image on top of the background
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Scale the image to fit the canvas
        };



        // Function to fill the canvas with the selected color
        function fillCanvas(color) {
            ctx.fillStyle = color;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        // Event listener for the color picker
        colorPicker.addEventListener("input", (event) => {
            fillCanvas(event.target.value);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height); // Redraw the image after changing background
        });


        // SAVE FORM
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            // Prevent form from submitting immediately
            event.preventDefault();

            // Redraw the canvas without handles for saving


            // Convert canvas to base64 PNG data
            const canvasData = canvas.toDataURL('image/png');

            // Set the base64 data into the hidden input field
            document.getElementById('canvasImageInput').value = canvasData;

            // Redraw the canvas with handles again


            // Submit the form after updating the hidden input field

            document.getElementById('form').submit();

        });


        // Save the image without the resize handles
        const saveBtn = document.getElementById("saveBtn");
        saveBtn.addEventListener("click", () => {
            // Redraw without handles for saving
            drawCanvas(false);

            // Save the canvas as an image
            const link = document.createElement("a");
            link.download = "canvas-image.png";
            link.href = canvas.toDataURL();
            link.click();

            // Redraw with handles again after saving
            drawCanvas(true);
        });


        // Function to draw images and handles on the canvas
        function drawCanvas(showHandles = true) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw the background image if it exists
            if (backgroundImage) {
                ctx.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);
            }

            // Draw the top image if it exists
            if (topImage) {
                ctx.drawImage(
                    topImage,
                    topImageX,
                    topImageY,
                    topImageWidth,
                    topImageHeight
                );

                // Draw resize handles (corners) only if showHandles is true
                if (showHandles) {
                    ctx.fillStyle = "blue";
                    drawHandle(topImageX, topImageY); // Top-left
                    drawHandle(topImageX + topImageWidth, topImageY); // Top-right
                    drawHandle(topImageX, topImageY + topImageHeight); // Bottom-left
                    drawHandle(topImageX + topImageWidth, topImageY + topImageHeight); // Bottom-right
                }
            }
        }
    </script>
@endsection