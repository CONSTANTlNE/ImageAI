@extends('user.pages.layout')



@section('midjourney')
    <div class="main-content">
        <div class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
            {{--Left Sidebar--}}
            @include('user.pages.components.chat-left-sidebar')
            {{--Main Chat--}}
            <div class="main-chat-area border dark:border-defaultborder/10">
                <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                    <div class="flex items-center leading-none">
                            <span class="avatar avatar-lg online me-4 avatar-rounded chatstatusperson">
                                <img class="chatimageperson" src="../assets/images/faces/2.jpg" alt="img">
                            </span>
                        <div class="flex-grow">
                            <p class="mb-1 font-semibold text-[.875rem]">
                                <a href="javascript:void(0);"
                                   class="chatnameperson responsive-userinfo-open !text-defaulttextcolor dark:text-defaulttextcolor/70">
                                    Midjourney
                                </a>
                            </p>
                            <p class="text-[#8c9097] dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                ფასი - 0.25 ₾
                            </p>
                        </div>
                    </div>
                    <div class="flex ms-auto">
                        <button aria-label="button" type="button"
                                class="ti-btn ti-btn-icon ti-btn-outline-light dark:border-defaultborder/10 !text-[0.95rem] !ms-2 font-semibold">
                            <i class="ti ti-phone dark:text-defaulttextcolor/70"></i>
                        </button>
                        <button aria-label="button" type="button"
                                class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold">
                            <i class="ti ti-video dark:text-defaulttextcolor/70"></i>
                        </button>
                        <button aria-label="button" type="button"
                                class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold responsive-userinfo-open">
                            <i class="ti ti-user-circle" id="responsive-chat-close"></i>
                        </button>
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
                <div class="chat-content" id="main-chat-content">
                    <ul class="list-none">
                        <li class="chat-day-label">
                            <span>Today</span>
                        </li>
                        @foreach($images as $image)
                            {{-- PROMPT--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner">
                                    <div class="ms-3">
                                        <span class="chatting-user-info chatnameperson">
                                            <span class="msg-sent-time">{{$image->created_at}}</span>
                                        </span>
                                        <div class="main-chat-msg">
                                            <div>
                                                <p class="mb-0">{{$image->user_prompt_en}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- Answer--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner">

                                    <div class="ms-3">
                                        {{--                                    <span class="chatting-user-info">--}}
                                        {{--                                        <span class="chatnameperson">Sujika</span>--}}
                                        {{--                                        <span class="msg-sent-time">11:55PM</span> --}}
                                        {{--                                    </span>--}}
                                        <div class="main-chat-msg text-center">
                                            {{--                                        <div style="width: 100%">--}}
                                            {{--                                            <p class="mb-0">Here are some of them have a look</p>--}}
                                            {{--                                        </div>--}}
                                            <div>
                                                <p class="mb-0 flex flex-wrap  justify-center">
                                                    @foreach($image->media as $media)
                                                        <a style="min-width: 120px!important;min-height: 120px!important"
                                                           aria-label="anchor" href="{{$media->getUrl()}}"
                                                           class="avatar avatar-xl m-1 glightbox">
                                                            <img
                                                                    src="{{$media->getUrl()}}" alt=""
                                                                    class="rounded-md">
                                                        </a>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <form class="chat-footer" action="{{route('midjourney.create')}}" method="post">
                    @csrf
                    <input name="prompt" class="form-control w-full !rounded-md" placeholder="Type your message here..."
                           type="text">
                    {{--                    <a aria-label="anchor" class="ti-btn ti-btn-icon !mx-2 ti-btn-success" href="javascript:void(0)">--}}
                    {{--                        <i class="ri-emotion-line"></i>--}}
                    <button id="fetch-prompt2"  aria-label="anchor"
                            {{--                    </a>--}}
                            class="ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send startSpinner">
                        <i class="ri-send-plane-2-line"></i>
                    </button>
                </form>
            </div>
            {{--Right sidebar  --}}
            <div class="chat-user-details border dark:border-defaultborder/10" id="chat-user-details">
                <button aria-label="button" type="button"
                        class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2 responsive-chat-close2"><i
                            class="ri-close-line"></i></button>
                <div class="text-center mb-[3rem]">
                        <span class="avatar avatar-rounded online avatar-xxl me-2 mb-4 chatstatusperson">
                            <img class="chatimageperson" src="../assets/images/faces/2.jpg" alt="img">
                        </span>
                    <p class="mb-1 text-[0.9375rem] font-semibold text-defaulttextcolor dark:text-defaulttextcolor/70 leading-none chatnameperson ">
                        MidJourney
                    </p>
                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 !mb-4"><span class="chatnameperson">emaileyjackson2134</span>@gmail.com
                    </p>
                    <p class="text-center mb-0">
                        <button type="button" aria-label="button"
                                class="ti-btn ti-btn-icon !rounded-full ti-btn-primary"><i
                                    class="ri-phone-line"></i></button>
                        <button type="button" aria-label="button"
                                class="ti-btn ti-btn-icon !rounded-full ti-btn-primary !ms-2"><i
                                    class="ri-video-add-line"></i></button>
                        <button type="button" aria-label="button"
                                class="ti-btn ti-btn-icon !rounded-full ti-btn-primary !ms-2"><i
                                    class="ri-chat-1-line"></i></button>
                    </p>
                </div>

                <div style="margin-left: 10px" class="mb-0">
                    <div class="font-semibold mb-4 text-defaultsize dark:text-defaulttextcolor/70">Photos &amp; Media
                        <span class="badge bg-primary/10 !rounded-full text-primary ms-1">22</span>
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
                            <a href="{{route('gallery',['model'=>'midjourney'])}}" class="text-primary underline">
                                <u>View All</u>
                            </a>
                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($midjourneys as $midjourney)
                            @foreach($midjourney->media as $media)
                            <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                                    <a aria-label="anchor" href="{{$media->getUrl()}}" class="chat-media glightbox">
                                        <img src="{{$media->getUrl()}}" alt="">
                                    </a>
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection