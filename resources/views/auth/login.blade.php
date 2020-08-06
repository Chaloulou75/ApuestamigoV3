@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-4">
  <div class="flex flex-wrap justify-center">
    <div class="w-full max-w-sm">
      <div class="animate__animated animate__headShake flex flex-col break-words bg-francagris text-white border-2 border-francaverde rounded shadow-md">
        <div class="font-normal bg-francagris text-francaverde py-3 px-6 mb-0">
            {{ __('all.Login') }}
        </div>

        <form class="w-full py-2 px-6" method="POST" action="{{ route('login') }}">
          @csrf
          @honeypot
          
          <div class="flex flex-wrap mb-6">
            <label for="email" class="block text-sm font-normal mb-2">
                {{ __('all.E-Mail Address') }}:
            </label>

            <input id="email" type="email" class="w-full shadow appearance-none border rounded w-full py-2 px-3 text-francagris mb-3 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <p class="text-red-500 text-xs italic mt-1">
                    {{ $message }}
                </p>
            @enderror
          </div>

          <div class="flex flex-wrap mb-6">
            <label for="password" class="block text-sm font-normal mb-2">
                {{ __('all.Password') }}:
            </label>

            <input id="password" type="password" class="w-full shadow appearance-none border rounded w-full py-2 px-3 text-francagris mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <p class="text-red-500 text-xs italic mt-1">
                    {{ $message }}
                </p>
            @enderror
          </div>

          <div class="flex mb-6">
            <label class="inline-flex items-center text-sm font-normal" for="remember">
                <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                <span class="ml-2">{{ __('Remember Me') }}</span>
            </label>
          </div>

          <div class="flex flex-wrap">
            <button type="submit" class="inline-block align-middle text-center select-none whitespace-no-wrap text-base leading-normal no-underline w-full bg-francagris text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline">
                {{ __('all.Login') }}
            </button>

            @if (Route::has('password.request'))  
            <p class="w-full text-xs text-center my-4">
              <a class="inline-block align-baseline hover:text-francaverde text-xs py-2" href="{{ route('password.request') }}">
                {{ __('all.Forgot Your Password?') }}
              </a>
            </p>
            @endif

            <p class="w-full text-xs text-center my-4">
                {{ __("all.Don't have an account?") }}
                <a class="hover:text-francaverde uppercase tracking-wide underline" href="{{ route('register') }}">
                    {{ __('all.Register') }}
                </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

