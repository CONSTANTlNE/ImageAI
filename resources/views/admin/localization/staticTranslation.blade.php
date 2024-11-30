@extends('admin.layout')

@section('staticTranslation')

    @php
        //        dd($keys);

        //      foreach($jsonData as $key =>$language){
        //          dd($key);
        //      }

    @endphp


   @if(session('error'))
    <div class="alert alert-danger mt-5" role="alert">
        {{ session('error') }}
    </div>
   @endif
    <div class="box">
        <form class="" action="{{route('storeStaticTranslations')}}" method="POST">
            <div class="box-header justify-between">
                <div class="box-title">
                    Add Static Translations
                </div>
            </div>
            <div class="box-body grid grid-cols-2 gap-4 items-center">
                @csrf
                <div class="mb-4 sm:mb-0 input-group ">
                    <div class="input-group-text">key</div>
                    <input type="text" class="form-control"
                           name="key">
                </div>
                <br>
                @foreach($locales as $index => $locale)
                    <div class="mb-4 sm:mb-0 input-group ">
                        <div class="input-group-text">{{$locale['abbr']}}</div>
                        <input type="text" class="form-control"
                               id="translation{{$index}}" name="{{$locale['abbr']}}">
                    </div>
                @endforeach


            </div>
            <button type="submit" class="ti-btn ti-btn-primary-full !mb-0 ">Submit</button>
        </form>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Basic DataTable</h5>
                </div>
                <div class="box-body">
                    <div class="overflow-auto">
                        <div id="basic-table" class="ti-custom-table ti-striped-table ti-custom-table-hover">
                            <form id="updateForm" action="{{route('updateStaticTranslation')}}" method="post">
                                @csrf
                                <table class="text-center" id="static-lang" style="width:100%">
                                    <thead>
                                    <tr>

                                        <th style="text-align: center">Key</th>
                                        @foreach($locales as $index => $locale)
                                            <th style="text-align: center">{{$locale['abbr']}}</th>
                                        @endforeach
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = -1; // Initialize counter variable
                                    @endphp
                                    @foreach($keys as $index=> $key)
                                        @php
                                            $counter++;
                                        @endphp

                                        <tr style="width: 150px!important">

                                            @csrf
                                            <td style="width: 150px!important">{{$key}}</td>
                                            @foreach($jsonData as $abbr => $language)
                                                <td>
                                                    <input data-form-abbr="{{$index}}" name="abbr[]" type="hidden" value="{{$abbr}}" disabled>
                                                    <input data-form-key="{{$index}}"  name="key[]" type="hidden" value="{{$key}}" disabled>
                                                    <input
                                                            @if($main===$abbr && !isset ($language[$key])) style="border-color:red" @endif
                                                            data-translation="{{$index}}" name="translation[]"
                                                           value="@if(isset ($language[$key])) {{$language[$key]}} @endif" type="text"
                                                            class="form-control translation"
                                                           placeholder="No Translation" disabled="">
                                                </td>
                                            @endforeach
                                            {{--                                                @php dd($index) @endphp--}}
                                            <td class="flex justify-center align-middle gap-2">
                                                <span data-edit="{{$index}}"
                                                      style="cursor: pointer;color:blue"
                                                      class="material-symbols-outlined edit-translation">edit</span>
                                                <span data-submit="{{$index}}"
                                                      style="display: none;cursor: pointer;color:green"
                                                      class="material-symbols-outlined">done</span>
                                                <span data-cancel-submit="{{$index}}"
                                                      style="display: none;cursor: pointer;color:red"
                                                      class="material-symbols-outlined">close</span>
                                                <span data-delete="{{$index}}"
                                                      style="display: none;cursor: pointer;color:red"
                                                      class="material-symbols-outlined">delete</span>
                                                <input style="display:none" data-deleteinput="{{$index}}"
                                                       name="delete"
                                                       value="delete" type="text"
                                                       class="form-control translation"
                                                       placeholder="Disabled input" disabled="">
                                            </td>

                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </form>

                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    @foreach($jsonData as $fileName =>$language)--}}
    {{--        @php--}}
    {{--            $extension = str_replace('.json', '', $fileName);--}}
    {{--            $langCode = substr($extension, 0, 2);--}}
    {{--        @endphp--}}
    {{--        @if(key($language)!='')--}}
    {{--            <tr>--}}
    {{--                <td>{{$langCode}}</td>--}}
    {{--                <td>{{ key($language) }}</td>--}}
    {{--                <td>{{ $language[key($language)] }}</td>--}}
    {{--                <td></td>--}}
    {{--            </tr>--}}
    {{--        @endif--}}
    {{--    @endforeach--}}

@endsection