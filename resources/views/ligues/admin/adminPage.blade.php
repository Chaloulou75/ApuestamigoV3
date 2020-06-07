@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

	<div class="flex flex-wrap">
		
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('games.create') }}"> Insérer les matchs </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('games.index') }}"> Liste des matchs </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('ligues.index') }}"> Montrer les matchs and mettre les scores définitifs. </a>
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 1]) }}"> Points/Match pour la journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 2]) }}"> Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 3]) }}"> Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 4]) }}"> Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 5]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 6]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 7]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 8]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.	
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 9]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 10]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 11]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 12]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.

		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.compare', [ $journee = 13]) }}">Points/Match pour la journée <strong>{{ $journee }}</strong>.
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 1] ) }}"> Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 2] ) }}"> Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 3] ) }}"> Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 4] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 	
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 5] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 6] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 7] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 8] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 9] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 10] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 11] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 12] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>
		<div class="animate__animated animate__flipInX border-2 rounded-lg border-francaverde flex-auto text-white text-center bg-francagris hover:text-francaverde px-4 py-2 m-2">
		<a href="{{ route('apuestas.points', [ $journee = 13] ) }}">Points totaux/Joueur/ligue/journée <strong>{{ $journee }}</strong>. 
		</div>	
		
		
	</div>
</div>

@endsection
