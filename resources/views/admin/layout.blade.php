<!DOCTYPE html>
<html
        lang="en"
        dir="ltr"
        data-nav-layout="vertical"
        class="dark"
        data-header-styles="dark"
        data-menu-styles="dark"
        data-toggled="icon-overlay-close"
>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Fact Check</title>
    <meta name="description"
          content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading."
    />

    <meta name="CSRF" content="{{ csrf_token() }}">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    {{--    <!-- Favicon -->--}}
    {{--    <link rel="shortcut icon" href="../assets/images/brand-logos/favicon.ico"/>--}}

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>



    <!-- Datatable Css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <!-- Tom Select Css -->
    {{--    <link rel="stylesheet" href="{{asset('assets/libs/tom-select/css/tom-select.default.min.css')}}">--}}

    {{--    <!-- Quill Editor -->--}}

{{--    <link rel="stylesheet" href="{{asset('adminassets/libs/quill/quill.snow.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('adminassets/libs/quill/quill.bubble.css')}}">--}}

    <style>
        .draggable-lang {
            cursor: move;
        }

        .draggable-lang.dragging {
            opacity: 1.5;
        }

        @media (min-width: 992px) {
            .content {
                margin-inline-start: 15rem!important;
            }
        }

        @media (min-width: 992px) {
            .app-header {
                padding-inline-start: 15rem!important;
            }
        }
    </style>

    <script src="https://unpkg.com/htmx.org@1.9.10"
            integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC"
            crossorigin="anonymous"></script>


    {{--    LightBox--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

    {{--    sweetalert--}}

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

@if(session('alerterror'))
    <script>
        Swal.fire({
            title: "{{ session('alerterror') }}",
            icon: "warning",
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "გასაგებია",
            confirmButtonColor: "#3085d6",
        });
    </script>
@endif

<div id="htmxerrors"></div>
<!-- ========== Switcher  ========== -->

<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader" >
    <img src="../assets/images/media/loader.svg" alt=""/>
</div>
<!-- Loader -->
<div  style="height: 100%!important" class="page">
    <!-- Start::Header -->
    @include('admin.components.header')
    <!-- End::Header -->

    <!-- Start::app-sidebar -->
    @include('admin.components.sidebar')
    <!-- End::app-sidebar -->


    <!-- Start::content  -->
    <div @if(request()->routeIs('products'))  class="mt-10" @else  class="content"@endif >
        <div class="main-content">

            @yield('adminindex')
            @yield('languages')
            @yield('staticTranslation')
            @yield('discounts')
            @yield('admin-products')

            @yield('users')
            @yield('restaurants')
            @yield('dishes')
        </div>
    </div>
    <!-- End::content  -->




    <!-- Footer Start -->
    @include('admin.components.footer')
    <!-- Footer End -->
</div>

<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>


<div id="responsive-overlay"></div>



<script>
    localStorage.setItem('ynexdarktheme', 'true');
    localStorage.setItem('ynexHeader', 'dark');
    const defaultTheme = {
        admin: "QR MENU",
        settings: {
            layout: {
                name: "Web Menu",
                toggle: false,
                darkMode: true,
                boxed: false
            }
        },
        reset: true
    };

    localStorage.setItem('theme', JSON.stringify(defaultTheme));
    localStorage.setItem('ynexMenu', 'dark');
    localStorage.setItem('layout-theme', 'dark');
</script>

<!-- datatables.net JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<!-- Quill Editor JS -->


<!-- Internal Quill JS -->


<script>
    new DataTable('#lang')
    new DataTable('#static-lang');
</script>
<!-- Tom Select JS -->
{{--<script src="{{asset('assets/libs/tom-select/js/tom-select.complete.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/tom-select.js')}}"></script>--}}
<!-- Language Switch -->


<!-- Set language status -->
<script>
    const langSwitch = document.querySelectorAll('[data-descr="langSwitch"]');
    const langStatusForm = document.querySelectorAll('[data-descr="langStatusForm"]');
    langSwitch.forEach((el, index) => {
        el.addEventListener('change', (e) => {
            langStatusForm[index].submit();
        })
    })
</script>

<!-- edit static traslation -->
<script>



    const updateForm2=document.getElementById('updateForm')
    updateForm2.addEventListener('mouseover',(e)=>{
        editTranslationButtons=document.querySelectorAll(`[data-edit]`)
        console.log(editTranslationButtons)
        editTranslationButtons.forEach((el, index) => {

            el.addEventListener('click', e => {
                console.log(e)
                document.querySelectorAll('[data-form-abbr="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.removeAttribute('disabled');
                });
                document.querySelectorAll('[data-form-key="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.removeAttribute('disabled');
                });

                document.querySelectorAll('[data-key="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.removeAttribute('disabled');
                });

                document.querySelectorAll('[data-translation="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.removeAttribute('disabled');
                });

                document.querySelectorAll('[data-abbr="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.removeAttribute('disabled');
                });

                document.querySelectorAll('[data-submit="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.style.display = 'block';
                });
                document.querySelectorAll('[data-cancel-submit="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.style.display = 'block';
                });

                document.querySelectorAll('[data-delete="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                    element.style.display = 'block';
                });

            });

            // Cancel Edit

            const cancelEdit = document.querySelectorAll('[data-cancel-submit="' + el.getAttribute('data-edit') + '"]');
            cancelEdit.forEach((eli) => {
                eli.addEventListener('click', e => {
                    console.log('clicked')

                    document.querySelectorAll('[data-form-abbr="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                        element.setAttribute('disabled', '');
                    });
                    document.querySelectorAll('[data-form-key="' + el.getAttribute('data-edit') + '"]').forEach(element => {
                        element.setAttribute('disabled', '');
                    });

                    document.querySelectorAll('[data-submit="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.style.display = 'none';
                    });
                    console.log(document.querySelectorAll('[data-submit="' + eli.getAttribute('data-cancel-submit') + '"]'))

                    document.querySelectorAll('[data-cancel-submit="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.style.display = 'none';
                    });
                    document.querySelectorAll('[data-delete="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.style.display = 'none';
                    });
                    document.querySelectorAll('[data-key="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.setAttribute('disabled', '');
                    });

                    document.querySelectorAll('[data-abbr="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.setAttribute('disabled', '');
                    });


                    document.querySelectorAll('[data-translation="' + eli.getAttribute('data-cancel-submit') + '"]').forEach(element => {
                        element.setAttribute('disabled', '');
                    });

                })
            })


            // Submit and update Translations

            const submitTranslationUpdate = document.querySelectorAll('[data-submit="' + el.getAttribute('data-edit') + '"]');

            submitTranslationUpdate.forEach((updt) => {
                updt.addEventListener('click', e => {
                    updateForm.submit()
                })
            })


            // Delete Particular Translations
            const deleteTranslation = document.querySelectorAll('[data-delete="' + el.getAttribute('data-edit') + '"]');

            deleteTranslation.forEach((dlt1) => {
                dlt1.addEventListener('click', e => {
                    console.log('delete clicked')
                    console.log(document.querySelectorAll('[data-deleteinput="' + el.getAttribute('data-edit') + '"]'))
                    document.querySelectorAll('[data-deleteinput="' + el.getAttribute('data-edit') + '"]').forEach(dlt => {
                        dlt.removeAttribute('disabled');
                        console.log(dlt)

                    });

                    updateForm.submit()
                })
            })
        });
    })










