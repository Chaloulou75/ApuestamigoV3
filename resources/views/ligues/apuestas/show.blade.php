@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  

  	<date-component></date-component>
  
	<div class="container text-white">

		@if ( Auth::user()->admin == 1) 
			<h3 class="text-base text-left py-2">{{__('all.Hey')}} <strong>{{$user->name}}</strong>, set all scores!</h3>
			<form method="POST" action="{{ action('AdminController@store', [$ligue, $journee]) }}"> 
				@csrf
		
		@elseif( Auth::check())
			<h3 class="text-base text-left py-2">{{__('all.Hey')}} <strong>{{$user->name}}</strong>, {{__('all.your bets')}} :</h3>
		@else
			<h3 class="text-base text-left py-2"></h3>
		@endif

		<div class="table w-full md:w-11/12 mx-auto text-sm text-gray-900 bg-gray-400 shadow-md border-2 border-solid border-white rounded">

		    <div class="table-row w-full mx-auto border border-solid border-white">
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell"></div>
		      <div class="table-cell py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-center font-bold">Home</div>
		      <div class="table-cell px-4 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $fecha = $journee - 1]) }}"> < </a></div>
		      <div class="table-cell px-4 py-4 text-center font-bold"> {{ $journee }}</div>
		      <div class="table-cell px-4 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $fecha = $journee + 1]) }}"> > </a></div>
		      <div class="table-cell px-4 py-4 text-center font-bold">Away</div>
		      <div class="table-cell px-4 py-4 text-left hidden md:table-cell "></div>
		    </div>		    			  

			@foreach ($games as $key => $game)
				

		    <div class="table-row mx-auto border border-solid border-white hover:bg-gray-600 hover:text-white hover:font-bold">
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell">  {{ $loop->iteration }} </div>
		      <div class="table-cell py-4 text-center text-xs hidden md:table-cell">  {{ \Carbon\Carbon::parse($game->gamedate)->format('j F Y H:i') }} </div>
			  <div class="table-cell px-4 py-4 text-right font-bold hidden md:table-cell"> {{ $game->homeTeam->name }} </div>
			  <div class="table-cell px-4 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->homeTeam->logo) }}"></div>
			  <div class="table-cell px-4 py-4 text-center">
				<label for="resultatEq1"></label>
				<select id="resultatEq1" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq1[]" value="">
					<option> @if(isset($game->matchs->first()['resultatEq1'])) {{ $game->matchs->first()['resultatEq1'] }} @endif </option>
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
			  {{-- <div class="table-cell px-4 py-4 text-center text-red"> {{ $adminResult->matchs->first()['resultatEq1'] }} </div> --}}
			  <div class="table-cell px-4 py-4 text-center"> - </div>
			  {{-- <div class="table-cell px-4 py-4 text-center text-red"> {{ $adminResult->matchs->first()['resultatEq2'] }}</div> --}}
			  <div class="table-cell px-4 py-4 text-center">
				<label for="resultatEq2"></label>
				<select id="resultatEq2" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq2[]" value="">
					<option> @if(isset($game->matchs->first()['resultatEq2'])) {{ $game->matchs->first()['resultatEq2'] }} @endif </option>
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
			  <div class="table-cell px-4 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->awayTeam->logo) }}"></div>
			  <div class="table-cell px-4 py-4 hidden md:table-cell font-bold text-left">{{ $game->awayTeam->name}}</div>
		    </div>
			
		   @endforeach 
		</div>

		@if ( Auth::user()->admin == 1) 

		<div class="flex justify-center">
			<button type="submit" class="bg-gray-900 hover:bg-white text-white hover:text-gray-900 font-semibold text-center border-2 rounded-full hover:border-gray-900 border-gray-500 flex-auto py-2 px-4 m-2">
		  		{{__('all.Registrar')}}
			</button>
		</div>

		@endif

		</form>
	</div>
</div>

@endsection
