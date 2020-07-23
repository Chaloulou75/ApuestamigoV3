@extends('layouts.app' , ['title' => __('nav.about') ])

@section('content')
               

<div class="w-full lg:w-1/2 mx-auto">

	<div class="border-t-4 border-double border-francaverde bg-francagris mb-4">
  		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-medium pt-4">{{ __('nav.about') }}</h1>
  	</div>

  	<div class="animate__animated animate__fadeIn animate__slow border-2 border-solid border-francaverde rounded py-4 px-4 bg-francagris shadow-2xl">

	  	<h2 class="text-white tracking-wide text-2xl mb-2"><svg class="inline-block w-10 h-10 pr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>{{ __('all.So how does Apuestamigo work?')}}</h2>

	  	<p class="text-white tracking-wide mb-2">
	  		{{ __('all.No, Apuestamigo is not yet another online betting site ...' ) }}</br>
	  		{{ __('all.Well, yes, necessarily a little, but differently. This is just to guide you the first few days, the rest will come by itself.') }}</br></br>

			1/ {{ __('all.After you have registered and / or identified, create a league with your friends or colleagues (or more, there is no limit of players per league, but it\'s still much more fun with your friends and acquaintances). You will challenge your friends during a Champions League season until the evening of the final to find out who is the best tipster in the band.') }}</br></br>

			2/ {{ __('all.Once your league has been created, you share it with your friends by sending them the token found in the league settings. They can join you in a league once registered by inserting the token. Nothing too complicated.') }}</br></br>

			3/ {{ __('all.Your league can then begin: each round of the Champions League corresponds to an Apuestamigo day in which you compete. Do not forget to make your predictions before each round of the Champions League, after the start of the first match, it will be TOO LATE! (and no need to bribe the administrator, he can\'t do anything for you ...)') }}</br></br>

			4/ {{ __('all.Over the course of the matches, your ranking evolves in front of your friends (an exact score found gives 3 points / good result but not exact 1 point / the rest 0). The champion is of course the one with the most points at the end of the season.') }}</br></br>

	  	</p>
	  	<p class="text-white text-xl"> {{ __('all.Go! It\'s your turn!') }} <svg class="inline-block w-8 h-8 pl-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></p>
  	</div>
</div>
@endsection
