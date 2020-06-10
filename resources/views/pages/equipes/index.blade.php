@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }} </span>, la liste de toutes les equipes:
		</h3>
		<a class="py-2 text-francaverde" href="{{route('equipes.create')}}"> Ajouter une équipe<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
		

		<div class="text-white">			
			<ul class="py-2 list-disc">
				@foreach($equipes as $equipe)
					<li class="animate__animated animate__lightSpeedInLeft py-2">id de l'equipe <span class="text-blue-500">{{$equipe->id}}</span>: <span class="text-francaverde">{{$equipe->name}}</span> dont le logo est <img class="inline w-6 h-6" loading="lazy" src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}"></span> et est dans le groupe {{$equipe->groupe}} <a class="px-2 text-francaverde" href="{{route('equipes.edit', $equipe)}}"> Edit {{$equipe->name}} </a>
						<form class="inline-block" method="POST" action="{{route('equipes.destroy', $equipe)}}"> 
					  		@csrf 
					  		@method('DELETE')
					  		<button type="submit" class="px-2 text-julienred">Suprimir {{$equipe->name}}</button>
					  	</form>						
					</li>
					
				@endforeach
			</ul>	
		</div>	
</div>

@endsection
