@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
			<span class="text-francaverde"> la liste de tous les utilisateurs:
		</h3>
		<div class="my-2">
			<a class="py-4 text-francaverde" href="{{route('admin.index')}}">
			<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
			 Revenir au Dashboard Admin
			</a>
		</div>

		<div class="text-white text-sm">			
			<ul class="list-disc">
				@foreach($users as $user)
					<li class="animate__animated animate__lightSpeedInLeft">id <span class="text-blue-500">{{$user->id}}</span>: <span class="text-francaverde">{{$user->name}} - ({{$user->email }}) - (admin: {{$user->admin}})</span> dont l'équipe préférée est <span class="text-gray-500">{{$user->equipe->name}} </span> <img class="inline w-10 h-10" loading="lazy" src="{{ $user->equipe->logourl ? url($user->equipe->logourl) : URL::to('/img/' .$user->equipe->logo) }}"></span>  
						<a class="px-2 text-francaverde" href="{{route('profile.show', $user)}}"> Show {{$user->name}} </a>
						<form class="inline-block" method="POST" action="{{route('profile.destroy', $user)}}"> 
					  		@csrf 
					  		@method('DELETE')
					  		<button type="submit" class="px-2 text-julienred">Suprimir {{$user->name}}</button>
					  	</form>						
					</li>
					<ul class="pl-10 list-decimal">
					@foreach($user->ligues as $ligue)
						<li class="animate__animated animate__lightSpeedInLeft">
							<span class="text-gray-500">
								<a href=" {{route('ligues.show', $ligue)}} "> 
									{{ $ligue->name }}
								</a>
							</span>
						</li>
					@endforeach
					</ul>

				@endforeach
			</ul>	
		</div>	
</div>

@endsection
