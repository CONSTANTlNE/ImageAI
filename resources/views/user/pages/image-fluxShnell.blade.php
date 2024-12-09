@extends('user.pages.layout')



@section('fluxshnell')
    <div  class="main-content">
        <div class="main-chart-wrapper p-2 gap-2 lg:flex @if(request()->has('chat-open')) responsive-chat-open @endif">
            {{--Left Sidebar--}}
            @include('user.pages.components.chatLeftSidebar.chat-left-sidebar')
            {{--            Main Chat--}}
            <div   id="main-chat" class="main-chat-area  custom-height border dark:border-defaultborder/10">
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
                                {{__('Price')}} - 0.03 ₾
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
                        <li class="chat-day-label">
                            <span>{{__('Today')}}</span>
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
                                                @if($item->prompt_ka)
                                                    <p class="mb-0">{{$item->prompt_ka}}</p>
                                                @else
                                                    <p class="mb-0">{{$item->prompt_en}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- Answer--}}
                            <li class="chat-item-start flex justify-center text-center"  >
                                <div class="chat-list-inner w-full">
                                    <div class="ms-3 w-full">
                                        <div class="main-chat-msg text-center w-full">
                                            <div style="width: 100%!important;padding: 0">
                                                <div style="justify-content: center!important;width: 100%!important;"
                                                     class="mb-0 flex flex-wrap  justify-center">
                                                    @foreach($item->media as $index => $media)
                                                        <a style="width: 100%!important"
                                                           aria-label="anchor" href="{{$media->getUrl()}}"
                                                           class="avatar avatar-xl m-1 glightbox ai-image flex justify-center">
                                                            <img
                                                                    style="object-fit: cover;width: 100%!important"
                                                                    src="{{$media->getUrl()}}" alt=""
                                                                    class="rounded-md">
                                                        </a>
                                                        <div style="width: 100%;padding: 0!important"
                                                             class="flex justify-center gap-5">
                                                            {{--delete Modal Button--}}
                                                            <a href="javascript:void(0);"
                                                               onclick="document.getElementById('deleteId').value='{{$item->id}}';document.getElementById('mediaindex').value='{{$index}}' "
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
                                                            <form action="{{route('flux.download')}}">
                                                                <input type="hidden" name="id"
                                                                       value="{{$item->id}}">
                                                                <input type="hidden" name="index"
                                                                       value="{{$index}}">
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
                                                            {{--Copy--}}
                                                            <input id="shareId" type="hidden">
                                                            <button onclick="navigator.clipboard.writeText('{{$media->getUrl()}}')
                                                                       copyUrl2() ">
                                                                <svg class="badge bg-primary/10  text-primary"
                                                                     xmlns="http://www.w3.org/2000/svg" width="35"
                                                                     height="35" viewBox="0 0 512 512">
                                                                    <rect width="336" height="336" x="128" y="128"
                                                                          fill="none" stroke="currentColor"
                                                                          stroke-linejoin="round" stroke-width="32"
                                                                          rx="57" ry="57"/>
                                                                    <path fill="none" stroke="currentColor"
                                                                          stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="32"
                                                                          d="m383.5 128l.5-24a56.16 56.16 0 0 0-56-56H112a64.19 64.19 0 0 0-64 64v216a56.16 56.16 0 0 0 56 56h24"/>
                                                                </svg>
                                                            </button>

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
                <form style="height: 6.7rem!important;align-items: center;display: flex;flex-direction: column;gap: 10px;justify-content: center"
                      class="chat-footer"
                      action="{{route('flux-schnell.prompt')}}" method="post"
                        {{--                      hx-post="{{route('flux-schnell.prompt')}}" hx-target="#target"--}}
                >
                    @csrf
                    <div style="padding: 0;width: 190px!important"
                         class="flex justify-center gap-5 mt-3">
                        <div class="text-center flex justify-center gap-2 w-full px-3">
                            <select style="max-width: 190px;padding-bottom: 2px;padding-top:2px" name="ratio"
                                    class="ti-form-select rounded-sm  !px-2">
                                <option value="HD">HD (1024x1024)</option>
                                <option value="16:9">{{__('Landscape')}} (16:9)</option>
                                <option selected value="4:3">{{__('Landscape')}} (4:3)</option>
                                <option value="9:16">{{__('Portrait')}} (9:16)</option>
                                <option value="3:4">{{__('Portrait')}} (3:4)</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 w-full">
                        <input class="mb-3 form-control w-full !rounded-md" name="prompt"
                               placeholder="{{__('description')}}"
                               type="text">
                        <button style="margin-bottom: 8px" id="fetch-prompt2" aria-label="anchor"
                                class="f ti-btn bg-primary text-white !mx-2 ti-btn-icon ti-btn-send startSpinner">
                            <i class="ri-send-plane-2-line"></i>
                        </button>
                    </div>

                </form>
            </div>
            {{--Right sidebar  --}}
            <div class="chat-user-details custom-height border dark:border-defaultborder/10" id="chat-user-details">
                <div class="hideX">
                    <button aria-label="button" type="button"
                            class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2  responsive-chat-close2"><i
                                class="ri-close-line"></i>
                    </button>
                </div>

                <div class="mb-0 mt-3">
                    <div class="font-semibold mb-4 text-defaultsize dark:text-defaulttextcolor/70">
                        {{__('last')}}
                        <span class="badge bg-primary/10 !rounded-full text-primary ">30</span>
                        {{__('images')}}
                        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">

                                <u>
                                    <a style="text-decoration: none" class="startSpinner text-primary"
                                       href="{{route('gallery',['model'=>'flux-schnell'])}}">{{__('View All')}}</a>
                                </u>

                        </span>
                    </div>
                    <div class="grid grid-cols-12 gap-x-[1rem]">
                        @foreach($flux2 as $fluxindex=> $item2)
                            @foreach($item2->media as $index => $media2)
                                <div class="xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4 mb-3">
                                    <a aria-label="anchor" href="{{$media2->getUrl()}}"
                                       class="chat-media glightbox">
                                        <img style="object-fit: cover;width: 100%!important;margin-bottom: 10px;margin-top: 10px"
                                             src="{{$media2->getUrl()}}"
                                             alt="">
                                    </a>
                                    <div class="flex justify-around">
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('deleteId').value={{$item2->id}}
                                           document.getElementById('downloadId').value={{$item2->id}}
                                           document.getElementById('shareId').value='{{$media2->getUrl()}}'
                                           document.getElementById('deleteId2').value={{$item2->id}}

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
    <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="ti-modal-content w-full">
                <div class="ti-modal-header">
                    <h6 class="modal-title text-[1rem] font-semibold">{{__('Delete Image')}}</h6>
                    <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                            data-hs-overlay="#staticBackdrop">
                        <span class="sr-only">Close</span>
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ti-modal-body px-4">
                    <p>
                        {{__('Are you sure ?')}}
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <button type="button"
                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                            data-hs-overlay="#staticBackdrop">
                        {{__('Close')}}
                    </button>
                    <form action="{{route('flux-schnell.delete')}}"
                          method="post">
                        <input type="hidden" name="id" id="deleteId">
                        @csrf
                        <button class="ti-btn bg-primary text-white !font-medium">{{__('Delete')}}</button>
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
                    <h6 class="modal-title text-[1rem] font-semibold" id="staticBackdropLabel2">{{__('Actions')}}
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
                        <form action="{{route('flux.download')}}">
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
                        {{--Delete Button--}}
                        <form action="{{route('flux-schnell.delete')}}"
                              method="post">
                            @csrf
                            {{--delete Modal Button--}}
                            <a href="javascript:void(0);"
                               data-hs-overlay="#staticBackdrop">
                                <svg class="badge bg-primary/10  text-primary"
                                     xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/>
                                </svg>
                            </a>
                        </form>
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

                        {{--make public Button--}}
                        <form action="{{route('flux.make.public')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="deleteId2">
                            <button>
                                <svg class="badge bg-primary/10 text-primary" xmlns="http://www.w3.org/2000/svg"
                                     width="35" height="35" viewBox="0 0 24 24">
                                    <g stroke="#845ADF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <circle cx="18" cy="5" r="3"/>
                                        <circle cx="6" cy="12" r="3"/>
                                        <circle cx="18" cy="19" r="3"/>
                                        <path d="m8.5 13.5l7 4m0-11l-7 4" fill="none"/>
                                    </g>
                                </svg>
                            </button>
                        </form>
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