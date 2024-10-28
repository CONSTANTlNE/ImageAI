@extends('user.pages.layout')



@section('fluxshnell')
    <div class="main-content">
        <div class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
            {{--            Left Sidebar--}}

            @include('user.pages.components.chat-left-sidebar')

            {{--            Main Chat--}}
            <div id="main-chat" class="main-chat-area border dark:border-defaultborder/10">
                <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                    <div class="flex items-center leading-none">
                            <span class="avatar avatar-lg online me-4 avatar-rounded chatstatusperson">
                                <img class="chatimageperson" src="{{asset('assets/images/schnell.webp')}}" alt="img">
                            </span>
                        <div class="flex-grow">
                            <p class="mb-1 font-semibold text-[.875rem]">
                                <a href="javascript:void(0);"
                                   class="chatnameperson responsive-userinfo-open !text-defaulttextcolor dark:text-defaulttextcolor/70">
                                    FluxSchnell
                                </a>
                            </p>
                            <p class="text-[#8c9097] dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                ფასი - 0.03 ₾
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
                <div class="chat-content" id="main-chat-contentt">
                    <ul id="chat-target" class="list-none">
                        <li class="chat-day-label">
                            <span>Today</span>
                        </li>
                        @foreach($flux as $item)
                            {{-- PROMPT--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner">
                                    <div class="ms-3">
                                        <span class="chatting-user-info chatnameperson">
                                            <span class="msg-sent-time">{{$item->created_at}}</span>
                                        </span>
                                        <div class="main-chat-msg">
                                            <div>
                                                <p class="mb-0">{{$item->prompt_en}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- Answer--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner w-full">

                                    <div class="ms-3 w-full">
                                        {{--                                    <span class="chatting-user-info">--}}
                                        {{--                                        <span class="chatnameperson">Sujika</span>--}}
                                        {{--                                        <span class="msg-sent-time">11:55PM</span> --}}
                                        {{--                                    </span>--}}
                                        <div class="main-chat-msg text-center w-full">
                                            {{--                                        <div style="width: 100%">--}}
                                            {{--                                            <p class="mb-0">Here are some of them have a look</p>--}}
                                            {{--                                        </div>--}}
                                            <div style="width: 100%!important;">
                                                <p class="mb-0 flex flex-wrap  justify-center">
                                                    @foreach($item->media as $media)
                                                        <a style=""
                                                           aria-label="anchor" href="{{$media->getUrl()}}"
                                                           class="avatar avatar-xl m-1 glightbox ai-image">
                                                            <img
                                                                    style="object-fit: cover"
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
                <form style="height: 8rem!important;align-items: flex-end" class="chat-footer" action="{{route('flux-schnell.prompt')}}"
                      hx-post="{{route('flux-schnell.prompt')}}" hx-target="#target">
                    @csrf
                    <input class="mb-3 form-control w-full !rounded-md" name="prompt" placeholder="Type your message here..."
                           type="text">
                    {{--                        <a aria-label="anchor" class="ti-btn ti-btn-icon !mx-2 ti-btn-success"--}}
                    {{--                           href="javascript:void(0)">--}}
                    {{--                            <i class="ri-emotion-line"></i>--}}
                    {{--                        </a>--}}
                    <button style="margin-bottom: 12px" id="fetch-prompt2" aria-label="anchor"
                            class="f ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send">
                        <i class="ri-send-plane-2-line"></i>
                    </button>
                    <div  style="position: absolute; bottom:65px;padding: 0;" class="flex justify-center w-full gap-5">
                        <div class="text-center flex justify-center gap-2 w-full px-3">
                            <select style="max-width: 160px" name="ratio" class="ti-form-select rounded-sm  !px-2">
                                <option selected>ორიენტაცია</option>
                                <option value="16:9">ლანდშაფტი (16:9)</option>
                                <option value="16:9">ლანდშაფტი (4:3)</option>
                                <option value="9:16">პორტრეტი (9:16)</option>
                                <option value="9:16">პორტრეტი (3:4)</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div id="target"></div>
            </div>
            {{--Right sidebar  --}}
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
                        images)
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
                            <a href="javascript:void(0);" class="text-primary underline">
                                <u>
                                    <a href="{{route('gallery',['model'=>'flux-schnell'])}}">  View All</a>
                                </u>
                            </a>
                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($flux2 as $item2)
                            {{--                            @if($loop->iteration  < 20)--}}
                            @foreach($item2->media as $index => $media2)
                                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                                    <a aria-label="anchor" href="{{$media2->getUrl()}}"
                                       class="chat-media glightbox">
                                        <img style="object-fit: cover" src="{{$media2->getUrl()}}" alt="">
                                    </a>
                                    <div class="flex justify-around">
                                        <form class="mb-2" action="{{route('flux-schnell.delete',$item2->id)}}"
                                              method="post">
                                            @csrf
                                            {{--delete Modal Button--}}
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('deleteId').value={{$item2->id}}"
                                               data-hs-overlay="#staticBackdrop">
                                                <span class="badge bg-primary/10  text-primary material-symbols-outlined">delete</span>
                                            </a>

                                        </form>
                                        <form class="mb-2" action="{{route('flux.download')}}">
                                            <input type="hidden" name="id" value="{{$item2->id}}">
                                            <button>
                                                <span class="badge bg-primary/10  text-primary material-symbols-outlined">Download</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            {{--                            @endif--}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Delete Modal--}}
    <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
            <div class="ti-modal-content">
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
                            data-hs-overlay="#staticBackdrop
              ">
                        Close
                    </button>

                    <form action="{{route('flux-schnell.delete')}}"
                          method="post">
                        <input type="hidden" name="id" id="deleteId">
                        @csrf
                        <button class="ti-btn bg-primary text-white !font-medium">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection