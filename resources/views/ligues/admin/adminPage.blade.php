@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

	<div class="flex flex-wrap">
		
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('equipes.index') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
			Les équipes </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('datejournees.index') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
			Les journées </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('games.create') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
		 Insérer les matchs </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('games.index') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
		 	Liste des matchs </a>
		</div>
		
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('profile.index') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
			la liste de tous les joueurs
		</a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestasorphelines') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
			Apuestas orphelines
		</a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('ligues.index') }}">
			<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
			 Montrer les matchs and mettre les scores définitifs </a>
		</div>

		@foreach ($datejournees as $journee)		
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">	
			<a href="{{ route('apuestas.compare', $journee) }}">
				<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
		 		Points/Match pour <span class="text-francaverde">{{ $journee->namejournee }} {{ $journee->season }}</span>
		 	</a>
		</div>
		@endforeach

		@foreach ($datejournees as $journee)
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
			<a href="{{ route('apuestas.points', $journee) }}">
				<svg class="inline w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path></svg>
			 	Points totaux/Joueur/ligue/journée <span class="text-francaverde">{{ $journee->namejournee }} {{ $journee->season }}</span> 
			 </a>
		</div>
		@endforeach
	</div>
</div>

@endsection
