@extends('layouts.app')

@section('content')
	
	<div class="w-full lg:w-3/4 m-auto p-1">

		<div class="border-t-4 border-double border-francaverde bg-transparent mb-4 p-1">
			<h1 class="text-center text-white text-3xl tracking-wider font-semibold">
				{{ __('all.Dashboard') }}
			</h1>
		</div>

		<div class="flex flex-wrap items-stretch content-start justify-around my-4 animated bounceInUp">

			@include('layouts.partials.cards.ligueCreate')

			@include('layouts.partials.cards.ligueJoin')

	    </div>	   	
	</div>

	<div class="text-gray-600 text-center uppercase text-xs my-2 md:mt-4">
		<p>
			&copy; {{ date('Y') }} &middot; charles jeandey all right reserved, </br> site designed and developped by <a href="https://www.linkedin.com/in/charles-jeandey" target="_blank"><span class="text-julien-red">carlito</span></a>.
		</p>

	</div>

@endsection
