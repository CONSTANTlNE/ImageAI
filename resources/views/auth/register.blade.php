@extends('auth.layout')

@section('register')
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
      <div class="btn-list text-center">
        <a  href="{{route('google.login')}}"
            class="ti-btn ti-btn-lg ti-btn-light !font-medium me-[0.365rem] dark:border-defaultborder/10">
          <svg
                  class="google-svg" xmlns="http://www.w3.org/2000/svg" width="2443" height="2500"
                  preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
            <path fill="#4285F4"
                  d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"/>
            <path fill="#34A853"
                  d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"/>
            <path fill="#FBBC05"
                  d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"/>
            <path fill="#EB4335"
                  d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"/>
          </svg>
          რეგისტრაცია
        </a>
      </div>
      <div class="text-center my-[1.5rem] authentication-barrier">
        <span>OR</span>
      </div>
      <form action="{{route('register')}}" method="post">
        @csrf
      <div class="grid grid-cols-12 ">
        <div class="xl:col-span-12 col-span-12 mb-4">
          <input type="text" value="{{old('name')}}" name="name" class="form-control form-control-lg w-full !rounded-md" id="signup-firstname" placeholder="first name">
          @error('name')
          <span class="text-danger " role="alert">{{$message}}</span>
          @enderror
        </div>
        <div class="xl:col-span-12 col-span-12 mb-4">
          <input type="email"  value="{{old('email')}}" name="email" class="form-control form-control-lg w-full !rounded-md" id="signup-lastname" placeholder="Email">
          @error('email')
          <span class="text-danger " role="alert">{{$message}}</span>
          @enderror
        </div>
        <div class="xl:col-span-12 col-span-12 mb-4">
          <div class="input-group">
            <input type="password" name="password" class="form-control form-control-lg !border-s border-defaultborder dark:border-defaultborder/10 !rounded-e-none" id="signup-password" placeholder="password">
            <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" onclick="createpassword('signup-password',this)" type="button" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
          </div>
          @error('password')
          <span class="text-danger " role="alert">{{$message}}</span>
          @enderror
        </div>
        <div class="xl:col-span-12 col-span-12 mb-4">
          <div class="input-group">
            <input type="password" name="password_confirmation" class="form-control !border-s border-defaultborder dark:border-defaultborder/10 form-control-lg !rounded-e-none" id="signup-confirmpassword" placeholder="confirm password">
            <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" onclick="createpassword('signup-confirmpassword',this)" type="button" id="button-addon21"><i class="ri-eye-off-line align-middle"></i></button>
          </div>
          <div class="form-check mt-4 flex !ps-0 ">
            <input class="form-check-input align-middle" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label text-[#8c9097] dark:text-white/50 font-normal inline" for="defaultCheck1">
              By creating a account you agree to our <a href="terms.html" class="text-success"><u>&nbsp;Terms &amp; Conditions</u></a>&nbsp; and&nbsp; <a class="text-success"><u>Privacy Policy</u></a>
            </label>
          </div>
        </div>
        <div class="xl:col-span-12 col-span-12 grid ">
          <button  class="startSpinner ti-btn ti-btn-lg bg-primary text-white !font-medium dark:border-defaultborder/10">Create Account</button>
        </div>
      </div>
      </form>
      <div class="text-center">
        <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mt-4">Already have an account? <a href="{{route('login')}}" class="text-primary">Sign In</a></p>
      </div>
    </div>
  </div>
</div>

@endsection