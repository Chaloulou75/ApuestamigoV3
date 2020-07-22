<?php@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

		<h3 class="text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }}</span>,{{ $datejournee->championnat->name }} mets à jour la journée {{$datejournee->namejournee }} le <span class="italic text-gray-400">{{ \Carbon\Carbon::parse($datejournee->timejournee)->isoFormat('dddd Do MMMM YYYY H:mm') }}
		</h3>
		<p class="text-base text-center text-francaverde py-2"><a href="{{route('datejournees.index')}}">Retourner à la liste des journées</a></p>

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
		  <form class="mx-auto" method="POST" action="{{ route('datejournees.update', $datejournee) }}">
		  		@csrf
		  		@method('PUT')
		  		@honeypot
		  	<div class="mb-4">
		        <label for="championnat_id" class="block text-white text-base font-medium mb-2">
		            {{ __('all.choose a championship') }}
		        </label>            
		        <select id="championnat_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('championnat_id') ? ' bg-red-dark' : '' }}" name="championnat_id" value="{{ old('championnat_id') }}" placeholder="{{$datejournee->championnat_id}}" required> 

		          @foreach($championnats as $championnat)

		          <option class="py-4" value="{{ $championnat->id }}">{{ $championnat->name}} </option>

		          @endforeach     
		        </select>

		        @if ($errors->has('championnat_id'))
		            <span class="mt-1 text-sm text-julienred" role="relative px-3 py-3 mb-4 border rounded">
		                <strong>{{ $errors->first('championnat_id') }}</strong>
		            </span>
		        @endif            
		    </div>

		    <div class="mb-4">
		      <label class="block text-white text-sm font-base mb-2" for="namejournee">
		        Nom Journée {{$datejournee->namejournee }}
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="namejournee" name="namejournee" placeholder="{{$datejournee->namejournee }}">
			      	<option value="Journee 1" > Journée 1</option>
		            <option value="Journee 2" > Journée 2</option>
		            <option value="Journee 3" > Journée 3</option>
		            <option value="Journee 4" > Journée 4</option>
		            <option value="Journee 5" > Journée 5</option>
		            <option value="Journee 6" > Journée 6</option>
		            <option value="Journee 7" > Journée 7</option>
		            <option value="Journee 8" > Journée 8</option>
		            <option value="Journee 9" > Journée 9</option>
		            <option value="Journee 10" > Journée 10</option>
		            <option value="Journee 11" > Journée 11</option>
		            <option value="Journee 12" > Journée 12</option>
		            <option value="Journee 13" > Journée 13</option>
		            <option value="Journee 14" > Journée 14</option>
		            <option value="Journee 15" > Journée 15</option>
		            <option value="Journee 16" > Journée 16</option>
		            <option value="Journee 17" > Journée 17</option>
		            <option value="Journee 18" > Journée 18</option>
		            <option value="Journee 19" > Journée 19</option>
		            <option value="Journee 20" > Journée 20</option>
		            <option value="Journee 21" > Journée 21</option>
		            <option value="Journee 22" > Journée 22</option>
		            <option value="Journee 23" > Journée 23</option>
		            <option value="Journee 24" > Journée 24</option>
		            <option value="Journee 25" > Journée 25</option>
		            <option value="Journee 26" > Journée 26</option>
		            <option value="Journee 27" > Journée 27</option>
		            <option value="Journee 28" > Journée 28</option>
		            <option value="Journee 29" > Journée 29</option>
		            <option value="Journee 30" > Journée 30</option>
		            <option value="Journee 31" > Journée 31</option>
		            <option value="Journee 32" > Journée 32</option>
		            <option value="Journee 33" > Journée 33</option>
		            <option value="Journee 34" > Journée 34</option>
		            <option value="Journee 35" > Journée 35</option>
		            <option value="Journee 36" > Journée 36</option>
		            <option value="Journee 37" > Journée 37</option>
		            <option value="Journee 38" > Journée 38</option>
		            <option value="Huitièmes de finale aller"> Huitième de finale aller</option>
		            <option value="Huitièmes de finale retour">Huitième de finale retour</option>
		            <option value="Quarts de finale aller"> Quart de finale aller</option>
		            <option value="Quarts de finale retour"> Quart de finale retour</option>
		            <option value="Demies finale aller"> Demie finale aller</option>
		            <option value="Demies finale retour"> Demie finale retour</option>
		            <option value="Finale" > Finale</option>

	            </select>
		    </div>

		    <div class="mb-4">
		    	<label class="block text-white text-sm font-base mb-2" for="timejournee">Date de la journée:</label>

				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" 
					   type="datetime-local" id="timejournee"
				       name="timejournee" value="">
		    </div>
 
		    <div class="flex items-center justify-between">
		      <button class="w-full bg-francagris text-white hover:text-francaverde text-sm py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
		        Mettre à jour la journée
		      </button>
		      
		    </div>
		  </form>	  
		</div>
	
</div>

@endsection
