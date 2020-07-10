@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			Hey <span class="text-francaverde">{{ $user->name }} </span>, la liste des championnats:
		</h3>
		<div class="my-2">
			<a class="py-4 text-francaverde" href="{{route('championnats.create')}}"> Ajouter un championnat<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
		</div>
		<div class="my-2">
			<a class="py-4 text-francaverde" href="{{route('admin.index')}}">
			<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
			 Revenir au Dashboard Admin
			</a>
		</div>

		<div class="text-white">			
			<ul class="py-2 list-disc">
				@forelse($championnats as $championnat)
					<li class="animate__animated animate__lightSpeedInLeft py-4 px-2">id <span class="text-blue-500">{{$championnat->id}}</span>: <span class="text-francaverde">{{$championnat->name}}</span> dont le logo est <img class="inline w-10 h-10" loading="lazy" src="{{ $championnat->logourl ? url($championnat->logourl) : URL::to('/img/' .$championnat->logo) }}"></span> Championnat finis (0 = en cours) {{$championnat->finished }} <a class="px-2 text-francaverde" href="{{route('championnats.edit', $championnat)}}"> Edit {{$championnat->name}} </a> Attention cascade !
						<form class="inline-block" method="POST" action="{{route('championnats.destroy', $championnat)}}"> 
					  		@csrf 
					  		@honeypot
					  		@method('DELETE')
					  		<button type="submit" class="px-2 text-julienred"> Suprimir {{$championnat->name}}</button>
					  	</form>						
					</li>
				@empty
				<li class="py-4 px-2"> Pas de championnat pour l'instant</li>	
				@endforelse

			</ul>	
		</div>
		<div {{-- class="lg:flex justify-around" --}}>
			@livewire('admin.finish-season', ['championnats' => $championnats])
		</div>	
</div>

@endsection
