@php use Carbon\Carbon; @endphp
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
                                <img class="chatimageperson" src="{{asset('assets/images/midjourney.jpg')}}" alt="img">
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
                                                <div style="padding: 0!important;"
                                                     class="mb-0 flex flex-wrap  justify-center">
                                                    @foreach($image->media as $indexm =>$media)
                                                        <div style="padding: 0!important;">
                                                            <a style="min-width: 120px!important;min-height: 120px!important"
                                                               aria-label="anchor" href="{{$media->getUrl()}}"
                                                               class="avatar avatar-xl m-1 glightbox">
                                                                <img
                                                                        src="{{$media->getUrl()}}" alt=""
                                                                        class="rounded-md">
                                                            </a>
                                                            <div style="width: 100%;padding: 0!important"
                                                                 class="flex justify-around">
                                                                {{--delete Modal Button--}}
                                                                <a href="javascript:void(0);"
                                                                   onclick="document.getElementById('midjourneyID').value='{{$image->id}}';document.getElementById('mediaindex').value='{{$indexm}}'"
                                                                   data-hs-overlay="#staticBackdrop">
                                                                    <svg class="badge bg-primary/10  text-primary"
                                                                         xmlns="http://www.w3.org/2000/svg" width="35"
                                                                         height="35"
                                                                         viewBox="0 0 24 24">
                                                                        <path fill="currentColor"
                                                                              d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                                                    </svg>
                                                                </a>
                                                                {{--Download--}}
                                                                <form
                                                                        action="{{route('midjourney.download')}}">
                                                                    <input type="hidden" name="id"
                                                                           value="{{$image->id}}">
                                                                    <input type="hidden" name="index"
                                                                           value="{{$indexm}}">
                                                                    <button>
                                                                        <svg class="badge bg-primary/10  text-primary"
                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                             width="35"
                                                                             height="35" viewBox="0 0 24 24">
                                                                            <path fill="currentColor"
                                                                                  d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                                @php
                                                                    $time = Carbon::parse($image->created_at);
                                                                    $true = $time->addHour()->isPast()
                                                                @endphp
                                                                {{--Variation and others--}}
                                                                @if(!$true)
                                                                    <a href="javascript:void(0);"
                                                                       onclick="document.getElementById('midjourneyID2').value='{{$image->id}}';document.getElementById('mediaindex2').value='{{$media['collection_name']}}'"
                                                                       data-hs-overlay="#variation">
                                                                        <svg class="badge bg-primary/10  text-primary"
                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                             width="35" height="35" viewBox="0 0 24 24">
                                                                            <path fill="currentColor"
                                                                                  d="M7 7h10v3l4-4l-4-4v3H5v6h2zm10 10H7v-3l-4 4l4 4v-3h12v-6h-2z"/>
                                                                        </svg>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- PROMPT FIELD--}}
                <form class="chat-footer" action="{{route('midjourney.create')}}" method="post">
                    @csrf
                    <input name="prompt" class="form-control w-full !rounded-md" placeholder="Type your message here..."
                           type="text">
                    <button id="fetch-prompt2" aria-label="anchor"
                            class="ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send startSpinner">
                        <i class="ri-send-plane-2-line"></i>
                    </button>
                </form>
            </div>
            {{--Right sidebar  --}}
            <div class="chat-user-details border dark:border-defaultborder/10" id="chat-user-details">
                <div class="hideX">
                    <button aria-label="button" type="button"
                            class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2 responsive-chat-close2"><i
                                class="ri-close-line"></i>
                    </button>
                </div>
                <div style="margin-left: 10px" class="mb-0 mt-3">
                    <div class="font-semibold mb-4 text-defaultsize dark:text-defaulttextcolor/70">
                        Gallery (last
                        <span class="badge bg-primary/10 !rounded-full text-primary ">30</span>
                        images)
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
                            <a href="{{route('gallery',['model'=>'midjourney'])}}" class="text-primary underline">
                                <u>View All</u>
                            </a>
                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($midjourneys as $midjourney)
                            @foreach($midjourney->media as $mediaindex => $media)
                                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                                    <a aria-label="anchor" href="{{$media->getUrl()}}" class="chat-media glightbox">
                                        <img style="width: 100%!important;object-fit: cover" src="{{$media->getUrl()}}"
                                             alt="">
                                    </a>
                                    <div class="flex justify-around">

                                        {{--delete Modal Button--}}
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('midjourneyID').value='{{$midjourney->id}}';document.getElementById('mediaindex').value='{{$mediaindex}}'"
                                           data-hs-overlay="#staticBackdrop">
                                            <svg class="badge bg-primary/10  text-primary"
                                                 xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                            </svg>
                                        </a>

                                        <form class="mb-2" action="{{route('midjourney.download')}}">
                                            <input type="hidden" name="id" value="{{$midjourney->id}}">
                                            <input type="hidden" name="index" value="{{$mediaindex}}">
                                            <button>
                                                <svg class="badge bg-primary/10  text-primary"
                                                     xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                     viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                          d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Delete Modal--}}
    <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static] ">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center" >
            <div class="ti-modal-content w-full">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">Delete Image</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#staticBackdrop">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <p>
                        Are you sure you want to delete this image?
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <button type="button"
                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                            data-hs-overlay="#staticBackdrop">
                        Close
                    </button>

                    <form class="" action="{{route('midjourney.delete')}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="id" id="midjourneyID" value="">
                        <input type="hidden" name="index" id="mediaindex" value="">

                        <button class="ti-btn bg-primary text-white !font-medium">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{--Variation Modal--}}
    <div id="variation" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="ti-modal-content w-full">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">VARIATION</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#variation">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <p>
                        Are you sure you want to delete this image?
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <button type="button"
                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                            data-hs-overlay="#variation">
                        Close
                    </button>

                    <form class="" action="{{route('midjourney.variation')}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="id" id="midjourneyID2" value="">
                        <input type="hidden" name="index" id="mediaindex2" value="">
                        <button class="ti-btn bg-primary text-white !font-medium">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection