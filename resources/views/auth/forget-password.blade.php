@extends('auth.layout')

@section('forgot-password')
    <div class="xxl:col-span-4 xl:col-span-3 lg:col-span-3 md:col-span-6 sm:col-span-2 col-span-12">

    </div>
    <div class="xxl:col-span-4 xl:col-span-6 lg:col-span-6 md:col-span-6 sm:col-span-8 col-span-12">
        <div class="p-[3rem]">
            <div class="mb-4">
                <a class="flex justify-center" aria-label="anchor" href="{{route('index')}}">
                    <img src="{{asset('landingassets/img/onix.jpeg')}}" alt=""
                         class="authentication-brand desktop-logo">
                    <img  src="{{asset('landingassets/img/onix.jpeg')}}" alt=""
                         class="authentication-brand desktop-dark">
                </a>
            </div>
            @if (session('status'))

                <div  style="color: blue"  class="text-center mb-4 font-bold  text-sm text-green-600">
                    <span class="text-primary mt-3" role="alert">{{session('status')}}</span>
                </div>
            @endif
            <form class="flex justify-center" action="{{route('password.email')}}" method="post">
                @csrf
                <div style="max-width: 370px" class="grid grid-cols-12">
                    <div class="xl:col-span-12 col-span-12 mb-4 text-center">
{{--                        <label for="signin-username" class="form-label text-default">{{__('Email')}}</label>--}}
                        <input name="email" type="email" class="form-control form-control-lg w-full !rounded-md "
                               id="signin-username" placeholder="{{__('please enter email')}}">
                        @error('email')
                        <span class="text-danger mt-3" role="alert">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="xl:col-span-12 col-span-12 grid">
                        <button
                                class=" ti-btn ti-btn-lg bg-primary text-white !font-medium dark:border-defaultborder/10">
                         {{__('Rest Password')}}
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mt-4">{{__('Dont have an account?')}} <a
                            href="{{route('register')}}" class="text-primary">{{__('Register')}}</a>
                </p>
            </div>
        </div>
    </div>



@endsection