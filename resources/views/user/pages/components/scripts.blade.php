<script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Switch JS -->
<script src="{{asset('assets/js/switch.js')}}"></script>
<!-- Preline JS -->
<script src="{{asset('assets/libs/preline/preline.js')}}"></script>
<!-- popperjs -->
<script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>
<!-- Color Picker JS -->
<script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>
<!-- sidebar JS -->
<script src="{{asset('assets/js/defaultmenu.js')}}"></script>
<!-- sticky JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>
<!-- Simplebar JS -->
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<!-- Apex Charts JS -->
{{--<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>--}}

<!-- Jobs-Dashboard -->
{{--<script src="../assets/js/jobs-dashboard.js"></script>--}}

<!-- Custom-Switcher JS -->
<script src="{{asset('assets/js/custom-switcher.js')}}"></script>


<script src="{{asset('assets/js/chat.js')}}"></script>


@if(request()->routeIs('bg.remove') )

    <script>

        const inputElement = document.querySelector('.filepond');

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginImageValidateSize,
        );

        const multipleInput = document.getElementById('multiple');
        FilePond.create(inputElement, {
            labelIdle: `მოათავსეთ ფოტო Drag & Drop-ით ან <span class="filepond--label-action">ატვირთეთ</span>`,
            onupdatefiles: (files) => {
                // When FilePond updates, update the hidden input with the FilePond files
                const fileArray = files.map(fileItem => fileItem.file);
                const dataTransfer = new DataTransfer();

                // Add each file from FilePond to the hidden input
                fileArray.forEach(file => {
                    dataTransfer.items.add(file);
                });

                // Set the files in the hidden input
                multipleInput.files = dataTransfer.files;
            },
        });

    </script>

@endif

@if(request()->routeIs('runway') || request()->routeIs('bg.remove'))

    <script>
        const runwayBtn = document.getElementById('runwayBtn');
        const runwayFile = document.getElementById('runwayFile');
        const runwayPhotoName = document.getElementById('runwayPhotoName');

        // Trigger file selection when button is clicked
        runwayBtn.addEventListener('click', function() {
            runwayFile.click();
        });

        // Display the selected file name
        runwayFile.addEventListener('change', function() {
            const fileName = runwayFile.files[0]?.name || "No file selected";
            runwayPhotoName.textContent = fileName;
        });

    </script>

@endif


<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/custom-htmx.js')}}"></script>


@if(session()->has('alert_error'))
    <script>
        // <span style="color:red;font-size:50px" class="material-symbols-outlined">error</span>
        Swal.fire({
                html: `
    <div class="flex justify-center">
    <svg style="color:red;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m7.493.015l-.386.04c-1.873.187-3.76 1.153-5.036 2.579C.66 4.211-.057 6.168.009 8.253c.115 3.601 2.59 6.65 6.101 7.518a8.03 8.03 0 0 0 6.117-.98a8 8 0 0 0 3.544-4.904c.172-.701.212-1.058.212-1.887s-.04-1.186-.212-1.887C14.979 2.878 12.315.498 9 .064C8.716.027 7.683-.006 7.493.015m1.36 1.548a6.5 6.5 0 0 1 3.091 1.271c.329.246.976.893 1.222 1.222c.561.751.976 1.634 1.164 2.479a6.8 6.8 0 0 1 0 2.93c-.414 1.861-1.725 3.513-3.463 4.363a6.8 6.8 0 0 1-1.987.616c-.424.065-1.336.065-1.76 0c-1.948-.296-3.592-1.359-4.627-2.993a7.5 7.5 0 0 1-.634-1.332A6.2 6.2 0 0 1 1.514 8c0-1.039.201-1.925.646-2.84c.34-.698.686-1.18 1.253-1.747A6 6 0 0 1 5.16 2.16a6.45 6.45 0 0 1 3.693-.597M7.706 4.29c-.224.073-.351.201-.413.415c-.036.122-.04.401-.034 2.111c.008 1.97.008 1.971.066 2.08a.7.7 0 0 0 .346.308c.132.046.526.046.658 0a.7.7 0 0 0 .346-.308c.058-.109.058-.11.066-2.08c.008-2.152.008-2.154-.145-2.335c-.124-.148-.257-.197-.556-.205a1.7 1.7 0 0 0-.334.014m.08 6.24a.86.86 0 0 0-.467.402a.85.85 0 0 0-.025.563A.78.78 0 0 0 8 12c.303 0 .612-.22.706-.505a.85.85 0 0 0-.025-.563a.95.95 0 0 0-.348-.352c-.116-.06-.429-.089-.547-.05"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_error')}}</p>
  `,
                timer: 2500,
                showConfirmButton: false,
            },
        )
    </script>
    @php
        session()->forget('alert_error');
    @endphp
@endif
@if(session()->has('alert_success'))
    <script>
        Swal.fire({
            html: `
    <div class="flex justify-center">
    <svg style="color:green;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_success')}}</p>
  `,
                showConfirmButton: false,
                timer: 2500,
                {{--text: '{{session()->get('alert_success')}}',--}}
            },
        )
    </script>
    @php
        session()->forget('alert_success');
    @endphp
@endif
@if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            html: '{!! implode('<br>', $errors->all()) !!}',
            showConfirmButton: false,
            timer: 2800,
        });
    </script>
@endif
<script type="module" src="{{asset('assets/js/spin.js')}}"></script>




{{--Scroll position on return back--}}
<script>
    // Save scroll position before leaving the page
    window.addEventListener("beforeunload", function() {
        sessionStorage.setItem("scrollPosition", window.scrollY);
    });

    // Restore scroll position after page load
    window.addEventListener("load", function() {
        const scrollPosition = sessionStorage.getItem("scrollPosition");
        if (scrollPosition) {
            window.scrollTo(0, scrollPosition); // Scroll to the saved position
        }
    });
</script>
{{--Initialize LIGHTBOX--}}
<script>

    const lightbox = GLightbox({
        selector: '.glightbox'
    });

</script>
{{-- SIMPLEBAR scroll to bottom--}}
<script>
    const chatscroll=document.getElementById('main-chat-contentt')
    const chatsimplebar = new SimpleBar(chatscroll);
    chatsimplebar.getScrollElement().scrollTop=chatsimplebar.getScrollElement().scrollHeight
</script>
{{--Spinner--}}
<script type="module">
    import { Spinner } from '../../../../assets/js/spin.js';

    document.querySelector('.startSpinner').addEventListener('click', function() {
        var opts = {
            lines: 13,
            length: 38,
            width: 17,
            radius: 45,
            scale: 1,
            corners: 1,
            speed: 1,
            rotate: 0,
            animation: 'spinner-line-fade-quick',
            direction: 1,
            color: '#ffffff',
            fadeColor: 'transparent',
            shadow: '0 0 1px transparent',
            zIndex: 2000000000,
            className: 'spinner',
            position: 'absolute',
        };

        var target = document.getElementById('foo');
        if (target) {
            const spinner = new Spinner(opts).spin(target);
        }
    });
</script>