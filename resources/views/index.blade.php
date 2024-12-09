<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Travel, Tour and Hotel Booking HTML Template">
    <meta name="keywords" content="booking, travel, tour, hotel, bootstrap">
    <meta name="author" content="Asaduzzaman Sarker">
    <title>Zenith AI - AI Startup &amp; Technology HTML Template</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('landingassets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/ff-1.css')}}">
    <link rel="stylesheet" href="{{asset('landingassets/css/style.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('landingassets/css/particles.css')}}">--}}
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <style>


        .logo {
            height: 60px !important;
        }

        .downloadbtn {
            background: none;
            border-radius: 50px;
            padding: 5px 20px;
            border: none;
            font-weight: bold;
            /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);*/
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3) /* Stronger shadow */
            /*box-shadow: 0 8px 12px rgba(26, 29, 32, 0.15) !* Using your existing #1a1d20 color *!*/
        }

        .downloadBtnsContainer {
            display: none;
            justify-content: center;
            gap: 30px;
        }

        .detailsbtn{
            display: none!important;
        }

        @media only screen and (max-width: 375px) {
            .downloadBtnsContainer {
                display: flex;
                width: 100% !important;
                align-items: center;
               flex-direction: column;
            }
        }


        .jakarta{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .firago{
            font-family: FiraGO,serif!important;
        }


        .bg-dark-gradient {
            background: linear-gradient(135deg, #23272c 0%, #1c1f23 100%);

            width: 100%;
        }

        .dialog{
           border:none;
        }


    </style>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

</head>
<body>
{{--<div class="preloader">--}}
{{--    <div class="preloader__img"><img src="{{asset('landingassets/img/logo-light.png')}}" alt="image"></div>--}}
{{--</div>--}}

{{--@dd(app()->getLocale())--}}
<div class="bg-dark">
    @include('landingcomponents.navbar')
    @include('landingcomponents.heroSection')


    {{--install buttons--}}
{{--    @include('landingcomponents.installButtonsSection')--}}
    <!-- Midjourney Section -->
    @include('landingcomponents.midjourneySection')
    <!-- Flux-schnell Section -->
    @include('landingcomponents.fluxSection')
    <!-- Remove BG Section -->
    @include('landingcomponents.removeBGSection')
    <!-- Colorization -->
    @include('landingcomponents.colorizationSection')

    <!-- Runway Section -->
    @include('landingcomponents.runwaySection')
{{--    <button class="openModal">openModal</button>--}}
    {{--Pricing FAQ Footer--}}
    @include('landingcomponents.pricingSection')
    <!-- Scripts -->

</div>


<dialog class="dialog bg-dark-gradient rounded-5" style="width: 100%;height: 500px">

    <div style="display: flex;justify-content:space-around;margin-top:1rem">
        <button style="width:135px;padding-right: 15px;padding-left: 15px" type="button"
                class="cancel">{{__('Cancel')}}</button>
        <button style="width:135px;padding-right: 15px;padding-left: 15px"
                class="submit">{{__('Submit')}}</button>
    </div>
</dialog>

<script>
    const cancel = document.querySelector('.cancel');
    const openmodal = document.querySelector('.openModal')
    const modal = document.querySelector('.dialog')

    openmodal.addEventListener('click', () => {
        modal.showModal()
    })

    cancel.addEventListener('click', () => {
        modal.close()
    })

</script>

<script src="{{asset('landingassets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('landingassets/js/plugins.js')}}"></script>
<script src="{{asset('landingassets/js/app.js')}}"></script>
<script src="{{asset('landingassets/js/particles/particles.min.js')}}"></script>
<script src="{{asset('landingassets/js/particles/particles2.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<script>

    document.querySelectorAll(['data-swiper-autoplay'])


    const swiper = new Swiper('.swiper', {
        speed: 200,
        spaceBetween: 100,
        loop: true,
        autoplay: {
            delay: 2500, // 3000ms (3 seconds) delay between slides
            disableOnInteraction: false, // Keep autoplay running even after interaction
        },
    });



</script>

</script>

<script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
</script>


{{--SERVICE WORKER FOR PWA--}}
<script>


    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('{{asset('service-worker.js')}}')
                .then((registration) => {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch((error) => {
                    console.error('Service Worker registration failed:', error);
                });
        });
    }

</script>

{{--Install button for pwa--}}
<script>
    let deferredPrompt; // Variable to hold the event

    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the mini-info bar from appearing on mobile
        e.preventDefault();
        // Stash the event so it can be triggered later
        deferredPrompt = e;
        // Show the install button
        document.getElementById('install-button').style.display = 'block';
    });

    document.getElementById('install-button').addEventListener('click', (e) => {
        // Hide the button
        // document.getElementById('install-button').style.display = 'none';
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the install prompt');
            } else {
                console.log('User dismissed the install prompt');
            }
            deferredPrompt = null; // Clear the stored event
        });
    });
</script>


</body>
</html>