@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }} </span>, la liste de tous les matchs:
		</h3>

		<div class="my-2">
			<a class="py-4 text-francaverde" href="{{route('admin.index')}}">
			<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
			 Revenir au Dashboard Admin
			</a>
		</div>

		<div class="text-white">
			
			<ul class="py-2 list-disc">
				@foreach($games as $key => $game)
					<li class="animate__animated animate__lightSpeedInLeft py-4 px-2">
						Journée <span class="text-blue-500 italic">
							{{ $game->id }}: 
							@isset($game->journee->namejournee)
							{{ $game->journee->namejournee }} {{ $game->journee->season }}
							@endisset
						</span>
						: Match qui oppose <span class="text-francaverde">{{$game->homeTeam->name}}</span> vs <span class="text-francaverde">{{$game->awayTeam->name}}</span>, prévu le <span class="italic">{{ \Carbon\Carbon::parse($game->gamedate)->isoFormat('dddd Do MMMM YYYY H:mm')}}</span>
						<a class="px-2 text-francaverde" href="{{route('games.edit', $game->id)}}"> Edit Game</a>
						<form class="inline-block" method="POST" action="{{route('games.destroy', $game)}}"> 
					  		@csrf 
					  		@honeypot
					  		@method('DELETE')
					  		<button type="submit" class="px-2 text-julienred">Suprimir el partido</button>
					  	</form>						
					</li>
				@endforeach
			</ul>	
		</div>	
</div>

@endsection
