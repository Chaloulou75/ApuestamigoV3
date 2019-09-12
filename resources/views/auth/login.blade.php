@extends('layouts.app')

@section('content')

  <div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-4">
          <label for="email" class="block text-gray-700 text-base font-bold mb-2">
              {{ __('E-Mail Address') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" id="email" type="email" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
          
      </div>
      <div class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="password">
              {{ __('Password') }}
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-dark @enderror" id="password" type="password" name="password" required autocomplete="current-password" >
                  @error('password')
                      <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
                  @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('Sign In') }}
        </button>
        @if (Route::has('password.request'))  
            <a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-teal-800" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </div>
    </form>
    <p class="text-center text-gray-600 text-xs">
      &copy;2019 Charles Jeandey. All rights reserved.
    </p>
  </div>

@endsection

