@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }} </span>, la liste de tous les matchs:
		</h3>


		<div class="text-white">
			
			<ul class="py-2 list-disc">
				@foreach($games as $game)
					<li class="animate__animated animate__lightSpeedInLeft py-2">Journée <span class="text-blue-500">{{$game->journee}}</span>: Match qui oppose <span class="text-francaverde">{{$game->homeTeam->name}}</span> vs <span class="text-francaverde">{{$game->awayTeam->name}}</span>, prévu le <span class="italic">{{ \Carbon\Carbon::parse($game->gamedate)->isoFormat('dddd Do MMMM YYYY H:mm')}}</span><a class="px-2 text-francaverde" href="{{route('games.edit', $game->id)}}"> Edit Game</a>
						<form class="inline-block" method="POST" action="{{route('games.destroy', $game)}}"> 
					  		@csrf 
					  		@method('DELETE')
					  		<button type="submit" class="px-2 text-julienred">Suprimir el partido</button>
					  	</form>						
					</li>
				@endforeach
			</ul>	
		</div>	
</div>

@endsection
