@extends('layouts.app')

@section('content')

<div class="w-3/4 m-auto p-auto">

  @include('layouts/partials/navLigue')  
  
	<div class="container text-orange-700">

		<div class="px-3 py-4 flex justify-center">
			<table class="table-auto w-full text-md bg-teal-300 shadow-md border border-solid border-teal-700 rounded mb-4">
			  <thead>
			    <tr class="border border-solid border-teal-700">
			      <th scope="col" class="p-3 px-5">#</th>
			      <th scope="col" class="text-left p-3 px-5">Name</th>
			      <th scope="col" class="text-left p-3 px-5">Club</th>
			      <th scope="col" class="text-center p-3 px-5">Points</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ($ligue->users as $user)
			    <tr class="border border-solid border-teal-700 hover:bg-teal-500">
			      <th scope="row" class="p-3 px-5"> {{ $loop->iteration }} </th>
				  <td class="p-3 px-5"> {{ $user->name }} </td>
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




