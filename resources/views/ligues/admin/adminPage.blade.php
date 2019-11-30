@extends('layouts.app')

@section('content')

<div class="container w-full md:w-4/5 mx-auto px-2">


	<div class="container text-orange-500">
		<ul>

			<li><a href="{{ route('ligues.index') }}"> Montrer les matchs and mettre les scores définitifs. </a></li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 1]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 2]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 3]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 4]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 5]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 6]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 7]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 8]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.compare', [ $journee = 9]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 10]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 11]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.compare', [ $journee = 12]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.compare', [ $journee = 13]) }}"> Comparer les Scores et mise à jour des points des joueurs par match pour la journée {{ $journee }}. </li>		
			<li><a href="{{ route('apuestas.points', [ $journee = 1] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.points', [ $journee = 2] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 3] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 4] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 5] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 6] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 7] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.points', [ $journee = 8] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>
			<li><a href="{{ route('apuestas.points', [ $journee = 9] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 10] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 11] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 12] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>	
			<li><a href="{{ route('apuestas.points', [ $journee = 13] ) }}"> Mise à jour des points totaux des joueurs pour la journée {{ $journee }}. </li>			
		</ul>
		
	</div>
</div>

@endsection
