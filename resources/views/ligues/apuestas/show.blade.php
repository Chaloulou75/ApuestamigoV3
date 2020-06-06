@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  

  	@livewire('next-game')
  
	<div class="container text-francagris">

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

		<div class="table w-full bg-white shadow-md border-4 border-solid border-francaverde rounded text-sm text-francagris">

		    <div class="table-row w-full mx-auto border border-solid border-white">
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
		      <div class="table-cell px-1 py-4 text-left hidden md:table-cell "></div>
		      <div class="table-cell px-1 py-4 text-left font-bold">{{__('all.Points')}}</div>
		    </div>		    			  

			@foreach ($games as $key => $game)

		    <div class="table-row mx-auto border border-solid rounded border-francaverde">
		      <div class="table-cell px-1 py-4 text-center hidden md:table-cell">  {{ $loop->iteration }} </div>
		      <div class="table-cell px-1 py-4 text-center text-xs hidden md:table-cell">  {{ \Carbon\Carbon::parse($game->gamedate)->format('j F Y H:i') }} </div>
			  <div class="table-cell px-1 py-4 text-right font-bold hidden md:table-cell"> {{ $game->homeTeam->name }} </div>
			  <div class="table-cell px-1 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->homeTeam->logo) }}"></div>
			  <div class="table-cell px-1 py-4 text-center">
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
			  </div>
			  <div class="table-cell px-1 py-4 text-center"> <img class="inline" src="{{ URL::to('/img/' .$game->awayTeam->logo) }}"></div>
			  <div class="table-cell px-1 py-4 hidden md:table-cell font-bold text-left">{{ $game->awayTeam->name}}</div>
			  <div class="table-cell px-1 py-4 text-left">
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

		@admin

		<div class="text-center">
			<button type="submit" class="bg-francagris hover:bg-white text-white hover:text-gray-900 font-medium text-center tracking-widest border-2 rounded-lg border-francaverde uppercase py-2 px-4 m-2">
		  		{{__('all.Registrar')}}
			</button>
		</div>

		@endadmin

		</form>
	</div>
</div>

@endsection
