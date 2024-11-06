<div class="chat-info custom-height border dark:border-defaultborder/10">

    <nav class="flex border-b border-defaultborder dark:border-defaultborder/10" aria-label="Tabs"
         role="tablist">
        <a class="flex justify-center hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer border-e dark:border-defaultborder/10 text-defaulttextcolor py-2 px-4 flex-grow  text-sm font-medium text-center rounded-none active"
           id="users-item" data-hs-tab="#users-tab-pane" aria-controls="users-tab-pane">
            <svg class="rounded-full hs-tab-active:bg-primary/10 bg-light" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M21 11V9h-2V7a2.006 2.006 0 0 0-2-2h-2V3h-2v2h-2V3H9v2H7a2.006 2.006 0 0 0-2 2v2H3v2h2v2H3v2h2v2a2.006 2.006 0 0 0 2 2h2v2h2v-2h2v2h2v-2h2a2.006 2.006 0 0 0 2-2v-2h2v-2h-2v-2Zm-4 6H7V7h10Z"/><path fill="currentColor" d="M11.361 8h-1.345l-2.01 8h1.027l.464-1.875h2.316L12.265 16h1.062Zm-1.729 5.324L10.65 8.95h.046l.983 4.374ZM14.244 8h1v8h-1z"/></svg>
        </a>
        <a class="flex justify-center hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer border-e dark:border-defaultborder/10 text-defaulttextcolor py-2 px-4 text-sm flex-grow font-medium text-center  rounded-none "
           id="groups-item" data-hs-tab="#groups-tab-pane" aria-controls="groups-tab-pane">
            <svg class="rounded-full hs-tab-active:bg-primary/10 bg-light" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16m-1-5h2v2h-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1a1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355"/></svg>
        </a>
{{--        <a class="hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer text-defaulttextcolor py-2 px-4 text-sm flex-grow font-medium text-center  rounded-none "--}}
{{--           id="calls-item" data-hs-tab="#calls-tab-pane" aria-controls="calls-tab-pane">--}}
{{--            <i class="ri-phone-line me-1 align-middle inline-block w-[1.875rem] h-[1.875rem] p-[0.4rem] rounded-full hs-tab-active:bg-primary/10 bg-light"></i>Calls--}}
{{--        </a>--}}
    </nav>
    <div  class="tab-content custom-height" id="myTabContent">
        {{--MODELS მოქმედება--}}
        <div  class="tab-pane fade show  !border-0 chat-users-tab" id="users-tab-pane"
             aria-labelledby="users-item" role="tabpanel" tabindex="0">
            <ul class="list-none mb-0 mt-2 chat-users-tab" id="chat-msg-scroll">
                <li class="!pb-0 !pt-0">
{{--                    <p class="text-[#8c9097] dark:text-white/50 text-[0.6875rem] font-semibold mb-2 opacity-[0.7]">--}}
{{--                        ACTIVE CHATS</p>--}}
                </li>
                {{-- Midjourney--}}
                <li class="checkforactive">
                    <a  class=""  href="{{route('midjourney')}}" onclick="changeTheInfo(this,'Midjourney','5','ფასი - 0.25 ₾')" >
                        <div class="flex items-start">
                            <div class="me-1 leading-none">
                                                <span  class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/midjourney.jpg')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="mt-3 font-semibold">
                                    MidJourney
{{--                                    <span--}}
{{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
                                </p>
{{--                                <p class="text-[0.75rem] mb-0">--}}
{{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
{{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
{{--                                                class="ri-check-double-fill"></i></span>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Runway--}}
                <li class="checkforactive">
                    <a  class="" href="{{route('runway')}}" onclick="changeTheInfo(this,'Runway','5','ფასი - 1.50 ₾')" >
                        <div class="flex items-start">
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/runway.png')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="mt-3 font-semibold">
                                    Runway
{{--                                    <span--}}
{{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
                                </p>
{{--                                <p class="text-[0.75rem] mb-0">--}}
{{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
{{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
{{--                                                class="ri-check-double-fill"></i></span>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Flux shcnell--}}
                <li class="checkforactive">
                    <a  class="" href="{{route('flux-schnell','chat-open')}}" onclick="changeTheInfo(this,'Flux Schnell','5','ფასი - 0.03 ₾')">
                        <div class="flex items-start " >
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/schnell.webp')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow ">
                                <p  class="mt-3 font-semibold">
                                    Flux Schnell
{{--                                    <span--}}
{{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
                                </p>
{{--                                <p class="text-[0.75rem] mb-0">--}}
{{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
{{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
{{--                                                class="ri-check-double-fill"></i></span>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Remove Bg--}}
                <li class="checkforactive">
                    <a class="" href="{{route('bg.remove')}}" >
                        <div class="flex items-start " >
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/removebg.webp')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow ">
                                <p  class="mt-3 font-semibold">
                                    Remove BG
                                    {{--                                    <span--}}
                                    {{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
                                </p>
                                {{--                                <p class="text-[0.75rem] mb-0">--}}
                                {{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
                                {{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
                                {{--                                                class="ri-check-double-fill"></i></span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Resize--}}
                <li class="checkforactive">
                    <a class="" href="{{route('resize.index')}}" >
                        <div class="flex items-start " >
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img style="object-fit: cover!important;" src="{{asset('assets/images/resize.jpg')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow ">
                                <p  class="mt-3 font-semibold">
                                    Resize
                                    {{--                                    <span--}}
                                    {{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
                                </p>
                                {{--                                <p class="text-[0.75rem] mb-0">--}}
                                {{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
                                {{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
                                {{--                                                class="ri-check-double-fill"></i></span>--}}
                                {{--                                </p>--}}
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        {{-- INSTRUCTIONS--}}
        <div  class="tab-pane fade custom-height !border-0 chat-groups-tab hidden" id="groups-tab-pane"
             aria-labelledby="groups-item" role="tabpanel" tabindex="0">

            <div  class="hs-accordion-group mt-3 p-2">
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
                                   ფოტოს გენერაციის სავარაუდო დროა 2 წუთი, დასრულებისას მიიღებთ სმს-შეტყობინებას
                                </li>
                                <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere;">
                                    <p>ერთ მოთხოვნაზე აგენერირებს 4 სხვადასხვა ვარიაციის ფოტოს</p>
                                </li>
                                <li  style="padding-left: 0;text-align: justify;word-break: break-word;overflow-wrap: anywhere">
                                    <p>თუ მოგეწონათ რომელიმე ფოტო
                                        <svg class="badge bg-primary/10  text-primary"
                                             xmlns="http://www.w3.org/2000/svg"
                                             width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M7 7h10v3l4-4l-4-4v3H5v6h2zm10 10H7v-3l-4 4l4 4v-3h12v-6h-2z"/>
                                        </svg> ღილაკზე დაკლიკებით ხელოვნური ინტელექტი შემოგთავაზებთ ამ კონკრეტული ფოტოს სხვადასხვა ვარიანტს (აღნიშნული ფუნქციონალი მოქმედებს ძირითადი ფოტოს გენერაციიდან 1 საათის განმავლობაში)
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
                            <strong>This is the second item's accordion body.</strong> It is shown by
                            default, until the collapse plugin adds the appropriate classes that we
                            use
                            to
                            style each element. These classes control the overall appearance, as
                            well as
                            the
                            showing and hiding via CSS transitions. You can modify any of this with
                            custom
                            CSS or overriding our default variables. It's also worth noting that
                            just
                            about
                            any HTML can go within the <code>.accordion-body</code>, though the
                            transition
                            does limit overflow.
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
                            <strong>This is the second item's accordion body.</strong> It is shown by
                            default, until the collapse plugin adds the appropriate classes that we
                            use
                            to
                            style each element. These classes control the overall appearance, as
                            well as
                            the
                            showing and hiding via CSS transitions. You can modify any of this with
                            custom
                            CSS or overriding our default variables. It's also worth noting that
                            just
                            about
                            any HTML can go within the <code>.accordion-body</code>, though the
                            transition
                            does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="hs-accordion accordion-item  overflow-hidden !border-b-0" id="hs-basic-heading-custom-three">
                    <button
                            class="hs-accordion-toggle accordion-button hs-accordion-active:text-primary hs-accordion-active:pb-3 group pb-0 pt-3 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-primary dark:text-gray-200 dark:hover:text-white/80"
                            aria-controls="hs-basic-collapse-custom-three" type="button">
                        Runway
                    </button>
                    <div id="hs-basic-collapse-custom-three"
                         class="hs-accordion-content  overflow-hidden  w-full hidden transition-[height] duration-300"
                         aria-labelledby="hs-basic-heading-custom-three">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is shown by
                            default, until the collapse plugin adds the appropriate classes that we
                            use
                            to
                            style each element. These classes control the overall appearance, as
                            well as
                            the
                            showing and hiding via CSS transitions. You can modify any of this with
                            custom
                            CSS or overriding our default variables. It's also worth noting that
                            just
                            about
                            any HTML can go within the <code>.accordion-body</code>, though the
                            transition
                            does limit overflow.
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
    </div>
</div>