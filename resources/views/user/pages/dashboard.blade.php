@extends('user.pages.layout')

@section('dashboard')
    <div class="main-content">
        <!-- Page Header -->
        <div class="block justify-between page-header md:flex">

        </div>
        <!-- Page Header Close -->

        <div class="flex justify-center align-middle">
            <div style="width: 300px" class="xxxl:col-span-6 col-span-12">
                <div class=" grid-cols-12 gap-x-6">
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.3rem] text-center  gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3" href="{{route('midjourney')}}">AI ფოტო
                                    <span  style="font-size: 0.8rem;display: block;color: #ffffffB3">(Midjourney)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.3rem] text-center  gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3" href="{{route('flux-schnell')}}">AI ფოტო
                                    <span  style="font-size: 0.8rem;display: block;color: #ffffffB3">(Flux schnell)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box ">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.9rem] text-center gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3"  href="{{route('bg.remove')}}">ფონის წაშლა</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex justify-center align-middle mt-5">

            <div style="width: 300px" class="xxxl:col-span-6 col-span-12">
                <p>უფასო</p>
                <div class=" grid-cols-12 gap-x-6">
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.9rem] text-center  gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3" href="{{route('bg.add')}}">ფონის შეცვლა (ფოტო)</a>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.9rem] text-center  gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3" href="{{route('bg.add.color2')}}">ფონის შეცვლა (ფერი)</a>
                            </div>
                        </div>
                    </div>
                    <div class="xxl:col-span-4 md:col-span-6 col-span-12">
                        <div class="box ">
                            <div style="padding-top:5px;padding-bottom: 5px" class="box-body !pb-[0.9rem] text-center gradient-background">
                                <a style="font-size: 1.5rem;font-weight: bold;color: #ffffffB3"  href="{{route('bg.remove')}}">ფონის წაშლა</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection