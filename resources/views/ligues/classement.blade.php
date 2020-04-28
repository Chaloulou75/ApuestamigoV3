@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  
  
	<div class="w-full text-francagris">

		<div class="px-3 py-4 flex justify-center animated rotateInUpLeft">
			<table class="table-auto w-full text-md bg-white shadow-md border-t-4 border-solid rounded border-francaverde rounded mb-4">
			  <thead>
			    <tr class="border border-solid border-francaverde">
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
				  <td class="p-3 px-5 hover:underline hover:text-francaverde hover:font-semibold"><a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee ]) }}"> {{ $user->name }} </a></td>
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




