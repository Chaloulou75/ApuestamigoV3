@extends('layouts.app')

@section('content')
	
<div class="animate__animated animate__fadeInUp w-full lg:w-1/3 mx-auto bg-francagris shadow-md rounded-lg border-2 border-francaverde px-8 py-6 my-4">
    <form class="mx-auto" method="POST" action="{{ route('joinLigues') }}">
      @csrf
      <div class="mb-4">
          <label for="token" class="block text-white text-base font-medium mb-2">
              {{ __('all.Insert the token of the league' ) }}:
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline @error('token') bg-red-dark @enderror" id="token" type="text" placeholder="Token" name="token" value="{{ old('token') }}" required autocomplete="token" autofocus>
              @error('token')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
          
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-francagris border-2 border-francaverde text-white hover:text-francaverde font-base py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
          {{ __('all.Join a league') }}
        </button>
      </div>
    </form>
  </div>

@endsection	   
