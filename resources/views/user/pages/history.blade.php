@extends('user.pages.layout')

@section('history')
    <div class="main-content">

            <div style="height: 100%!important;max-height: calc(100vh - 12rem) !important;"
                 class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
                {{--Left Sidebar--}}
                @include('user.pages.components.chatLeftSidebar.chat-left-sidebar')
                {{--Main Chat--}}
                <div id="main-chat" class="main-chat-area border dark:border-defaultborder/10">
                    <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                        <div class="flex items-center leading-none">
                            <div class="text-center flex-col justify-center gap-2 w-full px-3 ">
                                <form style="max-width: 100px" class="mb-2 w" action="{{route('userbalance.history')}}?{{ http_build_query(request()->query()) }}">
                                    <select
                                            onchange="this.form.submit();"
                                            style="min-width: 115px!important;padding-bottom: 2px;padding-top:2px"
                                            name="model"
                                            class="ti-form-select rounded-sm  !px-2">
                                        <option selected value="all">{{__('All')}}</option>
                                        <option @selected(request()->query('model') === 'fill') value="fill">{{__('Only Fill')}}
                                        </option>
                                        <option @selected(request()->query('model') === 'flux') value="flux">Flux
                                            Schnell
                                        </option>
                                        <option @selected(request()->query('model') === 'midjourney') value="midjourney">
                                            Midjourney
                                        </option>
                                        <option @selected(request()->query('model') === 'removebg') value="removebg">
                                            Remove BG
                                        </option>
                                        <option @selected(request()->query('model') === 'runway') value="runway">
                                            Runway
                                        </option>
                                        <option @selected(request()->query('model') === 'refund') value="refund">
                                            refund
                                        </option>
                                    </select>
                                </form>
                                @if(isset($totalbymodel) && request()->query('model') !== 'fill')
                                    <div style="align-items: center" class="flex justify-center gap-3">
                                        <p style="font-size: 1rem">{{__('Total Spent')}}: <span
                                                    class="badge bg-danger/10 text-danger ">{{$totalbymodel}}</span></p>
                                    </div>
                                @endif
                                @if(request()->query('model') === 'fill')
                                    <div style="align-items: center" class="flex justify-center gap-3">
                                        <p style="font-size: 1rem">{{__('Total Fill')}}: <span
                                                    class="badge bg-success/10 text-success">{{$totalfill}}</span></p>
                                    </div>
                                @endif
                                @if(isset($totalspent))
                                    <div style="align-items: center" class="flex justify-center gap-3">
                                        <p style="font-size: 1rem;line-height:1.5 ">{{__('Total Fill')}}: <span
                                                    class="badge bg-success/10 text-success">{{$totalfill}}</span>
                                        </p>
                                        <p style="font-size: 1rem;line-height:1.5 ">{{__('Total Spent')}}: <span
                                                    class="badge bg-danger/10 text-danger ">{{$totalspent}}</span>
                                        </p>
                                        <p style="font-size: 1rem;line-height:1.5 ">{{__('Total Refund')}}: <span
                                                    class="badge bg-danger/10 text-danger ">{{$totalrefund? :0}}</span>
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div style="height: 85%!important" id="main-chat-content">
                        <ul id="chat-target" class="list-none">
                            {{-- Answer--}}
                            <li class="chat-item-start flex justify-center text-center">
                                <div class="chat-list-inner w-full">
                                    <div class="ms-3 w-full">
                                        <div id="answer" class="main-chat-msg text-center w-full flex justify-center">
                                            <div style="width: 100%!important" class="table-responsive">
                                                <table class="table whitespace-nowrap table-bordered table-bordered-primary border-primary/10 min-w-full">
                                                    <thead>
                                                    <tr class="border-b border-primary/10">
                                                        <th scope="col" style="text-align: center">#</th>
                                                        <th scope="col" style="text-align: center">Date</th>
                                                        <th scope="col" style="text-align: center">Description</th>
                                                        <th scope="col" style="text-align: center">Amount</th>
                                                        <th scope="col" style="text-align: center">Media</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($history as $index=> $transaction)
                                                        <tr class="border-b border-primary/10">
                                                            <td>
                                                                <p class="text-center">  {{$index+1}}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-center">{{$transaction->created_at}}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-center">   {{$transaction->model}}</p>

                                                            </td>
                                                            <td>
                                                                <p class="text-center">  {{$transaction->balance}}</p>
                                                            </td>
                                                            <td class="td-width">
                                                                @if($transaction->model==='flux')
                                                                    @if($transaction->flux)
                                                                        @foreach($transaction->flux->media as $media)
                                                                            <a
                                                                                    href="{{$media->getUrl()}}"
                                                                                    class="glightbox box responcive-image-history"
                                                                                    data-gallery="gallery1">
                                                                                <img src="{{$media->getUrl()}}"
                                                                                     alt="image">
                                                                            </a>
                                                                        @endforeach
                                                                    @else
                                                                        <p>Image Was Deleted By User</p>
                                                                    @endif
                                                                @endif
                                                                @if($transaction->model==='removebg')
                                                                    @if($transaction->removebg)
                                                                        @foreach($transaction->removebg->media as $media)
                                                                            <a
                                                                                    href="{{$media->getUrl()}}"
                                                                                    class="glightbox box responcive-image-history"
                                                                                    data-gallery="gallery1">
                                                                                <img src="{{$media->getUrl()}}"
                                                                                     alt="image">
                                                                            </a>
                                                                        @endforeach
                                                                    @else
                                                                        <p>Image Was Deleted By User</p>
                                                                    @endif
                                                                @endif
                                                                @if($transaction->model==='midjourney')
                                                                    <div class="grid grid-cols-2 gap-2">
                                                                        @if($transaction->midjourney)
                                                                            @foreach($transaction->midjourney->media as $media)
                                                                                <a aria-label="anchor"
                                                                                   href="{{$media->getUrl()}}"
                                                                                   class="glightbox box responcive-image-history">
                                                                                    <img style="margin-top: 10px"
                                                                                         src="{{$media->getUrl()}}"
                                                                                         alt="">
                                                                                </a>
                                                                            @endforeach
                                                                        @else
                                                                            <p>Image Was Deleted By User</p>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                                @if($transaction->model==='runway')
                                                                    @if($transaction->runway)
                                                                        @foreach($transaction->runway->getMedia('runway_image') as $media)
                                                                            <a aria-label="anchor"
                                                                               href="{{$media->getUrl()}}"
                                                                               class="glightbox box responcive-image-history">
                                                                                <img style="margin-top: 10px"
                                                                                     src="{{$media->getUrl()}}"
                                                                                     alt="">
                                                                            </a>
                                                                        @endforeach
                                                                    @else
                                                                        <p>Video Was Deleted By User</p>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{--PAGINATION--}}
            <div class="history-pagination grid justify-center sm:flex sm:items-center gap-2 flex-wrap">
                <!-- Pagination Wrapper -->
                <nav class="flex items-center justify-center -space-x-px mb-3">

                    @if ($history->onFirstPage())
                        <a type="button"
                           class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <i class="ri-arrow-left-s-line align-middle rtl:rotate-180"></i>
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @else
                        <a href="{{ $history->previousPageUrl() }}" type="button"
                           class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <i class="ri-arrow-left-s-line align-middle rtl:rotate-180"></i>
                            <span aria-hidden="true" class="sr-only">Previous</span>
                        </a>
                    @endif

                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-primary text-white border border-gray-200 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-primary dark:border-white/10 dark:text-white dark:focus:bg-gray-500"
                            aria-current="page">

                        {{ $history->currentPage() }}
                    </button>
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center border border-gray-200 text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        -
                    </button>
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-primary text-white border border-gray-200 py-2 px-3 text-sm first:rounded-s-md last:rounded-e-md focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-primary dark:border-white/10 dark:text-white dark:focus:bg-gray-500"
                            aria-current="page">
                        {{ $history->lastPage() }}
                    </button>

                    <a href="{{ $history->nextPageUrl() }}" type="button"
                       class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm first:rounded-s-md last:rounded-e-md border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-white/10 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        <span aria-hidden="true" class="sr-only">Next</span>
                        <i class="ri-arrow-right-s-line align-middle rtl:rotate-180"></i>
                    </a>
                </nav>
                {{-- PER PAGE AND GO TO PAGE--}}
                <div class="flex justify-center items-center gap-x-5 mb-3">
                    <!-- Dropdown -->
                    <div class="hs-dropdown ti-dropdown [--placement:top-left]">
                        <button id="hs-pagination-dropdown-bordered-group1" type="button"
                                class="hs-dropdown-toggle !py-2 !px-2.5 ti-dropdown-toggle">
                            {{request()->query('perpage',10)}}
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="hs-dropdown-menu ti-dropdown-menu hidden"
                             aria-labelledby="hs-pagination-dropdown-bordered-group1">
                            <a

                                    href="{{route('userbalance.history',['perpage'=>$perpage1,'page'=>request()->query('page'),'model'=>request()->query('model')])}}"

                                    type="button" class="ti-dropdown-item w-full justify-between">
                                10
                                @if(request()->query('perpage')==10)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                            <a
                                    href="{{route('userbalance.history',['perpage'=>$perpage2,'page'=>request()->query('page'),'model'=>request()->query('model')])}}"

                                    type="button" class="ti-dropdown-item w-full justify-between">
                                15
                                @if(request()->query('perpage')==15)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                            <a
                                    href="{{route('userbalance.history',['perpage'=>$perpage3,'page'=>request()->query('page'),'model'=>request()->query('model')])}}"

                                    type="button" class="ti-dropdown-item w-full justify-between">
                                25
                                @if(request()->query('perpage')==32)
                                    <i class="ri-check-line text-primary flex-shrink-0 size-4"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                    <!-- End Dropdown -->

                    <!-- Go To Page -->
                    <form action="">
                        <div class="flex justify-center sm:justify-start items-center gap-x-2">
                                            <span class="text-sm text-gray-800 whitespace-nowrap dark:text-white">
                                                {{__('Go to page')}}
                                            </span>
                            <input type="number" name="page"
                                   class="min-h-[32px] py-2 px-2.5 block w-12 border-gray-200 rounded-md text-sm text-center focus:border-primary focus:ring-primary [&amp;::-webkit-outer-spin-button]:appearance-none [&amp;::-webkit-inner-spin-button]:appearance-none disabled:opacity-50 disabled:pointer-events-none dark:bg-bodybg dark:border-white/10 dark:text-gray-400 dark:focus:ring-gray-600">
                            @if(request()->query('model'))
                                <input type="hidden" name="model" value="{{request()->query('model')}}">
                            @endif
                            <button style="height: 100%!important;"
                                    class="text-sm text-gray-800 whitespace-nowrap dark:text-white ">
                                <span class="badge bg-primary/10  text-primary ms-1">GO</span>
                            </button>
                        </div>
                    </form>
                    <!-- End Go To Page -->
                </div>
            </div>

    </div>
    <script>
        @if($errors->any())
        Swal.fire({
                html: `
    <div class="flex justify-center">
    <svg style="color:red;font-size:50px" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m7.493.015l-.386.04c-1.873.187-3.76 1.153-5.036 2.579C.66 4.211-.057 6.168.009 8.253c.115 3.601 2.59 6.65 6.101 7.518a8.03 8.03 0 0 0 6.117-.98a8 8 0 0 0 3.544-4.904c.172-.701.212-1.058.212-1.887s-.04-1.186-.212-1.887C14.979 2.878 12.315.498 9 .064C8.716.027 7.683-.006 7.493.015m1.36 1.548a6.5 6.5 0 0 1 3.091 1.271c.329.246.976.893 1.222 1.222c.561.751.976 1.634 1.164 2.479a6.8 6.8 0 0 1 0 2.93c-.414 1.861-1.725 3.513-3.463 4.363a6.8 6.8 0 0 1-1.987.616c-.424.065-1.336.065-1.76 0c-1.948-.296-3.592-1.359-4.627-2.993a7.5 7.5 0 0 1-.634-1.332A6.2 6.2 0 0 1 1.514 8c0-1.039.201-1.925.646-2.84c.34-.698.686-1.18 1.253-1.747A6 6 0 0 1 5.16 2.16a6.45 6.45 0 0 1 3.693-.597M7.706 4.29c-.224.073-.351.201-.413.415c-.036.122-.04.401-.034 2.111c.008 1.97.008 1.971.066 2.08a.7.7 0 0 0 .346.308c.132.046.526.046.658 0a.7.7 0 0 0 .346-.308c.058-.109.058-.11.066-2.08c.008-2.152.008-2.154-.145-2.335c-.124-.148-.257-.197-.556-.205a1.7 1.7 0 0 0-.334.014m.08 6.24a.86.86 0 0 0-.467.402a.85.85 0 0 0-.025.563A.78.78 0 0 0 8 12c.303 0 .612-.22.706-.505a.85.85 0 0 0-.025-.563a.95.95 0 0 0-.348-.352c-.116-.06-.429-.089-.547-.05"/></svg>
  </div>
    @foreach($errors->all() as $error)
    <p style="font-size:1.2rem" class="mt-2">
    {{ $error }}
     </p>
    @endforeach
  `,
                showConfirmButton: true,
            },
        )
        @endif
    </script>
@endsection