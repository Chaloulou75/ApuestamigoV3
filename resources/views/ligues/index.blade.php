@extends('layouts.app', ['title' => __('nav.ligues') ])

@section('content')
	
<div class="w-full lg:w-3/4 m-auto">

	<div class="border-t-2 border-double border-francaverde bg-transparent">
		
		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-medium my-4">
			{{ __('nav.ligues')}} Apuestamigo
		</h1>
	</div>

	<div class="flex flex-wrap items-stretch content-start justify-around my-4">

		@foreach ($user->ligues as $ligue)	

			<x-ligue-card  :ligue="$ligue" />
					
	    @endforeach

	    @include('ligues.partials.cards.index')

		@include('ligues.joinLigues.index')

	</div>	  	
</div>

@endsection
