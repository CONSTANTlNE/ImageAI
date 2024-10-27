<div class="chat-info border dark:border-defaultborder/10">

    <nav class="flex border-b border-defaultborder dark:border-defaultborder/10" aria-label="Tabs"
         role="tablist">
        <a class="hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer border-e dark:border-defaultborder/10 text-defaulttextcolor py-2 px-4 flex-grow  text-sm font-medium text-center rounded-none active"
           id="users-item" data-hs-tab="#users-tab-pane" aria-controls="users-tab-pane">
            <i  class="ri-history-line me-1 align-middle inline-block cursor-pointer w-[1.875rem] h-[1.875rem] p-[0.4rem] rounded-full hs-tab-active:bg-primary/10 bg-light">
                       </i>
            AI
        </a>
        <a class="hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer border-e dark:border-defaultborder/10 text-defaulttextcolor py-2 px-4 text-sm flex-grow font-medium text-center  rounded-none "
           id="groups-item" data-hs-tab="#groups-tab-pane" aria-controls="groups-tab-pane">
            <i
                    class="ri-group-2-line me-1 align-middle inline-block w-[1.875rem] h-[1.875rem] p-[0.4rem] rounded-full hs-tab-active:bg-primary/10 bg-light"></i>Groups
        </a>
        <a class="hs-tab-active:border-b-2 hs-tab-active:border-b-primary hs-tab-active:bg-primary/10 hs-tab-active:text-primary cursor-pointer text-defaulttextcolor py-2 px-4 text-sm flex-grow font-medium text-center  rounded-none "
           id="calls-item" data-hs-tab="#calls-tab-pane" aria-controls="calls-tab-pane">
            <i class="ri-phone-line me-1 align-middle inline-block w-[1.875rem] h-[1.875rem] p-[0.4rem] rounded-full hs-tab-active:bg-primary/10 bg-light"></i>Calls
        </a>
    </nav>
    <div class="tab-content" id="myTabContent">
        {{--MODELS მოქმედება--}}
        <div class="tab-pane fade show  !border-0 chat-users-tab" id="users-tab-pane"
             aria-labelledby="users-item" role="tabpanel" tabindex="0">
            <ul class="list-none mb-0 mt-2 chat-users-tab" id="chat-msg-scroll">
                <li class="!pb-0 !pt-0">
                    <p class="text-[#8c9097] dark:text-white/50 text-[0.6875rem] font-semibold mb-2 opacity-[0.7]">
                        ACTIVE CHATS</p>
                </li>
                {{-- Midjourney--}}
                <li class="checkforactive">
                    <a  href="{{route('midjourney')}}" onclick="changeTheInfo(this,'Midjourney','5','ფასი - 0.25 ₾')" >
                        <div class="flex items-start">
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/midjourney.jpg')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="mb-0 font-semibold">
                                    MidJourney <span
                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>
                                </p>
                                <p class="text-[0.75rem] mb-0">
                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>
                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i
                                                class="ri-check-double-fill"></i></span>
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Runway--}}
                <li class="checkforactive">
                    <a  href="{{route('runway')}}" onclick="changeTheInfo(this,'Runway','5','ფასი - 1.50 ₾')" >
                        <div class="flex items-start">
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/runway.png')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="mb-0 font-semibold">
                                    Runway <span
                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>
                                </p>
                                <p class="text-[0.75rem] mb-0">
                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>
                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i
                                                class="ri-check-double-fill"></i></span>
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Flux shcnell--}}
                <li class="checkforactive">
                    <a  href="{{route('flux-schnell')}}" onclick="changeTheInfo(this,'Flux Schnell','5','ფასი - 0.03 ₾')">
                        <div class="flex items-start">
                            <div class="me-1 leading-none">
                                                <span class="avatar avatar-md online me-2 avatar-rounded">
                                                    <img src="{{asset('assets/images/schnell.webp')}}" alt="img">
                                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="mb-0 font-semibold">
                                    Flux Schnell <span
                                            class="ltr:float-right rtl:float-left text-[#8c9097] dark:text-white/50 font-normal text-[0.6875rem]">1:32PM</span>
                                </p>
                                <p class="text-[0.75rem] mb-0">
                                    <span class="chat-msg text-truncate">Need to go for lunch?</span>
                                    <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i
                                                class="ri-check-double-fill"></i></span>
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        {{--Chat Groups--}}
        <div class="tab-pane fade !border-0 chat-groups-tab hidden" id="groups-tab-pane"
             aria-labelledby="groups-item" role="tabpanel" tabindex="0">
            <ul class="list-none mb-0 mt-2">
                <li class="!pb-0">
                    <p class="text-[#8c9097] dark:text-white/50 text-[0.6875rem] font-semibold mb-1 opacity-[0.7]">
                        MY CHAT GROUPS</p>
                </li>
                <li>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mb-0">1) Family Together</p>
                            <p class="mb-0"><span class="badge bg-success/10 text-success">4
                                                    Online</span></p>
                        </div>
                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/2.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/8.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/2.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/10.jpg" alt="img">
                                            </span>
                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                               href="javascript:void(0);">
                                +19
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mb-0">2) Work Buddies </p>
                            <p class="mb-0"><span class="badge bg-secondary/10 text-secondary">32
                                                    Online</span></p>
                        </div>
                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/1.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/7.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/3.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/9.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/12.jpg" alt="img">
                                            </span>
                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                               href="javascript:void(0);">
                                +123
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mb-0">3) Friends Forever</p>
                            <p class="mb-0"><span class="badge bg-warning/10 text-warning">3
                                                    Online</span></p>
                        </div>
                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/4.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/8.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/13.jpg" alt="img">
                                            </span>
                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                               href="javascript:void(0);">
                                +15
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mb-0">4) Social Media Deals</p>
                            <p class="mb-0"><span class="badge bg-danger/10 text-danger">5
                                                    Online</span></p>
                        </div>
                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/1.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/7.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/14.jpg" alt="img">
                                            </span>
                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                               href="javascript:void(0);">
                                +28
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="mb-0">4) Apartment Group</p>
                            <p class="mb-0"><span class="badge bg-light text-dark">0 Online</span>
                            </p>
                        </div>
                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/5.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/6.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/12.jpg" alt="img">
                                            </span>
                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="../assets/images/faces/3.jpg" alt="img">
                                            </span>
                            <a class="avatar avatar-sm bg-primary text-white avatar-rounded"
                               href="javascript:void(0);">
                                +53
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
        {{--Calls--}}
        <div class="tab-pane fade !border-0 chat-calls-tab hidden" id="calls-tab-pane" role="tabpanel"
             aria-labelledby="calls-item" tabindex="0">
            <ul class="list-none !mb-0 mt-2 chat-calls-tab">
                <li>
                    <div class="flex items-center">
                        <div class="me-1 leading-none">
                                            <span class="avatar avatar-md online me-2 avatar-rounded">
                                                <img src="../assets/images/faces/5.jpg" alt="img">
                                            </span>
                        </div>
                        <div class="flex-grow my-auto">
                            <p class="mb-0 font-semibold">
                                Sujika
                                <span class="ms-1 incoming-call-success"><i
                                            class="ti ti-arrow-down-left"></i></span>
                            </p>
                            <p class="text-[0.75rem] !mb-0">
                                <span class="text-[#8c9097] dark:text-white/50 text-truncate">Today,12:47PM</span>
                            </p>
                        </div>
                        <div class="">
                            <button aria-label="button" type="button"
                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-primary">
                                <i class="ti ti-phone"></i>
                            </button>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <div class="me-1 leading-none">
                                            <span class="avatar avatar-md online me-2 avatar-rounded">
                                                <img src="../assets/images/faces/7.jpg" alt="img">
                                            </span>
                        </div>
                        <div class="flex-grow my-auto">
                            <p class="mb-0 font-semibold">
                                Melissa
                                <span class="ms-1 outgoing-call-failed"><i
                                            class="ti ti-arrow-up-right"></i></span>
                            </p>
                            <p class="text-[0.75rem] mb-0">
                                <span class="text-[#8c9097] dark:text-white/50 text-truncate">Today,10:27AM</span>
                            </p>
                        </div>
                        <div class="">
                            <button aria-label="button" type="button"
                                    class="ti-btn ti-btn-sm ti-btn-icon ti-btn-primary">
                                <i class="ti ti-phone"></i>
                            </button>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>