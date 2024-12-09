<div   class="tab-pane fade  !border-0 chat-groups-tab hidden" id="groups-tab-pane"
      aria-labelledby="groups-item" role="tabpanel" tabindex="0">

    <div  class="hs-accordion-group mt-3 p-2">
        <div class="hs-accordion accordion-item  overflow-hidden !border-b-0" id="hs-basic-heading-custom-three">
            <button
                    class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group pb-0 pt-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                    aria-controls="hs-basic-collapse-custom-three" type="button">
                {{__('General')}}
            </button>
            <div id="hs-basic-collapse-custom-three"
                 class="hs-accordion-content  overflow-hidden  w-full hidden transition-[height] duration-300"
                 aria-labelledby="hs-basic-heading-custom-three">
                <div class="accordion-body">
                    <ul style="font-size: 0.8rem">

                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('For Top-Up click')}}  <svg style="display: inline" id="menusvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                    <path fill="#845ADF" d="M8 6a2 2 0 1 1-4 0a2 2 0 0 1 4 0m0 6a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4m8-14a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m4-10a2 2 0 1 0 0-4a2 2 0 0 0 0 4m2 4a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8a2 2 0 1 0 0-4a2 2 0 0 0 0 4"></path>
                                </svg> {{__('and then relevant text')}}
                            </p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere">
                            <p>
                               {{__('You can request a refund')}}
                            </p>
                        </li>
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <P> {{__('You can give instructions')}} </P>
                        </li>
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <P> {{__('Please note that the text you enter will be filtered by artificial intelligence')}}</P>
                        </li>
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <P> {{__('Generated photo/video')}}  </P>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hs-accordion accordion-item  overflow-hidden  !border-b-0" id="hs-basic-heading-custom-one">
            <button class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                    aria-controls="hs-basic-collapse-custom-one" type="button">
                Midjourney
            </button>
            <div id="hs-basic-collapse-custom-one"
                 class="hs-accordion-content w-full overflow-hidden hidden transition-[height] duration-300"
                 aria-labelledby="hs-basic-heading-custom-one">
                <div class="accordion-body">
                    <ul style="font-size: 0.8rem">
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            {{__('The estimated time for photo generation is 3 minutes')}}
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('Generates 4 different variations of photos per request')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere">
                            <p>{{__('If you liked any of the photos')}}
                                <svg class="badge bg-primary/10  text-primary"
                                     xmlns="http://www.w3.org/2000/svg"
                                     width="25" height="25" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M7 7h10v3l4-4l-4-4v3H5v6h2zm10 10H7v-3l-4 4l4 4v-3h12v-6h-2z"/>
                                </svg> {{__('By clicking on the button')}}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hs-accordion accordion-item !border-b-0" id="hs-basic-heading-custom-two">
            <button
                    class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group pb-0 pt-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                    aria-controls="hs-basic-collapse-custom-two" type="button">
                Flux Schnell
            </button>
            <div id="hs-basic-collapse-custom-two"
                 class="hs-accordion-content hidden overflow-hidden w-full transition-[height] duration-300"
                 aria-labelledby="hs-basic-heading-custom-two">
                <div class="accordion-body">
                    <ul style="font-size: 0.8rem">
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p> {{__('Estimated photo generation time is 5 seconds.')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('Generates one photo per request')}}</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="hs-accordion accordion-item !border-b-0" id="hs-basic-heading-custom-two2">
            <button
                    class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group pb-0 pt-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                    aria-controls="hs-basic-collapse-custom-two2" type="button">
                Remove BG
            </button>
            <div id="hs-basic-collapse-custom-two"
                 class="hs-accordion-content hidden overflow-hidden w-full transition-[height] duration-300"
                 aria-labelledby="hs-basic-heading-custom-two">
                <div class="accordion-body">
                    <ul style="font-size: 0.8rem">
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p> {{__('Estimated photo generation time is 5 seconds.')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('You can upload your own photo or choose from an existing gallery.')}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hs-accordion accordion-item !border-b-0" id="hs-basic-heading-custom-two3">
            <button
                    class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group pb-0 pt-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                    aria-controls="hs-basic-collapse-custom-three" type="button">
                Runway
            </button>
            <div id="hs-basic-collapse-custom-three"
                 class="hs-accordion-content  overflow-hidden  w-full hidden transition-[height] duration-300"
                 aria-labelledby="hs-basic-heading-custom-three">
                <div class="accordion-body">
                    <ul style="font-size: 0.8rem">
                        <li style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p> {{__('The estimated time for video generation is 2 minutes, you will receive an SMS notification when it is finished.')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('A conditional description is required when uploading a photo.')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('You can upload your own photo or choose from an existing gallery.')}}</p>
                        </li>
                        <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                            <p>{{__('Please note that the text you enter will be filtered by artificial intelligence')}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{--Calls--}}
{{--        <div class="tab-pane fade !border-0 chat-calls-tab hidden" id="calls-tab-pane" role="tabpanel"--}}
{{--             aria-labelledby="calls-item" tabindex="0">--}}
{{--            <ul class="list-none !mb-0 mt-2 chat-calls-tab">--}}
{{--                <li>--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="me-1 leading-none">--}}
{{--                                            <span class="avatar avatar-md online me-2 avatar-rounded">--}}
{{--                                                <img src="../assets/images/faces/5.jpg" alt="img">--}}
{{--                                            </span>--}}
{{--                        </div>--}}
{{--                        <div class="flex-grow my-auto">--}}
{{--                            <p class="mb-0 font-semibold">--}}
{{--                                Sujika--}}
{{--                                <span class="ms-1 incoming-call-success"><i--}}
{{--                                            class="ti ti-arrow-down-left"></i></span>--}}
{{--                            </p>--}}
{{--                            <p class="text-[0.75rem] !mb-0">--}}
{{--                                <span class="text-[#8c9097] dark:text-white/50 text-truncate">Today,12:47PM</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="">--}}
{{--                            <button aria-label="button" type="button"--}}
{{--                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-primary">--}}
{{--                                <i class="ti ti-phone"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="me-1 leading-none">--}}
{{--                                            <span class="avatar avatar-md online me-2 avatar-rounded">--}}
{{--                                                <img src="../assets/images/faces/7.jpg" alt="img">--}}
{{--                                            </span>--}}
{{--                        </div>--}}
{{--                        <div class="flex-grow my-auto">--}}
{{--                            <p class="mb-0 font-semibold">--}}
{{--                                Melissa--}}
{{--                                <span class="ms-1 outgoing-call-failed"><i--}}
{{--                                            class="ti ti-arrow-up-right"></i></span>--}}
{{--                            </p>--}}
{{--                            <p class="text-[0.75rem] mb-0">--}}
{{--                                <span class="text-[#8c9097] dark:text-white/50 text-truncate">Today,10:27AM</span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="">--}}
{{--                            <button aria-label="button" type="button"--}}
{{--                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-primary">--}}
{{--                                <i class="ti ti-phone"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </div>--}}