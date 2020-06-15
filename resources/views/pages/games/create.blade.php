@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

		<h3 class="text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }}</span>, mets les prochains matchs
		</h3>
		<p class="text-base text-center text-francaverde py-2"><a href="{{route('games.index')}}">Retourner à la liste des matchs</a></p>

		@if ($errors->any())
		    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-200 p-4" role="alert">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<div class="w-full lg:w-1/3 mx-auto bg-francagris shadow-md border-2 border-white rounded py-8 px-8 my-4">
		  <form class="mx-auto" method="POST" action="{{ action('GameController@store') }}">
		  		@csrf
		  	<div class="mb-4">
		      <label class="block text-white text-sm font-base mb-2" for="journee">
		        Journée
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="journee" name="journee" placeholder="{{old('journee')}}">
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
		      <label class="block text-white text-sm font-base mb-2" for="equipe1_id">
		        Home Team
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="equipe1_id" name="equipe1_id"  placeholder="{{old('equipe1_id')}}">
		      	@foreach ($equipes as $equipe)

					<option value="{{ $equipe->id }}">{{ $equipe->name }}</option>
		                
		        @endforeach
		      </select>
		    </div>
		    <div class="mb-4">
		      <label class="block text-white text-sm font-base mb-2" for="equipe2_id"> Away Team</label>
		      <select class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="equipe2_id" name="equipe2_id" placeholder="{{old('equipe2_id')}}">
		      @foreach ($equipes as $equipe)

					<option value="{{ $equipe->id }}">{{ $equipe->name }}</option>
		                
		      @endforeach
		      </select>
		    </div>
		    <div class="mb-4">
		    	<label class="block text-white text-sm font-base mb-2" for="gamedate">Choose a date:</label>

				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" 
					   type="datetime-local" id="gamedate"
				       name="gamedate" value="">
		    </div>
		    <div class="mb-4">
		    	<label class="block text-white text-sm font-base mb-2" for="year">Year (of the final):</label>

				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" type="number" min="2019" max="2099" step="1" value="2020" id="year" name="year"/>
		    </div>
 
		    <div class="flex items-center justify-between">
		      <button class="w-full bg-francagris text-white hover:text-francaverde text-sm py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
		        Enregistrer le match
		      </button>
		      
		    </div>
		  </form>	  
		</div>
	
</div>

@endsection
