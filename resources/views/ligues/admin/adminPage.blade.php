@extends('layouts.app')

@section('content')

<div class="container w-full md:w-4/5 mx-auto px-2">


	<div class="container text-orange-500">
		<ul>

			<li><a href="{{ route('ligues.index') }}"> Show Matchs and Set Scores. </a></li>
			<li><a href="{{ route('apuestas.compare') }}"> Comparer les Scores et mise à jour des points des joueurs par match. </li>	
			<li><a href="{{ route('apuestas.points') }}"> Mise à jour des points totaux des joueurs. </li>		
		</ul>
		
	</div>
</div>

@endsection
