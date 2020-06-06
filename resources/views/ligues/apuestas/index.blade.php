@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  

	@livewire('next-game')
  
	<div class="text-francagris">

		@auth		
			<h3 class="text-base text-left text-white tracking-wide py-2">{{__('all.Hey')}} <span class="text-francaverde">{{$user->name}}</span>, {{__('all.let\'s play')}}.</h3>
		@endauth
		@guest	
			<h3 class="text-base text-left text-francaverde tracking-wide py-2">{{__('all.Hey')}}, {{__('all.you have to login or register to play.')}}</h3>
		@endguest

		<form method="POST" action="{{ action('ApuestasController@store', $ligue) }}"> 
			@csrf

		<div class="table w-full bg-white shadow-md border-4 border-solid border-francaverde rounded-lg text-sm text-francagris"> 
		    <div class="table-row w-full mx-auto border border-solid border-francaverde">
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold hidden md:table-cell">{{__('all.Date')}}</div>
		      <div class="table-cell px-1 py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold ">{{__('all.Home')}}</div>
		      <div class="table-cell px-1 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee - 1]) }}"> < </a></div>
		      <div class="table-cell px-1 py-4 text-center"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold"> {{ $journee }}</div>
		      <div class="table-cell px-1 py-4 text-center"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee + 1]) }}"> > </a></div>
		      <div class="table-cell px-1 py-4 text-center font-bold ">{{__('all.Away')}}</div>
		      <div class="table-cell px-1 py-4 text-left hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-left font-bold ">{{__('all.Points')}}</div>
		    </div>		    			  

			@foreach ($games as $key => $game)	

		    <div class="table-row mx-auto border border-solid rounded border-francaverde"> 
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell">  {{ $loop->iteration }} </div>
		      <div class="table-cell px-1 py-4 text-center text-xs hidden md:table-cell">  {{ \Carbon\Carbon::parse($game->gamedate)->format(' j F Y H:i') }} </div>
			  <div class="table-cell px-1 py-4 text-right font-bold hidden md:table-cell"> {{ $game->homeTeam->name }} </div>
			  <div class="table-cell px-1 py-4 text-center"> <img class="inline" loading="lazy" src="{{ URL::to('/img/' .$game->homeTeam->logo) }}"></div>
			  <div class="table-cell px-1 py-4 text-center">
				<label for="resultatEq1"></label>
				<select id="resultatEq1" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq1[]" value="">
					<option> @isset($game->matchs->first()['resultatEq1']) {{ $game->matchs->first()['resultatEq1'] }} @endisset </option>
					<option value="0">0</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	                <option value="3">3</option>
	                <option value="4">4</option>
	                <option value="5">5</option>
	                <option value="6">6</option>
	                <option value="7">7</option>
	                <option value="8">8</option>
	                <option value="9">9</option>
	            </select>
			  </div>
			  <div class="table-cell px-1 py-4 text-center text-red"> 
			  	@if(isset($resultAdmin->matchs[$key]->resultatEq1) 
			  	&& isset($resultAdmin->matchs[$key]->game_id) 
			  	&& $game->id == $resultAdmin->matchs[$key]->game_id)
			  	{{ $resultAdmin->matchs[$key]->resultatEq1 }} @endif 
			  </div>
			  <div class="table-cell px-1 py-4 text-center"> - </div>
			  <div class="table-cell px-1 py-4 text-center text-red">  
			  	@if(isset($resultAdmin->matchs[$key]->resultatEq2)
			  	&& isset($resultAdmin->matchs[$key]->game_id) 
			  	&& $game->id == $resultAdmin->matchs[$key]->game_id) 
			  	{{ $resultAdmin->matchs[$key]->resultatEq2 }} @endif 
			  </div>
			  <div class="table-cell px-1 py-4 text-center">
				<label for="resultatEq2"></label>
				<select id="resultatEq2" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq2[]" value="">
					<option> @isset($game->matchs->first()['resultatEq2']) {{ $game->matchs->first()['resultatEq2'] }} @endisset </option>
					<option value="0" >0</option>	      
	                <option value="1" >1</option>
	                <option value="2" >2</option>
	                <option value="3" >3</option>
	                <option value="4" >4</option>
	                <option value="5" >5</option>
	                <option value="6" >6</option>
	                <option value="7" >7</option>
	                <option value="8" >8</option>
	                <option value="9" >9</option>
	            </select>
			  </div>
			  <div class="table-cell px-1 py-4 text-center"> <img class="inline" loading="lazy" src="{{ URL::to('/img/' .$game->awayTeam->logo) }}"></div>
			  <div class="table-cell px-1 py-4 hidden font-bold md:table-cell text-left">{{ $game->awayTeam->name}}</div>
			  <div class="table-cell px-1 py-4">
			  	@if(isset($game->matchs->first()['pointMatch'])) 
			  	 @if($game->matchs->first()['pointMatch'] == 3)
			  	 	<span class="text-green-500 font-bold justify-around">	
			  	 		<svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>		  	 		
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  		</span>
			  	 @elseif($game->matchs->first()['pointMatch'] == 1)
			  	 	<span class="text-blue-500 font-bold justify-around">
			  	 		<svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  	    </span>
			  	 @else
			  	 	<span class="text-julienred font-bold justify-around">
			  	 		<svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  	    </span> 
			  	  @endif  
			  	@endif
			  </div>
		    </div>
		   @endforeach 
		</div>
		<div class="text-center">
			<button type="submit" class="bg-francagris hover:bg-white text-white hover:text-gray-900 font-medium text-center tracking-widest border-2 rounded-lg border-francaverde uppercase py-2 px-4 my-2">
	  			{{__('all.Registrar')}}
			</button>
		</div>
		</form>
	</div>
</div>

@endsection
