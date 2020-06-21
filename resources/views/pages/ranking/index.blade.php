@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">  
  
	<div class="w-full text-francagris">

		{{-- @foreach($ligues as $ligue) --}}
		<h3 class="animate__animated animate__flipInX uppercase tracking-wide px-2 text-white text-xs">Classement Général{{-- {{$ligue->name}} --}} {{-- {{__('all.leagues')}} --}} </h3>

		<div class="animate__animated animate__flipInX py-4 flex justify-center">
			<table class="table-auto w-full text-md bg-white shadow-md border-t-4 border-solid rounded border-francaverde rounded mb-4">
			
			  <thead>
			    <tr class="border border-solid border-francaverde bg-teal-200">
			      <th scope="col" class="p-3 px-5">#</th>
			      <th scope="col" class="text-left p-3 px-5">{{ __('all.Name')}}</th>
			      <th scope="col" class="text-left p-3 px-5">{{ __('all.Club')}}</th>
			      <th scope="col" class="text-center p-3 px-5">{{ __('all.Points')}}</th>
			    </tr>
			  </thead>
			  <tbody>				
			  	@foreach ($users as $user)
			    <tr class="border border-solid border-francaverde">
			      <th scope="row" class="py-1 px-4"> {{ $loop->iteration }} </th>
				  <td class="py-1 px-4 text-sm">
			  		 {{ $user->name }} <span class="text-xs text-gray-700 px-1">{{-- ({{ $ligue->name }}) --}}</span>  
				  </td>
				  <td class="py-1 px-4">				  	
				  	<img class="inline w-10 h-8 pr-2" loading="lazy" src="{{ $user->equipe->logourl ? url($user->equipe->logourl) : URL::to('/img/' .$user->equipe->logo) }}" loading="lazy" alt="club"> 
				  	<span class="hidden md:inline-block">{{ $user->equipe->name}}</span>
				  </td>
				  <td class="text-center font-semibold py-1 px-4"> {{ $user->pivot->totalPoints }} </td> 
			    </tr>

			    @endforeach
			  </tbody>

			</table>
		</div>
{{-- 		@endforeach   --}}
	</div>	
</div>
@endsection
