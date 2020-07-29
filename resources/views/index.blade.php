@extends('layouts.app')

@section('content')
	
	<div class="w-full lg:w-3/4 mx-auto">

		<div class="border-t-2 border-double border-francaverde bg-transparent ">
			<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-medium my-4">
				{{ __('all.Dashboard') }}
			</h1>
		</div>

		<div class="flex flex-wrap items-stretch content-start justify-around my-4">

			@include('ligues.partials.cards.index')

			@include('ligues.joinLigues.index')

	    </div>	   	
	</div>

@endsection
