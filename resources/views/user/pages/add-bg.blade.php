@extends('user.pages.layout')

@section('addbg')

    <div class="main-content">


        <div class="flex justify-center align-middle mt-8">
            <form id="form" class="flex flex-col justify-center align-middle text-center" style="width: 100%!important;"
                  enctype="multipart/form-data" action="{{route('bg.save')}}" method="post">
                @csrf
                <input type="hidden" name="canvas_image" id="canvasImageInput">
                <div class="flex justify-center">
                    <div id="dispnone" style="display: none">
                        <label for="topImageInput"
                        > ატვირთეთ ფოტო ფონის გარეშე:</label>
                        <input type="file" id="topImageInput" accept="image/*"/>
                    </div>
                    <label for="backgroundImageInput">ატვირთეთ სასურველი ფონი:</label>
                    <input type="file" id="backgroundImageInput" accept="image/*"/>


                </div>
                <div class="flex justify-center">
                    <canvas style="border: 3px solid black;border-radius: 10px"
                            id="myCanvas"></canvas>
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
        const canvas = document.getElementById("myCanvas");
        const ctx = canvas.getContext("2d");

        // Variables to store images and positions
        let backgroundImage = null;
        let topImage = null;
        let topImageX = 0;
        let topImageY = 0;
        let topImageWidth = 100;
        let topImageHeight = 100;
        let aspectRatio = 1;
        let isDragging = false;
        let isResizing = false;
        let resizeHandle = null;
        const resizeHandleSize = 10;
        let dragStartX, dragStartY;

        // Function to load and draw an image on the canvas
        function loadImage(file, callback) {
            const img = new Image();
            img.onload = () => callback(img);
            img.src = URL.createObjectURL(file);
        }

        // Handle top image upload (image without background)
        const topImageInput = document.getElementById("topImageInput");
        topImageInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                loadImage(file, (img) => {
                    topImage = img;
                    aspectRatio = img.width / img.height; // Store the aspect ratio
                    topImageWidth = img.width / 4;
                    topImageHeight = topImageWidth / aspectRatio; // Resize for better display
                    topImageX = (canvas.width - topImageWidth) / 2;
                    topImageY = (canvas.height - topImageHeight) / 2;
                    drawCanvas(true); // Show handles initially
                });
            }
        });

        // Handle background image upload
        const backgroundImageInput = document.getElementById(
            "backgroundImageInput"
        );

        backgroundImageInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const img = new Image();
                const reader = new FileReader();

                // Load the file data as a URL
                reader.onload = (e) => {
                    // Once the image is loaded, get its dimensions
                    img.onload = () => {
                        document.getElementById('dispnone').style.display = "block"; // Make the element visible
                        const width = img.width;
                        const height = img.height;

                        console.log("Image Width:", width);
                        console.log("Image Height:", height);

                        // Set Canvas Width and Height
                        const canvas = document.getElementById('myCanvas'); // Get the canvas element
                        const ctx = canvas.getContext('2d'); // Get the 2D drawing context
                        canvas.width = width; // Set canvas width
                        canvas.height = height; // Set canvas height

                        // Draw the image on the canvas
                        ctx.drawImage(img, 0, 0); // Draw the image starting at (0, 0)

                        // Now, you can use the image and its dimensions
                        backgroundImage = img;
                        drawCanvas(true); // Show handles after loading
                    };

                    img.src = e.target.result; // Set image source to the loaded data
                };

                reader.readAsDataURL(file); // Read the file data as a base64 encoded URL
            }
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

        // Function to draw resize handles
        function drawHandle(x, y) {
            ctx.fillRect(
                x - resizeHandleSize / 2,
                y - resizeHandleSize / 2,
                resizeHandleSize,
                resizeHandleSize
            );
        }

        // Check if mouse is on a handle for resizing
        function isOnHandle(mouseX, mouseY) {
            if (isWithinHandle(mouseX, mouseY, topImageX, topImageY))
                return "top-left";
            if (
                isWithinHandle(mouseX, mouseY, topImageX + topImageWidth, topImageY)
            )
                return "top-right";
            if (
                isWithinHandle(mouseX, mouseY, topImageX, topImageY + topImageHeight)
            )
                return "bottom-left";
            if (
                isWithinHandle(
                    mouseX,
                    mouseY,
                    topImageX + topImageWidth,
                    topImageY + topImageHeight
                )
            )
                return "bottom-right";
            return null;
        }

        // Check if the mouse is within a handle area
        function isWithinHandle(mouseX, mouseY, handleX, handleY) {
            return (
                mouseX > handleX - resizeHandleSize / 2 &&
                mouseX < handleX + resizeHandleSize / 2 &&
                mouseY > handleY - resizeHandleSize / 2 &&
                mouseY < handleY + resizeHandleSize / 2
            );
        }

        // Mouse event handlers for dragging and resizing
        canvas.addEventListener("mousedown", (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            resizeHandle = isOnHandle(mouseX, mouseY);

            if (resizeHandle) {
                isResizing = true;
            } else if (
                mouseX > topImageX &&
                mouseX < topImageX + topImageWidth &&
                mouseY > topImageY &&
                mouseY < topImageY + topImageHeight
            ) {
                isDragging = true;
                dragStartX = mouseX - topImageX;
                dragStartY = mouseY - topImageY;
            }
        });

        canvas.addEventListener("mousemove", (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            if (isDragging) {
                // Update the image position
                topImageX = mouseX - dragStartX;
                topImageY = mouseY - dragStartY;
                drawCanvas(true);
            }

            if (isResizing) {
                switch (resizeHandle) {
                    case "top-left":
                        topImageWidth += topImageX - mouseX;
                        topImageHeight = topImageWidth / aspectRatio;
                        topImageX = mouseX;
                        topImageY =
                            topImageY + topImageHeight - topImageHeight / aspectRatio;
                        break;
                    case "top-right":
                        topImageWidth = mouseX - topImageX;
                        topImageHeight = topImageWidth / aspectRatio;
                        break;
                    case "bottom-left":
                        topImageWidth += topImageX - mouseX;
                        topImageHeight = topImageWidth / aspectRatio;
                        topImageX = mouseX;
                        break;
                    case "bottom-right":
                        topImageWidth = mouseX - topImageX;
                        topImageHeight = topImageWidth / aspectRatio;
                        break;
                }
                drawCanvas(true);
            }
        });

        canvas.addEventListener("mouseup", () => {
            isDragging = false;
            isResizing = false;
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


        document.getElementById('submitBtn').addEventListener('click', function (event) {
            // Prevent form from submitting immediately
            event.preventDefault();

            // Redraw the canvas without handles for saving
            drawCanvas(false);

            // Convert canvas to base64 PNG data
            const canvasData = canvas.toDataURL('image/png');

            // Set the base64 data into the hidden input field
            document.getElementById('canvasImageInput').value = canvasData;

            // Redraw the canvas with handles again
            drawCanvas(true);

            // Submit the form after updating the hidden input field

            document.getElementById('form').submit();

        });

    </script>

@endsection