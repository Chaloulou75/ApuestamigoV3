@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  

  	<date-component></date-component>
  
	<div class="text-francagris animated jackInTheBox">

		@if (Auth::check())		
			<h3 class="text-base text-left text-white tracking-wide py-2">{{__('all.Hey')}} <strong>{{$user->name}}</strong>, {{__('all.let\'s play')}}.</h3>
		@else	
			<h3 class="text-base text-left text-white tracking-wide py-2">{{__('all.Hey')}}, {{__('all.you have to login or register to play.')}}</h3>
		@endif
		<form method="POST" action="{{ action('ApuestasController@store', $ligue) }}"> 
			@csrf

		<div class="table w-full bg-white shadow-md border-4 border-solid border-francaverde rounded text-sm text-francagris"> 
		    <div class="table-row w-full mx-auto border border-solid border-francaverde">
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold hidden md:table-cell">{{__('all.Date')}}</div>
		      <div class="table-cell px-1 py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold">{{__('all.Home')}}</div>
		      <div class="table-cell px-1 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee - 1]) }}"> < </a></div>
		      <div class="table-cell px-1 py-4 text-center"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold"> {{ $journee }}</div>
		      <div class="table-cell px-1 py-4 text-center"></div>
		      <div class="table-cell px-1 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee + 1]) }}"> > </a></div>
		      <div class="table-cell px-1 py-4 text-center font-bold">{{__('all.Away')}}</div>
		      <div class="table-cell px-1 py-4 text-left hidden md:table-cell"></div>
		      <div class="table-cell px-1 py-4 text-left font-bold">{{__('all.Points')}}</div>
		    </div>		    			  

			@foreach ($games as $key => $game)	

		    <div class="table-row mx-auto border border-solid rounded border-francaverde hover:bg-blue-200"> 
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
			  	 	<span class="text-green-500 font-bold flex items-center justify-around">	
			  	 		<i class="far fa-check-circle font-bold"></i>		  	 		
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  		</span>
			  	 @elseif($game->matchs->first()['pointMatch'] == 1)
			  	 	<span class="text-blue-500 font-bold flex items-center justify-around">
			  	 		<i class="far fa-check-circle font-bold"></i>
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  	    </span>
			  	 @else
			  	 	<span class="text-red-500 font-bold flex items-center justify-around">
			  	 		<i class="far fa-times-circle font-bold"></i>
			  			{{ $game->matchs->first()['pointMatch'] }}			  			
			  	    </span>   
			  	 @endif
			  	@endif
			  </div>
		    </div>

		   @endforeach 
		</div>
		
		<div class="flex justify-center">
			<button type="submit" class="bg-francagris hover:bg-francaverde text-white hover:text-francagris font-medium text-center tracking-widest border-2 rounded-full hover:border-white border-francaverde flex-auto py-2 px-4 m-2">
		  		{{__('all.Registrar')}}
			</button>
		</div>
		</form>
	</div>
</div>

@endsection
