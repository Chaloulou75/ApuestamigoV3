@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  

  	<date-component></date-component>
  
	<div class="container text-white">

		@if ( Auth::user()->admin == 1) 
			<h3 class="text-base text-left py-2">Hey <strong>{{$user->name}}</strong>, set all scores!</h3>
			<form method="POST" action="{{ action('AdminController@store', [$ligue, $journee]) }}"> 
				@csrf
		
		@elseif( Auth::check())
			<h3 class="text-base text-left py-2">Hey <strong>{{$user->name}}</strong>, tes paris:</h3>
		@else
			<h3 class="text-base text-left py-2"></h3>
		@endif

		<div class="table w-full md:w-4/5 mx-auto text-sm text-white bg-gray-600 shadow-md border-2 border-solid border-white rounded">

		    <div class="table-row w-full mx-auto border border-solid border-white">
		      <div class="table-cell px-4 py-4 text-center hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-center">Home</div>
		      <div class="table-cell px-4 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $fecha = $journee - 1]) }}"> < </a></div>
		      <div class="table-cell px-4 py-4 text-center font-bold"> {{ $journee }}</div>
		      <div class="table-cell px-4 py-4 text-center font-bold"><a href="{{ action('ApuestasController@show', [$ligue, $fecha = $journee + 1]) }}"> > </a></div>
		      <div class="table-cell px-4 py-4 text-center">Away</div>
		      <div class="table-cell px-4 py-4 text-left hidden md:table-cell "></div>
		    </div>		    			  

			@foreach ($games as $game)	

		    <div class="table-row mx-auto border border-solid border-white hover:bg-gray-700">
		      <div class="table-cell px-4 py-4 text-center hidden md:table-cell">  {{ $loop->iteration }} </div>
			  <div class="table-cell px-4 py-4 text-right font-bold hidden md:table-cell"> {{ $game->homeTeam->name }} </div>
			  <div class="table-cell px-4 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->homeTeam->logo) }}"></div>
			  <div class="table-cell px-4 py-4 text-center">
				<label for="resultatEq1"></label>
				<select id="resultatEq1" class="border-2 border-solid border-gray-100 text-gray-900 font-bold rounded {{ $errors->has('resultatEq1') ? ' bg-red-dark' : '' }}" name="resultatEq1[]" value="">
					<option>{{ $game->matchs->first()['resultatEq1'] }}</option>
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
			  <div class="table-cell px-4 py-4 text-center"> - </div>
			  <div class="table-cell px-4 py-4 text-center">
				<label for="resultatEq2"></label>
				<select id="resultatEq2" class="border-2 border-solid border-gray-100 text-gray-900 font-bold rounded {{ $errors->has('resultatEq2') ? ' bg-red-dark' : '' }}" name="resultatEq2[]" value="">
					<option>{{ $game->matchs->first()['resultatEq2'] }}</option>
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
		  		Enregistrer
			</button>
		</div>

		@endif

		</form>
	</div>
</div>

@endsection
