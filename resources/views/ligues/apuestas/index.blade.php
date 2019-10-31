@extends('layouts.app')

@section('content')

<div class="container w-full md:w-4/5 mx-auto px-2">

  @include('layouts/partials/navLigue')  
  
	<div class="container text-orange-800">

		@if (Auth::check())		
			<h3 class="text-md text-left">Hey <strong>{{$user->name}}</strong>, let's play!</h3>
		@else	
			<h3 class="text-md text-left">Hey, you have to login or register to play.</h3>
		@endif
		<form method="POST" action="{{ action('ApuestasController@store', $ligue) }}"> 
			@csrf
		<div class="table w-full md:w-4/5 mx-auto text-sm bg-teal-300 shadow-md border border-solid border-teal-700 rounded">
		    <div class="table-row w-full mx-auto border border-solid border-teal-700">
		      <div class="table-cell px-4 py-4 text-center hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-right hidden md:table-cell"></div>
		      <div class="table-cell px-4 py-4 text-center">Home</div>
		      <div class="table-cell px-4 py-4">{{-- input --}}</div>
		      <div class="table-cell px-4 py-4 text-center"></div>
		      <div class="table-cell px-4 py-4">{{-- input --}}</div>
		      <div class="table-cell px-4 py-4 text-center">Away</div>
		      <div class="table-cell px-4 py-4 text-left hidden md:table-cell "></div>
		    </div>		    			  

			@foreach ($games as $game)	

		    <div class="table-row mx-auto border border-solid border-teal-700 hover:bg-teal-500">
		      <div class="table-cell px-4 py-4 text-center hidden md:table-cell">  {{ $loop->iteration }} </div>
			  <div class="table-cell px-4 py-4 text-right hidden md:table-cell"> {{ $game->homeTeam->name }} </div>
			  <div class="table-cell px-4 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->homeTeam->logo) }}"></div>
			  <div class="table-cell px-4 py-4 text-center">
				<label for="resultatEq1"></label>
				<select id="resultatEq1" class="border border-solid border-teal-700 rounded {{ $errors->has('resultatEq1') ? ' bg-red-dark' : '' }}" name="resultatEq1[]" value="">
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
				<select id="resultatEq2" class="border border-solid border-teal-700 rounded  {{ $errors->has('resultatEq2') ? ' bg-red-dark' : '' }}" name="resultatEq2[]" value="">
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
			  <div class="table-cell px-4 py-4 hidden md:table-cell text-left">{{ $game->awayTeam->name}}</div>
		    </div>

		   @endforeach 
		</div>
		
		<div class="flex justify-center m-2 pt-2">
			<button type="submit" class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded">
		  		Enregistrer
			</button>
		</div>
		</form>
	</div>
</div>

@endsection
