@extends('admin.layout')

@section('staticTranslation')

    @php
        //                dd($allKeys);
    @endphp

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
                                <table class="text-center" id="static-lang" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Abbr</th>
                                        <th style="text-align: center">Key</th>
                                        <th style="text-align: center">Translation</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = -1; // Initialize counter variable
                                    @endphp

                                    @foreach($locales as $index => $locale)
                                        @foreach($jsonData[$locale['abbr']] as $key =>$language)
                                            {{--  @php dd($index2) @endphp--}}
                                            @php
                                                $counter++;
                                            @endphp


                                            <tr>
                                                @csrf
                                                <td>

                                                    <input data-abbr="{{$counter}}" name="abbr" style="max-width: 50px"
                                                           value="{{$locale['abbr']}}" type="text" id="input-disabled"
                                                           class="form-control" placeholder="Disabled input"
                                                           disabled="">
                                                </td>
                                                <td>
                                                   <p style="display: none"> {{ $key }}</p>
                                                    <input data-key="{{$counter}}" name="key" value="{{ $key }}"
                                                           type="text"
                                                           id="input-disabled"
                                                           class="form-control key" placeholder="Disabled input"
                                                           disabled="">
                                                </td>
                                                <td>
                                                    <p style="display: none">{{$language}}</p>
                                                    <input data-translation="{{$counter}}" name="translation"
                                                           value="  {{$language}}" type="text"
                                                           id="input-disabled" class="form-control translation"
                                                           placeholder="Disabled input" disabled="">
                                                </td>
                                                <td class="flex justify-center align-middle gap-2">
                                                <span data-edit="{{$counter}}"
                                                      style="cursor: pointer;color:blue"
                                                      class="material-symbols-outlined edit-translation">edit</span>
                                                    <span data-submit="{{$counter}}"
                                                          style="display: none;cursor: pointer;color:green"
                                                          class="material-symbols-outlined">done</span>
                                                    <span data-cancel-submit="{{$counter}}"
                                                          style="display: none;cursor: pointer;color:red"
                                                          class="material-symbols-outlined">close</span>
                                                    <span data-delete="{{$counter}}"
                                                          style="display: none;cursor: pointer;color:red"
                                                          class="material-symbols-outlined">delete</span>
                                                    <input style="display:none" data-deleteInput="{{$counter}}" name="delete"
                                                           value="delete" type="text"
                                                           id="input-disabled" class="form-control translation"
                                                           placeholder="Disabled input" disabled="">
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
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