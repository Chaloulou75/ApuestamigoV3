@extends('layouts.app')

@section('content')
	
<div class="w-full lg:w-3/4 m-auto p-1">

	<div class="border-t-4 border-double border-francaverde bg-transparent mb-4 p-1">
		
		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-semibold">
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

@endsection
