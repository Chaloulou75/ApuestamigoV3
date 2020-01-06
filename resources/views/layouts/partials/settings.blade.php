@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')

<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
    <div class="tooltip">
      <p class="font-medium">{{ __('all.Share this league:') }}</p>
      <input id="copyToken" class="text-base shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-transparent" value="{{ $ligue->token }}" onclick="copyTok()" onmouseout="outFunc()"><span class="tooltiptext bg-teal-600" id="myTooltip">{{ __('all.Copy to clipboard') }}</span>
    </div>
  </div>
</div>

<div class="flex flex-wrap items-stretch content-start justify-around my-4">

  <div class="flex-grow w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md border-t-4 border-red-500 rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@quitLigue', $ligue) }}">
      @csrf
      <div class="mb-4">
          <div class="w-full text-gray-900 text-base font-medium mb-2">
              {{ __('all.Leave this league?') }} </hr>{{ $ligue->name }}
          </div>
      </div>
      <div class="flex items-center justify-between">
          <button class="w-full bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            {{ __('all.Leave') }}
          </button>
      </div>
    </form>
  </div>

  <div class="flex-grow w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md border-t-4 border-teal-500 rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@update', $ligue) }}">
      @csrf
      @method('PUT')
      <div class="mb-4">
          <label for="name" class="block text-gray-900 text-base font-medium mb-2">
              {{ __('all.Change the name of the league?') }} </hr>{{ $ligue->name }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') bg-red-dark @enderror" id="name" type="text" placeholder="nom de la ligue" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-gray-900 hover:bg-white text-white hover:text-gray-900 font-medium py-2 px-4 border-2 border-gray-700 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('all.Change') }}
        </button>
      </div>
    </form>
  </div>

  <div class="flex-grow w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded border-t-4 border-red-500 px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@destroy', $ligue) }}">
      @csrf
      @method('DELETE')
      <div class="mb-4">
          <div class="block text-gray-900 text-base font-medium mb-2">
              {{ __('all.Delete this league?') }} </hr>{{ $ligue->name }}
          </div>
          <p class="block text-red-500 text-sm font-medium mb-2">{{ __('all.Please note, this action is irreversible.') }} </p>
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          {{ __('all.Delete') }}
        </button>
      </div>
    </form>
  </div>
  
</div>

@endsection
