@extends('layouts.app' , ['title' => __('nav.about') ])

@section('content')
               

<div class="w-full lg:w-1/2 mx-auto" 
	x-data="{ 'showModal': false }" 
	x-on:keydown.escape="showModal = false" 
	x-cloak>

	<div class="border-t-4 border-double border-francaverde bg-francagris mb-4">
		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-medium pt-4">{{ __('nav.about') }}</h1>
	</div>

	<section class="flex flex-wrap p-4 h-full items-center justify-center">

	  	<button type="button" class="bg-transparent border border-francaverde text-white hover:text-francaverde font-thin py-4 px-8 rounded-lg focus:outline-none" 
	  	x-on:click="showModal = true">
	  		{{__('all.What\'s all about?')}}
	  	</button>

	  	<div class="overflow-auto bg-gray-900" 
	  		x-show="showModal" 
	  		x-bind:class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">

	  		<div class="bg-francagris border-2 border-francaverde rounded py-4 px-4 m-2 lg:m-8 text-sm shadow-2xl"
		  	x-show="showModal"
		  	x-on:click.away="showModal = false" 
		  	x-transition:enter="transition duration-300 transform ease-out" 
		  	x-transition:enter-start="scale-75"  
		  	x-transition:leave="transition duration-200 transform ease-in" 
		  	x-transition:leave-end="opacity-0 scale-90">

		  		<div class="flex justify-between items-center pb-3">
					<h2 class="text-white tracking-wide mb-2">
						<svg class="inline-block w-8 h-8 pr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
							<path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
							</path>
						</svg>
						{{ __('all.So how does Apuestamigo work?')}}
					</h2>
					<div class="cursor-pointer z-50" x-on:click="showModal = false">
						<svg class="fill-current text-gray-400 hover:text-francaverde" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>

			  	<p class="text-white text-sm tracking-wide mb-2">

					1/ {{ __('all.After you have registered and / or identified, create a league with your friends or colleagues (or more, there is no limit of players per league, but it\'s still much more fun with your friends and acquaintances). You will challenge your friends during a Champions League season until the evening of the final to find out who is the best tipster in the band.') }}</p>
				<p class="text-white text-sm tracking-wide mb-2">

					2/ {{ __('all.Once your league has been created, you share it with your friends by sending them the token found in the league settings. They can join you in a league once registered by inserting the token. Nothing too complicated.') }}</p>

				<p class="text-white text-sm tracking-wide mb-2">
					3/ {{ __('all.Your league can then begin: each round of the Champions League corresponds to an Apuestamigo day in which you compete. Do not forget to make your predictions before each round of the Champions League, after the start of the first match, it will be TOO LATE! (and no need to bribe the administrator, he can\'t do anything for you ...)') }}</p>

			  	<!--Footer-->
				<div class="flex justify-between pt-2">
					<button type="button"  class="px-4 bg-transparent p-3 rounded-lg text-white hover:text-francaverde mr-2"><a href="{{ route('home') }}"> <svg class="inline-block w-6 h-6 pl-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> {{ __('all.Go! It\'s your turn!') }}</a></button>
					<button class="modal-close px-4 bg-transparent p-3 rounded-lg text-sm text-white hover:text-francaverde" x-on:click="showModal = false">{{ __('all.Close') }}</button>
				</div>
	  		</div>
	  	</div>
  	</section>
</div>

@endsection
