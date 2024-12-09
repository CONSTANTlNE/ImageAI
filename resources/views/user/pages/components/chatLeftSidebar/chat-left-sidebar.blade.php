<div id="chatinfo" class="chat-info custom-height border dark:border-defaultborder/10 ">

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
    <div   class="tab-content custom-height chat-content" id="myTabContent">
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
                {{-- Flux shcnell --}}
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
                {{-- Colorization --}}
                <li class="checkforactive">
                    <a  class="" href="{{route('colorize.index')}}" onclick="changeTheInfo(this,'Flux Schnell','5','ფასი - 0.03 ₾')">
                        <div class="flex items-start " >
                            <div class="me-1 leading-none">
                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                    <img src="{{asset('assets/images/colorization.png')}}" alt="img">
                                </span>
                            </div>
                            <div class="flex-grow ">
                                <p  class="mt-3 font-semibold">
                                    Colorize
                                    {{-- <span--}}
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
{{--                <li class="checkforactive">--}}
{{--                    <a class="" href="{{route('resize.index')}}" >--}}
{{--                        <div class="flex items-start " >--}}
{{--                            <div class="me-1 leading-none">--}}
{{--                                                <span class="avatar avatar-md online me-2 avatar-rounded">--}}
{{--                                                    <img style="object-fit: cover!important;" src="{{asset('assets/images/resize.jpg')}}" alt="img">--}}
{{--                                                </span>--}}
{{--                            </div>--}}
{{--                            <div class="flex-grow ">--}}
{{--                                <p  class="mt-3 font-semibold">--}}
{{--                                    Resize--}}
{{--                                    --}}{{--                                    <span--}}
{{--                                    --}}{{--                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>--}}
{{--                                </p>--}}
{{--                                --}}{{--                                <p class="text-[0.75rem] mb-0">--}}
{{--                                --}}{{--                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>--}}
{{--                                --}}{{--                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i--}}
{{--                                --}}{{--                                                class="ri-check-double-fill"></i></span>--}}
{{--                                --}}{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
        {{-- INSTRUCTIONS--}}
        @include('user.pages.components.chatLeftSidebar.instructions')

    </div>
</div>
