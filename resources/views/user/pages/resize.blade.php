@extends('user.pages.layout')



@section('resize')
    <div class="main-content">
        <div class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
            {{--            Left Sidebar--}}

            @include('user.pages.components.chat-left-sidebar')

            {{--Main Chat--}}
            <div id="main-chat" class="main-chat-area border dark:border-defaultborder/10">
                <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                    <div class="flex items-center leading-none">
                            <span class="avatar avatar-lg online me-4 avatar-rounded chatstatusperson">
                                <img class="chatimageperson" src="{{asset('assets/images/runway.png')}}" alt="img">
                            </span>
                        <div class="flex-grow">
                            <p class="mb-1 font-semibold text-[.875rem]">
                                <a href="javascript:void(0);"
                                   class="chatnameperson responsive-userinfo-open !text-defaulttextcolor dark:text-defaulttextcolor/70">
                                    Runway
                                </a>
                            </p>
                            <p class="text-[#8c9097] mb-1 dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                5წმ - 1.50 ₾
                            </p>
                            <p class="text-[#8c9097] dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                10წმ - 3.00 ₾
                            </p>
                        </div>
                        <div class="flex ms-auto">

                            <button aria-label="button" type="button"
                                    class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold responsive-userinfo-open">
                                <i class="ti ti-user-circle" id="responsive-chat-close"></i>
                            </button>

                            {{-- Dropdown on main chat--}}
                            <div class="hs-dropdown ti-dropdown">
                                <a aria-label="anchor" href="javascript:void(0);"
                                   class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold"
                                   aria-expanded="false">
                                    <i class="fe fe-more-vertical text-[0.8rem]"></i>
                                </a>
                                <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                    <li>
                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="javascript:void(0);">Profile</a></li>
                                    <li>
                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="javascript:void(0);">Clear Chat</a></li>
                                    <li>
                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="javascript:void(0);">Delete User</a></li>
                                    <li>
                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="javascript:void(0);">Block User</a></li>
                                    <li>
                                        <a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block"
                                           href="javascript:void(0);">Report</a></li>
                                </ul>
                            </div>
                            <button aria-label="button" type="button"
                                    class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold responsive-chat-close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>


                </div>
                <div class="chat-content" id="main-chat-contentt">
                    <ul id="chat-target" class="list-none">
                        <li style="margin-bottom: 15px" class="chat-day-label">
                            <span>Today</span>
                        </li>
                        @foreach($runway as $itemindex => $item)
                            {{-- PROMPT--}}
                            <li style="margin-bottom:8px " class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner">
                                    <div class="ms-3">
                                        <span class="chatting-user-info chatnameperson">
                                            <span class="msg-sent-time">{{$item->created_at}}</span>
                                        </span>
                                        <div class="main-chat-msg">
                                            <div>
                                                <p class="mb-0">{{$item->prompt}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- Answer--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner w-full">

                                    <div class="ms-3 w-full">
                                        <div class="main-chat-msg text-center w-full">
                                            <div style="width: 100%!important;">
                                                {{--<p class="mb-0 flex flex-wrap  justify-center">--}}
                                                @foreach($item->media as $media)
                                                    <a style="position:relative"
                                                       onclick=
                                                               "
                                                               document.getElementById('video-container{{$itemindex}}').src = '{{$item->video_url}}'
                                                               document.getElementById('mediaid{{$itemindex}}').style.display='none'
                                                               document.getElementById('video-container{{$itemindex}}').style.display='block'
                                                               "
                                                       id="mediaid{{$itemindex}}"
                                                       aria-label="anchor"
                                                       href="javascript:void(0);"
                                                       class="avatar avatar-xl m-1 ai-image">
                                                        <img style="object-fit: cover"
                                                             src="{{$media->getUrl()}}" alt=""
                                                             class="rounded-md">
                                                        <svg style="position:absolute;top:50%;left:50%;transform: translate(-50%,-50%);color:#845ADF"
                                                             xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                             viewBox="0 0 16 16">
                                                            <path fill="currentColor"
                                                                  d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0m4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215"/>
                                                        </svg>
                                                    </a>
                                                    <video id="video-container{{$itemindex}}"
                                                           controls autoplay
                                                           style="width: 100%; height: 100%;display: none">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endforeach
                                                {{--</p>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <form action="{{route('runway.queue')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div style="height: 10rem!important;align-items: flex-end" class="chat-footer mb-3">
                        <input class="form-control  !rounded-md" name="prompt"
                               placeholder="Type your message here..."
                               type="text">

                        <button id="fetch-prompt2" aria-label="anchor"
                                class="ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send startSpinner">
                            <i class="ri-send-plane-2-line"></i>
                        </button>
                    </div>
                    {{--Upload PHOTO or Choose From Gallery--}}
                    <div style="position: absolute; bottom:110px;padding: 0;" class="flex justify-center w-full gap-5">
                        {{--Upload PHOTO--}}
                        <div class="text-center">
                            <button id="runwayBtn" type="button"
                                    class="ti-btn ti-btn-primary-full !rounded-full ti-btn-wave">ატვირთე ახალი
                            </button>
                            <div style="color:#845ADF" id="runwayPhotoName"></div>
                        </div>
                        <input id="runwayFile" name="runwayUpload" type="file" accept="image/jpeg,image/png,image/jpg"
                               style="display: none">
                        {{--Choose From Gallery--}}
                        <div class="text-center">
                            {{--Models Modal--}}
                            <a id="choosefromgallery" href="javascript:void(0);"
                               class="ti-btn ti-btn-primary-full !rounded-full ti-btn-wave"
                               data-hs-overlay="#staticBackdrop">
                                აირჩიეთ არსებული
                            </a>
                            <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                    <div class="ti-modal-content">
                                        <div class="ti-modal-header">
                                            <h6 class="modal-title text-[1rem] font-semibold">Modal title</h6>
                                            <button type="button"
                                                    class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                    data-hs-overlay="#staticBackdrop">
                                                <span class="sr-only">Close</span>
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </div>
                                        <div class="ti-modal-body px-4">
                                            <div class="container-fluid">
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="">
                                                        <a hx-get="{{route('runway.gallery.htmx')}}"
                                                           hx-target="#galleryTarget" hx-vals='{"model": "flux"}'
                                                           data-hs-overlay="#staticBackdrop2" href="javascript:void(0);"
                                                           class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                                            <div>
                                                                <img src="https://imageai.test/assets/images/schnell.webp"
                                                                     alt="figma"
                                                                     style="height: 110px!important;object-fit: cover"
                                                                     class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                                                <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                                                    Flux Schnell
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <a hx-get="{{route('runway.gallery.htmx')}}"
                                                           hx-target="#galleryTarget" hx-vals='{"model": "midjourney"}'
                                                           data-hs-overlay="#staticBackdrop2" href="javascript:void(0);"
                                                           class="p-4 items-center related-app block text-center rounded-sm hover:bg-gray-50 dark:hover:bg-black/20">
                                                            <img src="https://imageai.test/assets/images/midjourney.jpg"
                                                                 style="height: 110px!important;object-fit: cover"
                                                                 class="!w-full text-2xl avatar text-primary flex justify-center items-center mx-auto">
                                                            <div class="text-[0.75rem] text-defaulttextcolor dark:text-[#8c9097] dark:text-white/50">
                                                                Midjourney
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="ti-modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--gallery modal Modal and htmx--}}
                            <div id="staticBackdrop2" class="hs-overlay ti-modal hidden">
                                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
                                    <div class="max-h-full overflow-hidden ti-modal-content">
                                        <div class="ti-modal-header">
                                            <h6 class="modal-title text-[1rem] font-semiboldmodal-title"
                                                id="staticBackdropLabel3">Modal title
                                            </h6>
                                            <button id="closeGallery" type="button"
                                                    class="hs-dropdown-toggle ti-modal-close-btn"
                                                    data-hs-overlay="#staticBackdrop2">
                                                <span class="sr-only">Close</span>
                                                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                          fill="currentColor"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <div id="galleryTarget" class="ti-modal-body overflow-y-auto">


                                        </div>
                                        <div class="ti-modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="imageUrl" id="imageUrl">
                            <div style="color:#845ADF" id="runwayPhotoName2"></div>
                        </div>
                    </div>
                    {{-- RATIO AND DURATION--}}
                    <div style="position: absolute; bottom:65px;padding: 0;" class="flex justify-center w-full gap-5">
                        <div class="text-center flex justify-center gap-2 w-full px-3">
                            <select style="max-width: 160px;padding: 3px!important" name="ratio"
                                    class="ti-form-select rounded-sm  !px-2">
                                <option value="16:9" selected>ორიენტაცია</option>
                                <option value="16:9">ლანდშაფტი (16:9)</option>
                                <option value="9:16">პორტრეტი (9:16)</option>
                            </select>
                            <select style="max-width: 160px; padding: 3px!important" name="duration"
                                    class="ti-form-select rounded-sm  !px-2">
                                <option value="5" selected>ხანგრძლივობა</option>
                                <option value="5">5 წამი</option>
                                <option value="10">10 წამი</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div id="target"></div>
            </div>

            {{--Right sidebar--}}
            <div class="chat-user-details border dark:border-defaultborder/10" id="chat-user-details">
                <div class="hideX">
                    <button aria-label="button" type="button"
                            class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2 responsive-chat-close2"><i
                                class="ri-close-line"></i>
                    </button>
                </div>
                <div class="mb-0 mt-3">
                    <div class="font-semibold mb-4 text-defaultsize dark:text-defaulttextcolor/70">
                        Gallery (last
                        <span class="badge bg-primary/10 !rounded-full text-primary ">30</span>
                        videos)
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
                            <a href="javascript:void(0);" class="text-primary underline">
                                <u>
                                    <a href="{{route('gallery',['model'=>'runway'])}}">View All</a>
                                </u>
                            </a>
                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($runway2 as $item2)
                            @if($loop->iteration  < 20)
                                @foreach($item2->media as $media2)
                                    <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                                        <a  style="position: relative" aria-label="anchor" href="javascript:void(0);"
                                            data-hs-overlay="#hs-extralarge-modal"
                                            onclick="document.getElementById('modalvideo').src='{{$item2->video_url}}'
                                            document.getElementById('videoprompt').innerHTML = '{{$item2->prompt}}'
                                            "
                                           class="chat-media ">
                                            <img style="object-fit: cover" src="{{$media2->getUrl()}}" alt="">
                                            <svg style="position:absolute;top:50%;left:50%;transform: translate(-50%,-50%);color:#845ADF"
                                                 xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                 viewBox="0 0 16 16">
                                                <path fill="currentColor"
                                                      d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0m4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215"/>
                                            </svg>
                                        </a>

                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    VIDEO MODAL--}}
    <div id="hs-extralarge-modal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 id="videoprompt" class="ti-modal-title">
                        Modal title
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#hs-extralarge-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor" />
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body">
                    <video id="modalvideo"
                           controls autoplay
                           style="width: 100%; height: 100%">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection