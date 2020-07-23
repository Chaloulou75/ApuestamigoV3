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
      <div class="py-1">
        <svg class="fill-current h-6 w-6 text-francaverde mr-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
      </div>
      <div class="tooltip">
        <input id="copyToken" class="text-base shadow appearance-none border border-francaverde rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-transparent" value="{{ $baseligue->token }}" onclick="copyTok()" onmouseout="outFunc()">
        <span class="tooltiptext bg-francaverde" id="myTooltip">{{ __('all.Copy to clipboard') }}</span>
      </div>
    </div>    
  </div>
  @endisset
@endsection	 

@push('scripts')

<script>
//copie du token
document.addEventListener("turbolinks:load", function() {

    document.getElementById("copyToken").onclick = function copyTok() {
    var copyText = document.getElementById("copyToken");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copié: " + copyText.value;
    }
});

document.addEventListener("turbolinks:load", function() {
    function outFunc() {
      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copy token";
    }
});

</script>  
@endpush