</script>



{{-- Drag and Drop Functionality--}}
{{--<script src="{{asset('assets\js\myDragAndDrop.js')}}">--}}
<script>
    const draggables = document.querySelectorAll(".draggable-lang");
    const containers = document.querySelectorAll(".lang-container");

    // Ajax request
    function updatePosition() {
        const positionForm = document.getElementById('positionForm')
        const formData = new FormData(positionForm);
        fetch('{{ route('changePosition') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-Token': document.querySelector('meta[name="CSRF"]').content,
                },
                body: formData
            }
        )
            .then(response => response.json())
            .catch(error => console.error('Error:', error));
    }


    draggables.forEach((draggable) => {
        draggable.addEventListener("dragstart", () => {
            draggable.classList.add("dragging");
        });

        // UPDATE VALUES OF INPUTS and SEND AJAX
        draggable.addEventListener("dragend", () => {
            draggable.classList.remove("dragging");

            updateDataAttributes();
            updatePosition()
        });
    });

    containers.forEach((container) => {
        container.addEventListener("dragover", (e) => {
            e.preventDefault();
            const afterElement = getDragAfterElement(container, e.clientY);
            const draggable = document.querySelector(".dragging");
            if (afterElement == null) {
                container.appendChild(draggable);

            } else {
                container.insertBefore(draggable, afterElement);
            }
        });
    });

    function getDragAfterElement(container, y) {
        const draggableElements = [
            ...container.querySelectorAll(".draggable-lang:not(.dragging)"),
        ];

        return draggableElements.reduce(
            (closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return {offset: offset, element: child};
                } else {
                    return closest;
                }
            },
            {offset: Number.NEGATIVE_INFINITY}
        ).element;
    }

    function updateDataAttributes() {
        // Get all draggable elements
        const draggables = document.querySelectorAll(".position");
        // Loop through each draggable element
        draggables.forEach((draggable, index) => {
            // Update data-data attribute value
            draggable.value = index + 1;
        });
    }

</script>



<script>
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });

</script>

</body>
</html>
