@extends('layouts.app')

@section('content')

  <div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-gray-900 shadow-md border-2 border-white rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-4">
          <label for="email" class="block text-white text-base font-bold mb-2">
              {{ __('all.E-Mail Address') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" id="email" type="email" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
          
      </div>
      <div class="mb-4">
            <label class="block text-white text-base font-bold mb-2" for="password">
              {{ __('all.Password') }}
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-dark @enderror" id="password" type="password" name="password" required autocomplete="current-password" >
                  @error('password')
                      <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
                  @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 border-2 border-white rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('all.Login') }}
        </button>
        @if (Route::has('password.request'))  
            <a class="inline-block align-baseline font-bold text-xs text-gray-400 hover:text-white pl-2" href="{{ route('password.request') }}">
              {{ __('all.Forgot Your Password?') }}
            </a>
        @endif
      </div>
    </form>
    <p class="text-center text-gray-400 text-xs">
      &copy;2019 Charles Jeandey. {{__('all.All rights reserved.')}}.
    </p>
  </div>

@endsection

