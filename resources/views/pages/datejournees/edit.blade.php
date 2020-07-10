@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

		<h3 class="text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }}</span>,{{ $datejournee->championnat->name }} mets à jour la journée {{$datejournee->numerojournee}} - {{$datejournee->namejournee }} le <span class="italic text-gray-400">{{ \Carbon\Carbon::parse($datejournee->timejournee)->isoFormat('dddd Do MMMM YYYY H:mm') }}, saison {{ $datejournee->season }}
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
		      <label class="block text-white text-sm font-base mb-2" for="numerojournee">
		        Numero journée {{$datejournee->numerojournee}}
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="numerojournee" name="numerojournee" placeholder="{{$datejournee->numerojournee}}">
			      	<option value="1">1</option>
		            <option value="2">2</option>
		            <option value="3">3</option>
		            <option value="4">4</option>
		            <option value="5">5</option>
		            <option value="6">6</option>
		            <option value="7">7</option>
		            <option value="8">8</option>
		            <option value="9">9</option>
		            <option value="10">10</option>
		            <option value="11">11</option>
		            <option value="12">12</option>
		            <option value="13">13</option>
		            <option value="14">14</option>
		            <option value="15">15</option>
		            <option value="16">16</option>
		            <option value="17">17</option>
		            <option value="18">18</option>
		            <option value="19">19</option>
		            <option value="20">20</option>
		            <option value="21">21</option>
		            <option value="22">22</option>
		            <option value="23">23</option>
		            <option value="24">24</option>
		            <option value="25">25</option>
		            <option value="26">26</option>
		            <option value="27">27</option>
		            <option value="28">28</option>
		            <option value="29">29</option>
		            <option value="30">30</option>
		            <option value="31">31</option>
		            <option value="32">32</option>
		            <option value="33">33</option>
		            <option value="34">34</option>
		            <option value="35">35</option>
		            <option value="36">36</option>
		            <option value="37">37</option>
		            <option value="38">38</option>

	            </select>
		    </div>

		    <div class="mb-4">
		      <label class="block text-white text-sm font-base mb-2" for="namejournee">
		        Nom Journée {{$datejournee->namejournee }}
		      </label>
		      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" id="namejournee" name="namejournee" placeholder="{{$datejournee->namejournee }}">
			      	<option value="journee 1" > journée 1</option>
		            <option value="journee 2" > journée 2</option>
		            <option value="journee 3" > journée 3</option>
		            <option value="journee 4" > journée 4</option>
		            <option value="journee 5" > journée 5</option>
		            <option value="journee 6" > journée 6</option>
		            <option value="journee 7" > journée 7</option>
		            <option value="journee 8" > journée 8</option>
		            <option value="journee 9" > journée 9</option>
		            <option value="journee 10" > journée 10</option>
		            <option value="journee 11" > journée 11</option>
		            <option value="journee 12" > journée 12</option>
		            <option value="journee 13" > journée 13</option>
		            <option value="journee 14" > journée 14</option>
		            <option value="journee 15" > journée 15</option>
		            <option value="journee 16" > journée 16</option>
		            <option value="journee 17" > journée 17</option>
		            <option value="journee 18" > journée 18</option>
		            <option value="journee 19" > journée 19</option>
		            <option value="journee 20" > journée 20</option>
		            <option value="journee 21" > journée 21</option>
		            <option value="journee 22" > journée 22</option>
		            <option value="journee 23" > journée 23</option>
		            <option value="journee 24" > journée 24</option>
		            <option value="journee 25" > journée 25</option>
		            <option value="journee 26" > journée 26</option>
		            <option value="journee 27" > journée 27</option>
		            <option value="journee 28" > journée 28</option>
		            <option value="journee 29" > journée 29</option>
		            <option value="journee 30" > journée 30</option>
		            <option value="journee 31" > journée 31</option>
		            <option value="journee 32" > journée 32</option>
		            <option value="journee 33" > journée 33</option>
		            <option value="journee 34" > journée 34</option>
		            <option value="journee 35" > journée 35</option>
		            <option value="journee 36" > journée 36</option>
		            <option value="journee 37" > journée 37</option>
		            <option value="journee 38" > journée 38</option>
		            <option value="Huitièmes de finale allers"> Huitièmes de finale allers</option>
		            <option value="Huitièmes de finale retours">Huitièmes de finale retours</option>
		            <option value="Quarts de finale allers"> Quarts de finale allers</option>
		            <option value="Quarts de finale retours"> Quarts de finale retours</option>
		            <option value="Demies finale allers"> Demies finale allers</option>
		            <option value="Demies finale retours"> Demies finale retours</option>
		            <option value="Finale" > Finale</option>

	            </select>
		    </div>

		    <div class="mb-4">
		    	<label class="block text-white text-sm font-base mb-2" for="timejournee">Date de la journée:</label>

				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" 
					   type="datetime-local" id="timejournee"
				       name="timejournee" value="">
		    </div>

		    <div class="mb-4">
		    	<label class="block text-white text-sm font-base mb-2" for="season">Season (year of the final):</label>

				<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline" type="number" min="2019" max="2099" step="1" value="{{ $datejournee->season }}" id="season" name="season"/>
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
