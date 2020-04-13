@extends('layouts.app')

@section('content')
               

<div class="w-full max-w-xs lg:max-w-xl lg:w-2/3 m-auto p-auto pt-8">

	<div class="border-t-4 border-double border-julienred bg-transparent mb-4 p-1 animated bounceInRight">
  		<h1 class="text-center text-gray-800 text-3xl tracking-wider font-semibold">{{ __('nav.about') }}</h1>
  	</div>

  	<div class="border-2 border-solid border-julienred rounded py-4 px-4 bg-teal-100 shadow-2xl animated bounceInUp">

	  	<h2 class="text-juliengris text-2xl mb-2">{{ __('all.So how does Apuestamigo work?')}}</h2>

	  	<p class="text-juliengris text-justify mb-2 ">
	  		{{ __('all.No, Apuestamigo is not yet another online betting site ...' ) }}</br>
	  		{{ __('all.Well, yes, necessarily a little, but differently. This is just to guide you the first few days, the rest will come by itself.') }}</br></br>

			1/ {{ __('all.After you have registered and / or identified, create a league with your friends or colleagues (or more, there is no limit of players per league, but it\'s still much more fun with your friends and acquaintances). You will challenge your friends during a Champions League season until the evening of the final to find out who is the best tipster in the band.') }}</br></br>

			2/ {{ __('all.Once your league has been created, you share it with your friends by sending them the token found in the league settings. They can join you in a league once registered by inserting the token. Nothing too complicated.') }}</br></br>

			3/ {{ __('all.Your league can then begin: each round of the Champions League corresponds to an Apuestamigo day in which you compete. Do not forget to make your predictions before each round of the Champions League, after the start of the first match, it will be TOO LATE! (and no need to bribe the administrator, he can\'t do anything for you ...)') }}</br></br>

			4/ {{ __('all.Over the course of the matches, your ranking evolves in front of your friends (an exact score found gives 3 points / good result but not exact 1 point / the rest 0). The champion is of course the one with the most points at the end of the season.') }}</br></br>

	  	</p>
	  	<p class="text-white text-xl"> {{ __('all.Go! It\'s your turn!') }}</p>

  	</div>


</div>

@endsection
