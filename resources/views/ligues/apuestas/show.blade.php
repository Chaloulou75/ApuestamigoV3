@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  	@include('layouts/partials/navLigue')  

  	@livewire('next-game')
</div>
  
<div class="w-full text-francagris md:px-4">

	@admin
		<h3 class="text-base text-left text-white tracking-wide py-2">{{__('all.Hey')}} <span class="text-francaverde">{{$user->name}}</span>, set all scores!</h3>
		<form method="POST" action="{{ action('AdminController@store', [$ligue, $journee]) }}"> 
			@csrf
	@endadmin
	@auth
		<h3 class="text-base text-left text-white tracking-wide py-2">{{__('all.Hey')}} <span class="text-francaverde">{{$user->name}}</span>, {{__('all.your bets')}} :</h3>
	@endauth	
	@guest
		<h3 class="text-base text-left text-white py-2">{{__('all.Bets of')}} <span class="text-francaverde">{{$user->name}}</span>:</h3>
	@endguest

	<table class="animate__animated animate__fadeInUp table-auto w-full bg-white border-t-4 md:border-4 border-francaverde rounded-lg text-sm text-francagris"> 
	    <thead class="bg-teal-200">
	    <tr>
	      <th class="px-1 py-4 hidden md:table-cell"></th>
	      <th class="px-1 py-4 hidden md:table-cell">{{__('all.Date')}}</th>
	      <th class="px-1 py-4 hidden md:table-cell"></th>
	      <th class="px-1 py-4 truncate ">{{__('all.Home')}}</th>
	      <th class="px-1 py-4 hover:text-francaverde">
	  		<a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee - 1]) }}"> 
	  			<svg class="inline-block h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7"></path></svg> 
	  		</a>
	  	  </th>
	      <th class="px-1 py-4"></th>
	      <th class="px-1 py-4"> {{ $journee }}</th>
	      <th class="px-1 py-4"></th>
	      <th class="px-1 py-4 hover:text-francaverde">
	      	<a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee + 1]) }}">
	      	 <svg class="inline-block h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>
	      	</a>
	      </th>
	      <th class="px-1 py-4 truncate">{{__('all.Away')}}</th>
	      <th class="px-1 py-4 hidden md:table-cell"></th>
	      <th class="px-1 py-4 truncate">{{__('all.Points')}}</th>
	     </tr>
	    </thead>		    			  

	    <tbody>
		@foreach ($games as $key => $game)		
	    <tr> 
	      <th class="px-4 py-4 hidden md:table-cell">{{ $loop->iteration }} </th>
	      <th class="px-1 py-4 hidden md:table-cell text-xs">  {{ \Carbon\Carbon::parse($game->gamedate)->isoFormat('dddd Do MMMM YYYY H:mm') }} </th>
		  <th class="px-1 py-4 text-right hidden md:table-cell"> {{ $game->homeTeam->name }} </th>
		  <th class="px-1 py-4"> <img class="inline w-10 h-10" loading="lazy" src="{{ $game->homeTeam->logourl ? url($game->homeTeam->logourl) : URL::to('/img/' .$game->homeTeam->logo) }}"></th>
		  <th class="px-1 py-4 text-center">
			<label for="resultatEq1"></label>
			<select id="resultatEq1" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq1[]" value="">
				<option>
				 	@if(isset($game->matchs->first()['resultatEq1']))
				 		@if(Auth::user() == $user || $now > $game->gamedate)
				  			{{ $game->matchs->first()['resultatEq1'] }} 
						@endif
					@endif 
				</option>
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
		  </th>
		  <th class="px-1 py-4 font-normal text-sm text-julienred"> 
		  	@if(isset($resultAdmin->matchs[$key]->resultatEq1) 
		  	&& isset($resultAdmin->matchs[$key]->game_id) 
		  	&& $game->id == $resultAdmin->matchs[$key]->game_id)
		  	{{ $resultAdmin->matchs[$key]->resultatEq1 }} @endif 
		  </th>
		  <th class="px-1 py-4"> - </th>
		  <th class="px-1 py-4 font-normal text-sm text-julienred">  
		  	@if(isset($resultAdmin->matchs[$key]->resultatEq2)
		  	&& isset($resultAdmin->matchs[$key]->game_id) 
		  	&& $game->id == $resultAdmin->matchs[$key]->game_id) 
		  	{{ $resultAdmin->matchs[$key]->resultatEq2 }} @endif 
		  </th>
		  <th class="px-1 py-4">
			<label for="resultatEq2"></label>
			<select id="resultatEq2" class="border-2 border-solid border-gray-800 text-gray-900 font-bold rounded" name="resultatEq2[]" value="">
				<option> 
					@if(isset($game->matchs->first()['resultatEq2']))
						@if(Auth::user() == $user || $now > $game->gamedate) 
							{{ $game->matchs->first()['resultatEq2'] }} 
						@endif
					@endif 
				</option>
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
		  </th>
		  <th class="px-1 py-4"> <img class="inline w-10 h-10" loading="lazy" src="{{ $game->awayTeam->logourl ? url($game->awayTeam->logourl) : URL::to('/img/' .$game->awayTeam->logo) }}"></th>
		  <th class="px-1 py-4 text-left hidden md:table-cell">{{ $game->awayTeam->name}}</th>
		  <th class="px-1 py-4">
		  	@if(isset($game->matchs->first()['pointMatch'])) 
		  	 @if($game->matchs->first()['pointMatch'] == 3)
		  	 	<span class="text-green-500 font-bold justify-around">	
		  	 		<svg class="h-8 w-8 inline-block pr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
		  	 		{{ $game->matchs->first()['pointMatch'] }}			  			
		  		</span>
		  	 @elseif($game->matchs->first()['pointMatch'] == 1)
		  	 	<span class="text-blue-500 font-bold justify-around">
		  	 		<svg class="h-8 w-8 inline-block pr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
		  			{{ $game->matchs->first()['pointMatch'] }}			  			
		  	    </span>
		  	 @else
		  	 	<span class="text-julienred font-bold justify-around">
		  	 		<svg class="h-8 w-8 inline-block pr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
		  			{{ $game->matchs->first()['pointMatch'] }}			  			
		  	    </span> 
		  	  @endif  
		  	@endif
		  </th>
	    </tr>
	   	@endforeach 
		</tbody>
	</table>

	@admin
		<div class="text-center">
			<button type="submit" class="w-3/4 bg-francagris text-white hover:text-francaverde font-medium text-center tracking-widest border-2 rounded-lg border-francaverde py-2 px-6 my-2">
		  		{{__('all.Registrar')}}
			</button>
		</div>
	</form>
	@endadmin		
</div>
@endsection
