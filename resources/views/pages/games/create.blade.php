@extends('layouts.app')

@section('content')

<div class="container w-full md:w-4/5 mx-auto px-2">

		<h3 class="text-md text-center py-2 text-orange-600">Hey {{ $user->name }}, mets les prochains matchs</h3>

		<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
		  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ action('GameController@store') }}">
		  		@csrf
		  	<div class="mb-4">
		      <label class="block text-gray-700 text-sm font-bold mb-2" for="journee">
		        Journée
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="journee" name="journee" placeholder="{{old('journee')}}">
			      	<option value="1" > 1</option>
		            <option value="2" > 2</option>
		            <option value="3" > 3</option>
		            <option value="4" > 4</option>
		            <option value="5" > 5</option>
		            <option value="6" > 6</option>
		            <option value="7" > Huitièmes de finale allers</option>
		            <option value="8" > Huitième de finale retours</option>
		            <option value="9" > Quart de finale allers</option>
		            <option value="10" > Quart de finale retours</option>
		            <option value="11" > Demi finale allers</option>
		            <option value="12" > Demi finale retours</option>
		            <option value="13" > Finale</option>

	            </select>
		    </div>

		    <div class="mb-4">
		      <label class="block text-gray-700 text-sm font-bold mb-2" for="equipe1_id">
		        Home
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="equipe1_id" name="equipe1_id"  placeholder="{{old('equipe1_id')}}">
		      	@foreach ($equipes as $equipe)

					<option value="{{ $equipe->id }}">{{ $equipe->name }}</option>
		                
		        @endforeach
		      </select>
		    </div>
		    <div class="mb-6">
		      <label class="block text-gray-700 text-sm font-bold mb-2" for="equipe2_id"> Away </label>
		      <select class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="equipe2_id" name="equipe2_id" placeholder="{{old('equipe2_id')}}">
		      @foreach ($equipes as $equipe)

					<option value="{{ $equipe->id }}">{{ $equipe->name }}</option>
		                
		      @endforeach
		      </select>
		    </div>
		    <div class="flex items-center justify-between">
		      <button class="bg-blue-500 hover:bg-blue-700 text-white text-sm {{-- font-bold --}} py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
		        Enregistrer le match
		      </button>
		      
		    </div>
		  </form>	  
		</div>
	
</div>

@endsection
