
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

@if(request()->routeIs('midjourney') || request()->routeIs('flux-schnell') || request()->routeIs('runway'))
    <!-- Chat JS -->
    <script src="{{asset('assets/js/chat.js')}}"></script>
@endif

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

@if(request()->routeIs('runway'))

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
        Swal.fire({
                html: `
    <div class="flex justify-center">
<span style="color:red;font-size:50px" class="material-symbols-outlined">error</span>
  </div>
    <p style="font-size:1.2rem" class="mt-2">{{session()->get('alert_error')}}</p>
  `,
                timer: 1800,
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
                icon: 'success',
                showConfirmButton: false,
                timer: 1800,
                text: '{{session()->get('alert_success')}}',
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