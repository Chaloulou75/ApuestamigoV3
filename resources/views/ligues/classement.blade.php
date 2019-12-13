@extends('layouts.app')

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('layouts/partials/navLigue')  
  
	<div class="container text-white">

		<div class="px-3 py-4 flex justify-center">
			<table class="table-auto w-full text-md bg-gray-900 shadow-md border-2 border-solid border-white rounded mb-4">
			  <thead>
			    <tr class="border border-solid border-white">
			      <th scope="col" class="p-3 px-5">#</th>
			      <th scope="col" class="text-left p-3 px-5">{{ __('all.Name')}}</th>
			      <th scope="col" class="text-left p-3 px-5">{{ __('all.Club')}}</th>
			      <th scope="col" class="text-center p-3 px-5">{{ __('all.Points')}}</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach ($ligue->users as $user)
			    <tr class="border border-solid border-white hover:bg-teal-600">
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




