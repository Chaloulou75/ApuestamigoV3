@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			la liste de tous les matchs et games:
		</h3>

		<div class="my-2">
			<a class="py-4 text-francaverde" href="{{route('admin.index')}}">
			<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
			 Revenir au Dashboard Admin
			</a>
		</div>

		<div class="text-white flex justify-around">
			<div>
				<ul class="py-2 list-disc">
					@foreach($orphans as $orphan)
						<li class="animate__animated animate__lightSpeedInLeft py-4 px-2">
							{{ $orphan->id }} - journee: {{ $orphan->date_journees_id }} - user: {{ $orphan->user_id }} -
						dans la ligue n°: {{ $orphan->ligue_id }} - Game id :{{ $orphan->game_id }} - resultat mis: {{ $orphan->resultatEq1 }} - {{ $orphan->resultatEq2 }}, point pour le match: {{ $orphan->pointmatch }} </br>
							<form class="inline-block" method="POST" action="{{ route('orphans.destroy', ['orphan' => $orphan->id ]) }}">
						  		@csrf 
						  		@honeypot
						  		@method('DELETE')
						  		<button type="submit" class="px-2 text-julienred">Suprimir l'orphan</button>
						  	</form>	 					
						</li>
					@endforeach
				</ul>

			</div>
		</div>	
</div>

@endsection
