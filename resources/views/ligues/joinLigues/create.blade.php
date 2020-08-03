@extends('layouts.app' , ['title' => __('all.Join a league')])

@section('content')
	
<div class="animate__animated animate__fadeInUp w-full lg:w-1/3 mx-auto bg-francagris shadow-md rounded-lg border-2 border-francaverde px-8 py-6 my-4">
    <form class="mx-auto" method="POST" action="{{ route('ligueuser.store') }}">
      @csrf
      @honeypot
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

  @isset($baseligue)
  <div class="animate__animated animate__fadeInUp w-full lg:w-1/3 mx-auto bg-francagris shadow-md rounded-lg border-2 border-francaverde px-8 py-6 my-4 text-white">
    <h3 class="text-francaverde"> Or join the <span class="text-white">{{ $baseligue->name }}</span> available for everybody</h3>
    <p class="py-2">Copy this token and join us: </p>
    <div class="flex">      
        <input id="ligueToken" class="text-base shadow appearance-none border border-francaverde rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-transparent" value="{{ $baseligue->token }}">
        <button class="clipme" data-clipboard-target="#ligueToken">
          <svg class="hover:text-francaverde h-8 w-8 inline-block pl-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
        </button>

      
    </div>    
  </div>
  @endisset
@endsection	 

@push('scripts')

  <script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
  <script>
    document.addEventListener("turbolinks:load", function() {

      new ClipboardJS('.clipme');

    });
  </script>  
@endpush
