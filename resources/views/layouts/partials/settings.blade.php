@extends('layouts.app')

@section('content')

<div class="w-3/4 m-auto p-auto">

  @include('layouts/partials/navLigue')

  <h1 class="text-xl text-center text-orange-700 italic">Settings</h1>  

<div class="flex flex-wrap items-stretch content-start justify-around my-4">
  <div class="flex-grow max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@update', $ligue) }}">
      @csrf
      @method('PUT')
      <div class="mb-4">
          <label for="name" class="block text-gray-700 text-base font-bold mb-2">
              {{ __('Changer le nom de cette ligue? ') }} </hr>{{ $ligue->name }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') bg-red-dark @enderror" id="name" type="text" placeholder="nom de la ligue" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('Changer ') }}
        </button>
      </div>
    </form>
  </div>
  <div class="flex-grow max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@destroy', $ligue) }}">
      @csrf
      @method('DELETE')
      <div class="mb-4">
          <div class="block text-gray-700 text-base font-bold mb-2">
              {{ __('Supprimer cette ligue? ') }} </hr>{{ $ligue->name }}
          </div>
          <p class="block text-red-500 text-sm font-bold mb-2">Attention, cette action est irréversible.</p>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('Supprimer ') }}
        </button>
      </div>
    </form>
  </div>
</div>

@endsection
