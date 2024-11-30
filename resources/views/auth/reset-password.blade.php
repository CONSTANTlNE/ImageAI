@extends('auth.layout')

@section('reset-password')
  <div class="xxl:col-span-4 xl:col-span-3 lg:col-span-3 md:col-span-6 sm:col-span-2 col-span-12">

  </div>
<div class="xxl:col-span-4 xl:col-span-6 lg:col-span-6 md:col-span-6 sm:col-span-8 col-span-12">
  <div class="flex justify-center items-center h-full">
    <div class="p-[3rem] registerdiv">
      <div class="mb-4">
        <a class="flex justify-center" aria-label="anchor" href="{{route('index')}}">
          <img  src="{{asset('landingassets/img/onix.jpeg')}}" alt=""
               class="authentication-brand desktop-logo">
          <img  src="{{asset('landingassets/img/onix.jpeg')}}" alt=""
               class="authentication-brand desktop-dark">
        </a>
      </div>
       @if($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
      <form action="{{route('password.update')}}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
      <div class="grid grid-cols-12 ">
        <div class="xl:col-span-12 col-span-12 mb-4 text-center">
          <input name="email" type="email" class="form-control form-control-lg w-full !rounded-md "
                 id="signin-username" placeholder="{{__('please enter email')}}" value="{{$request->email}}">
          @error('email')
          <span class="text-danger " role="alert">{{$message}}</span>
          @enderror
        </div>
        <div class="xl:col-span-12 col-span-12 mb-4">
          <div class="input-group">
            <input type="password" name="password" class="form-control form-control-lg !border-s border-defaultborder dark:border-defaultborder/10 !rounded-e-none" id="signup-password" placeholder="{{__('Password')}}">
            <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" onclick="createpassword('signup-password',this)" type="button" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
          </div>
          @error('password')
          <span class="text-danger " role="alert">{{$message}}</span>
          @enderror
        </div>
        <div class="xl:col-span-12 col-span-12 mb-4">
          <div class="input-group">
            <input type="password" name="password_confirmation" class="form-control !border-s border-defaultborder dark:border-defaultborder/10 form-control-lg !rounded-e-none" id="signup-confirmpassword" placeholder="{{__('confirm password')}}">
            <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" onclick="createpassword('signup-confirmpassword',this)" type="button" id="button-addon21"><i class="ri-eye-off-line align-middle"></i></button>
          </div>

        </div>
        <div class="xl:col-span-12 col-span-12 grid ">
          <button  class="startSpinner ti-btn ti-btn-lg bg-primary text-white !font-medium dark:border-defaultborder/10">{{__('Update Password')}}</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection