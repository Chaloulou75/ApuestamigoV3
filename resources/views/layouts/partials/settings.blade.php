@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')

<div class="bg-white border-t-4 border-francaverde rounded-b text-gray-900 px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
    <div class="tooltip">
      <p class="font-medium"><svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        {{ __('all.Share this league:') }}
      </p>
      <input id="copyToken" class="text-base shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-transparent" value="{{ $ligue->token }}" onclick="copyTok()" onmouseout="outFunc()"><span class="tooltiptext bg-teal-600" id="myTooltip">{{ __('all.Copy to clipboard') }}</span>
    </div>
  </div>
</div>

<div class="flex flex-wrap items-stretch content-start justify-around my-4">

  <div class="flex-grow w-full max-w-xs lg:w-1/3 mx-auto pt-8">
    <form class="bg-white shadow-md border-t-4 border-francaverde rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@quitLigue', $ligue) }}">
      @csrf
      <div class="mb-4">
          <div class="w-full text-gray-900 text-base font-medium mb-2">
              {{ __('all.Leave this league?') }} </hr>{{ $ligue->name }}
          </div>
      </div>
      <div class="flex items-center justify-between">
          <button class="w-full bg-julienred hover:bg-red-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            {{ __('all.Leave') }}
            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
          </button>
      </div>
    </form>
  </div>

  <div class="flex-grow w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md border-t-4 border-francaverde rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@update', $ligue) }}">
      @csrf
      @method('PUT')
      <div class="mb-4">
          <label for="name" class="block text-gray-900 text-base font-medium mb-2">
              {{ __('all.Change the name of the league?') }} </hr>
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') bg-red-dark @enderror" id="name" type="text" placeholder="{{ $ligue->name }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                  <p class="text-red-500 text-xs italic"><strong>{{ $message }}</strong></p>    
              @enderror
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-francagris text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
          <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
          {{ __('all.Change') }}
        </button>
      </div>
    </form>
  </div>

  <div class="flex-grow w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <form class="bg-white shadow-md rounded border-t-4 border-francaverde px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('LigueController@destroy', $ligue) }}">
      @csrf
      @method('DELETE')
      <div class="mb-4">
          <div class="block text-gray-900 text-base font-medium mb-2">
              {{ __('all.Delete this league?') }} </hr>{{ $ligue->name }}
          </div>
          <p class="block text-red-500 text-sm font-medium mb-2">{{ __('all.Please note, this action is irreversible.') }} </p>
      </div>
      <div class="flex items-center justify-between">
        <button class="w-full bg-julienred hover:bg-red-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
          {{ __('all.Delete') }}
        </button>
      </div>
    </form>
  </div>
  
</div>

@endsection
