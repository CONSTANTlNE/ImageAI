@extends('user.pages.layout')



@section('colorize')
    <div class="main-content">
        <div class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
            {{--Left Sidebar--}}
            @include('user.pages.components.chatLeftSidebar.chat-left-sidebar')
            {{--Main Chat--}}
            <div id="main-chat" class="main-chat-area  custom-height border dark:border-defaultborder/10">
                <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                    <div class="flex items-center leading-none">
                            <span class="avatar avatar-lg online me-4 avatar-rounded chatstatusperson">
                                <img class="chatimageperson" src="{{asset('assets/images/colorization.png')}}" alt="img">
                            </span>
                        <div class="flex-grow">
                            <p class="mb-1 font-semibold text-[.875rem]">
                                <a href="javascript:void(0);"
                                   class="chatnameperson responsive-userinfo-open !text-defaulttextcolor dark:text-defaulttextcolor/70">
                                    Colorize
                                </a>
                            </p>
                            <p class="text-[#8c9097] mb-1 dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                SD - 0.55 ₾
                            </p>
                            <p class="text-[#8c9097] dark:text-white/50 mb-0 chatpersonstatus !text-defaultsize">
                                HD - 0.70 ₾
                            </p>
                        </div>
                        <div class="flex ms-auto">
                            <button style="display: flex;justify-content: center;align-items: center;padding: 2px"
                                    aria-label="button" type="button"
                                    class="ti-btn hide-gallery ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold responsive-userinfo-open">
                                <svg class="ti ti-user-circle" id="responsive-chat-close"
                                     xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/>
                                        <path d="m4 7l-.012-1c.112-.931.347-1.574.837-2.063C5.765 3 7.279 3 10.307 3h3.211c3.028 0 4.541 0 5.482.937c.49.489.725 1.132.837 2.063v1"/>
                                        <circle cx="17.5" cy="10.5" r="1.5"/>
                                        <path stroke-linecap="round"
                                              d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/>
                                    </g>
                                </svg>
                            </button>

                            <button aria-label="button" type="button"
                                    class="ti-btn ti-btn-icon ti-btn-outline-light  !text-[0.95rem] !ms-2 font-semibold responsive-chat-close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="chat-content custom-chat-content" id="main-chat-content">
                    <ul id="chat-target" class="list-none">
                        <li style="margin-bottom: 15px" class="chat-day-label">
                            <span>{{__('Today')}}</span>
                        </li>
                        @foreach($colorized as $itemindex => $item)
                            {{-- PROMPT --}}
                            <li style="margin-bottom:8px " class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner">
                                    <div class="ms-3">
                                        <span class="chatting-user-info chatnameperson">
                                            <span class="msg-sent-time">{{$item->created_at}}</span>
                                        </span>
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

                                                    <a
                                                       id="mediaid{{$itemindex}}"
                                                       aria-label="anchor"
                                                       href="{{$media->getUrl()}}"
                                                       class="avatar avatar-xl m-1 ai-image glightbox">
                                                        <img style="object-fit: cover"
                                                             src="{{$media->getUrl()}}" alt=""
                                                             class="rounded-md">
                                                    </a>
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

                <form action="{{route('colorize.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{--Upload PHOTO or Choose From Gallery--}}
                    <div style="position: absolute; bottom:10px;padding: 0;align-items: center!important;" class="flex flex-col justify-center w-full gap-2">
                        {{--Upload PHOTO--}}
                        <div class="text-center">
                            <button id="runwayBtn" type="button"
                                    class="ti-btn ti-btn-primary-full !rounded-full ti-btn-wave">ატვირთე
                            </button>
                            <div style="color:#845ADF" id="runwayPhotoName"></div>
                        </div>
                        <input id="runwayFile" name="image" type="file" accept="image/jpeg,image/png,image/jpg"
                               style="display: none">
                        {{--Choose From Gallery--}}
                        <div class="flex justify-center align-middle">
                            <select style="min-width: 130px;padding-left: 7px!important;padding-top:3px;padding-bottom: 3px;" name="resolution"
                                    class="ti-form-select rounded-sm  !px-2 ">
                                <option  selected value="full-hd"> HD 1920x1080</option>
                                <option value="sd"> SD 640x480</option>
                            </select>
                            <button id="fetch-prompt2" aria-label="anchor" class="ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send startSpinner">
                                <i class="ri-send-plane-2-line"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div id="target"></div>
            </div>

            {{--Right sidebar--}}
            <div class="chat-user-details border  custom-height dark:border-defaultborder/10" id="chat-user-details">
                <div class="hideX">
                    <button aria-label="button" type="button"
                            class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2 responsive-chat-close2"><i
                                class="ri-close-line"></i>
                    </button>
                </div>
                <div class="mb-0 mt-3">
                    <div class="font-semibold mb-4 text-defaultsize dark:text-defaulttextcolor/70">
                        {{__('last')}}
                        <span class="badge bg-primary/10 !rounded-full text-primary ">30</span>
                        {{__('images')}}
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
                            <a href="javascript:void(0);" class="text-primary underline">
                                <u>
                                    <a class="text-primary startSpinner" href="{{route('gallery',['model'=>'colorize'])}}">{{__('View All')}}</a>
                                </u>
                            </a>
                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($colorizations as $item2)
                                @foreach($item2->media as $media2)
                                    <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                                        <a aria-label="anchor" href="{{$media2->getUrl()}}"
                                           data-hs-overlay="#hs-extralarge-modal"
                                           onclick="document.getElementById('modalvideo').src='{{$item2->video_url}}'
                                            document.getElementById('videoprompt').innerHTML = '{{$item2->prompt}}'
                                            "
                                           class="chat-media glightbox">
                                            <img style="object-fit: cover" src="{{$media2->getUrl()}}" alt="">
                                        </a>


                                        <div class="flex justify-around mb-3">
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('deleteId').value={{$item2->id}}
                                           document.getElementById('downloadId').value={{$item2->id}}
                                           document.getElementById('shareId').value='{{$media2->getUrl()}}'
                                           "
                                               data-hs-overlay="#actionsmodal">
                                                <svg class="badge bg-primary/10  text-primary"
                                                     xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                     viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="M4 12a1 1 0 1 0 2 0a1 1 0 1 0-2 0m7 0a1 1 0 1 0 2 0a1 1 0 1 0-2 0m7 0a1 1 0 1 0 2 0a1 1 0 1 0-2 0"/>
                                                </svg>
                                            </a>
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
    <div id="staticBackdrop7" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 min-h-[calc(100%-3.5rem)] ease-out flex items-center">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">Delete Image</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#staticBackdrop7">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <p>
                        Are you sure you want to delete this photo?
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <button type="button"
                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                            data-hs-overlay="#staticBackdrop7">
                        Close
                    </button>
                    <form action="{{route('colorize.delete')}}"
                          method="post">
                        <input type="hidden" name="id" id="deleteId">
                        @csrf
                        <button class="ti-btn bg-primary text-white !font-medium">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{--Actions Modal--}}
    <div id="actionsmodal" class="hs-overlay hidden ti-modal">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel2">Actions
                    </h6>
                    <button type="button" class="hs-dropdown-toggle ti-modal-close-btn" data-hs-overlay="#actionsmodal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                  fill="currentColor"/>
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body" style="min-width: 330px">
                    <div class="flex justify-center gap-4">
                        {{--Download Button --}}
                        <form action="{{route('colorize.download')}}">
                            <input id="downloadId" type="hidden" name="id" value="">
                            <button>
                                <svg class="badge bg-primary/10  text-primary"
                                     xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                                </svg>
                            </button>
                        </form>

                        {{--delete Modal Button--}}
                        <a href="javascript:void(0);"
                           data-hs-overlay="#staticBackdrop7">
                            <svg class="badge bg-primary/10  text-primary"
                                 xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                 viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                            </svg>
                        </a>

                        {{--share Button--}}
                        <input id="shareId" type="hidden">
                        <button data-hs-overlay="#actionsmodal" onclick="copyUrl()">
                            <svg class="badge bg-primary/10  text-primary" xmlns="http://www.w3.org/2000/svg" width="35"
                                 height="35" viewBox="0 0 512 512">
                                <rect width="336" height="336" x="128" y="128" fill="none" stroke="currentColor"
                                      stroke-linejoin="round" stroke-width="32" rx="57" ry="57"/>
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="32"
                                      d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    Copy link functionality--}}
    <script>
        function copyUrl() {
            const input = document.getElementById('shareId');
            const url = input.value;

            navigator.clipboard.writeText(url).then(() => {
                Swal.fire({
                        html: `
    <div class="flex justify-center">
    <svg style="color:green;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
  </div>
    <p style="font-size:1.2rem" class="mt-2">დაკოპირდა</p>
  `,
                        showConfirmButton: false,
                        timer: 2500,
                            {{--text: '{{session()->get('alert_success')}}',--}}
                    },
                )
            }).catch(err => {
                console.error("Failed to copy text:", err);
            });
        }
    </script>
@endsection