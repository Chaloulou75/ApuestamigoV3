@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  
  
	<div class="w-full text-francagris">

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
			  	@foreach ($ligue->users as $user)
			    <tr class="border border-solid border-francaverde">
			      <th scope="row" class="p-3 px-5"> {{ $loop->iteration }} </th>
				  <td class="p-3 px-5 hover:underline hover:text-francaverde">
				  	<a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee ]) }}">
				  		 {{ $user->name }} 
				  		 <svg class="h-5 w-5 inline-block pl-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
				  	</a></td>
				  <td class="p-3 px-5"> {{ $user->club }} </td>
				  <td class="text-center p-3 px-5"> {{ $user->pivot->totalPoints }} </td> 
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
