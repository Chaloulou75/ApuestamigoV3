@extends('layouts.app')

@section('content')
	
<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('joinLigues') }}">
      @csrf
      <div class="mb-4">
          <label for="token" class="block text-gray-700 text-base font-bold mb-2">
              {{ __('Insérer le token de la ligue') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('token') bg-red-dark @enderror" id="token" type="text" placeholder="token de la ligue" name="token" value="{{ old('token') }}" required autocomplete="token" autofocus>
              @error('token')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
          
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('Rejoindre la ligue') }}
        </button>
      </div>
    </form>
  </div>

@endsection	   
