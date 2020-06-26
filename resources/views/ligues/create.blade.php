@extends('layouts.app')

@section('content')

  <div class="animate__animated animate__fadeInUp w-full lg:w-1/3 mx-auto bg-francagris shadow-md rounded-lg border-2 border-francaverde px-8 py-6 my-4">
    <form class="mx-auto" method="POST" action="{{ route('ligues.store') }}">
      @csrf
      @honeypot
      <div class="mb-4">
          <label for="name" class="block text-white text-base font-medium mb-2">
              {{ __('all.What\'s the name of your league?') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline @error('name') bg-red-dark @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
              @error('name')
                  <p class="text-julienred text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
          
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-francagris border-2 border-francaverde text-white hover:text-francaverde font-base py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
          {{ __('nav.creer') }}
        </button>
      </div>
    </form>
  </div>

@endsection
