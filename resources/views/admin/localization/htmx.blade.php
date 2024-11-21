<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Basic DataTable</h5>
            </div>
            <div class="box-body">
                <div class="overflow-auto">
                    <div id="basic-table" class="ti-custom-table ti-striped-table ti-custom-table-hover">
                        <table  class="text-center" id="lang" class="display" style="width:100%">
                            <thead >
                            <tr>
                                <th style="text-align: center">key</th>
                                <th style="text-align: center">Language</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Main</th>

                                <th style="text-align: center">action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($languages as $index =>$language)
                                <tr>
                                    <td>{{$language->abbr}}</td>
                                    <td>{{$language->language}}</td>
                                    <td class="flex justify-center align-middle">
                                        <form data-descr="langStatusForm" id="langStatusForm{{$index}}" action="{{route('updateLangStatus')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$language->id}}">
                                            <div class="custom-toggle-switch  mb-4">
                                                <input data-descr="langSwitch" id="langStatusSwitch{{$index}}" name="toggleswitch005" type="checkbox" @if($language->active===1) checked @endif>
                                                <label for="langStatusSwitch{{$index}}" class="label-success"></label><span class="ms-3"></span>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form style="cursor:pointer" action="{{route('setMainLang')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$language->id}}">
                                            <button style="all:unset">
                                             <span
                                                     @if($language->main===1) style="color: green" @endif
                                             class="material-symbols-outlined">done</span>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($language->main!==1)
                                            <form action="{{route('deleteLanguage')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$language->id}}">
                                                <input type="hidden" name="abbr" value="{{$language->abbr}}">
                                                <button style="all:unset;color:red;cursor:pointer">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            {{--                                <tfoot>--}}
                            {{--                                <tr>--}}
                            {{--                                    <th>Abbr</th>--}}
                            {{--                                    <th>Language</th>--}}
                            {{--                                    <th>Status</th>--}}
                            {{--                                    <th>Main</th>--}}
                            {{--                                </tr>--}}
                            {{--                                </tfoot>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>