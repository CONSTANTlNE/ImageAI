@extends('user.pages.layout')

@section('history')
    <div class="main-content">
        <div>
            <div class="main-chart-wrapper p-2 gap-2 lg:flex responsive-chat-open">
                {{--Left Sidebar--}}
                @include('user.pages.components.chat-left-sidebar')
                {{--Main Chat--}}
                <div id="main-chat" class="main-chat-area border dark:border-defaultborder/10">
                    <div class="sm:flex items-center p-2 border-b dark:border-defaultborder/10">
                        <div class="flex items-center leading-none">
                            <div class="text-center flex justify-center gap-2 w-full px-3">
                                <form action="{{route('userbalance.history')}}?{{ http_build_query(request()->query()) }}">
                                    <select
                                            onchange="this.form.submit();"
                                            style="min-width: 115px!important;padding-bottom: 2px;padding-top:2px" name="model"
                                            class="ti-form-select rounded-sm  !px-2">
                                        <option selected value="all">All</option>
                                        <option @selected(request()->query('model') === 'fill') value="fill">Only Fill</option>
                                        <option @selected(request()->query('model') === 'flux') value="flux">Flux Schnell</option>
                                        <option @selected(request()->query('model') === 'midjourney') value="midjourney">Midjourney</option>
                                        <option @selected(request()->query('model') === 'removebg') value="removebg">Remove BG</option>
                                        <option @selected(request()->query('model') === 'runway') value="runway">Runway</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div style="height: 100%!important" class="chat-content custom-chat-content" id="main-chat-content">
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
                                                        <th scope="col" class="text-start">#</th>
                                                        <th scope="col" class="text-start">Date</th>
                                                        <th scope="col" class="text-start">Description</th>
                                                        <th scope="col" class="text-start">Amount</th>
                                                        <th scope="col" class="text-start">Media</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($history as $index=> $transaction)
                                                        <tr class="border-b border-primary/10">
                                                            <td class="text-start">
                                                                <p>  {{$index+1}}</p>

                                                            </td>
                                                            <td>
                                                                <p>{{$transaction->created_at}}</p>
                                                            </td>
                                                            <td>
                                                                <p>   {{$transaction->model}}</p>

                                                            </td>
                                                            <td>
                                                                <p>  {{$transaction->balance}}</p>
                                                            </td>
                                                            <td>
                                                                @if($transaction->model==='flux')
                                                                    {{--                                                                @dd($transaction->flux())--}}
                                                                    @foreach($transaction->flux->media as $media)
                                                                        <a
                                                                                href="{{$media->getUrl()}}"
                                                                                class="glightbox box responcive-image-history"
                                                                                data-gallery="gallery1">
                                                                            <img src="{{$media->getUrl()}}" alt="image">
                                                                        </a>
                                                                    @endforeach
                                                                @endif
                                                                @if($transaction->model==='removebg')
                                                                    @foreach($transaction->removebg->media as $media)
                                                                        <a
                                                                                href="{{$media->getUrl()}}"
                                                                                class="glightbox box responcive-image-history"
                                                                                data-gallery="gallery1">
                                                                            <img src="{{$media->getUrl()}}" alt="image">
                                                                        </a>
                                                                    @endforeach
                                                                @endif

                                                                @if($transaction->model==='midjourney')
                                                                    @foreach($transaction->midjourney->media as $media)
                                                                        <a aria-label="anchor"
                                                                           href="{{$media->getUrl()}}"
                                                                           class="glightbox box responcive-image-history">
                                                                            <img style="margin-top: 10px"
                                                                                 src="{{$media->getUrl()}}"
                                                                                 alt="">
                                                                        </a>
                                                                    @endforeach
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
            <div class="grid justify-center sm:flex sm:items-center gap-2 flex-wrap">
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
                                                Go to page
                                            </span>
                            <input type="number" name="page"
                                   class="min-h-[32px] py-2 px-2.5 block w-12 border-gray-200 rounded-md text-sm text-center focus:border-primary focus:ring-primary [&amp;::-webkit-outer-spin-button]:appearance-none [&amp;::-webkit-inner-spin-button]:appearance-none disabled:opacity-50 disabled:pointer-events-none dark:bg-bodybg dark:border-white/10 dark:text-gray-400 dark:focus:ring-gray-600">
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
    </div>
@endsection