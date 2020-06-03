@extends('layouts.app')

@section('content')
	
<div class="w-full lg:w-3/4 m-auto p-1">

	<div class="border-t-4 border-double border-francaverde bg-transparent mb-4 p-1">
		
		<h1 class="text-center text-white text-3xl tracking-wider font-semibold">
			{{ __('nav.ligues')}} Apuestamigo
		</h1>
	</div>

	<div class="flex flex-wrap items-stretch content-start justify-around my-4">

		@foreach ($ligues as $ligue)	

			<x-ligue-card  :ligue="$ligue" />
					
	    @endforeach

	    @include('layouts.partials.cards.ligueCreate')

		@include('layouts.partials.cards.ligueJoin')

	</div>	  	
</div>

	<div class="text-gray-600 text-center uppercase text-xs my-2 md:mt-4">
		<p>
			&copy;2020 charles Jeandey all right reserved, </br> site designed and developped by <span class="text-julienred"> charles Jeandey</span>.
		</p>

	</div>

@endsection
