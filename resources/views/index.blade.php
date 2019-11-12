@extends('layouts.app')

@section('content')
	
	<div class="w-3/4 m-auto p-auto">
		<div class="border border-solid rounded border-teal-600 bg-teal-300 mb-4 p-1">
			<h1 class="text-center text-orange-600 text-3xl font-bold">Dashboard</h1>
		</div>

		<div class="flex flex-wrap items-stretch content-start justify-around my-4">

			<div class="flex-grow lg:w-1/3 justify-around m-4 border border-teal-600 rounded bg-orange-300 p-4 shadow-xl focus:shadow-outline">	    
			    <p class="flex text-sm text-teal-500 items-center m-3 pb-4">
			        <svg class="fill-current text-teal-700 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			          <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
			        </svg>
			        Members only
			    </p>
			
		    	<div class="text-center mx-auto px-auto mb-4 pb-4">
			      	<a href="{{ route('ligues.create') }}" class="bg-orange-200 hover:bg-white text-orange-600 text-base text-center py-2 px-4 border-b-2 border-teal-700 hover:border-teal-400 rounded">
						Creer ta ligue!
					</a>
				</div>	      				      		
		    </div>
		    <div class="flex-grow lg:w-1/3 justify-around m-4 border border-teal-600 rounded bg-orange-300 p-4 shadow-xl focus:shadow-outline">	    
			    <p class="flex text-sm text-teal-500 items-center m-3 pb-4">
			        <svg class="fill-current text-teal-700 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			          <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
			        </svg>
			        Members only
			    </p>
			
		    	<div class="text-center mx-auto px-auto mb-4 pb-4">
			      	<a href="{{ route('joinLiguesIndex') }}" class="bg-orange-200 hover:bg-white text-orange-600 text-base text-center py-2 px-4 border-b-2 border-teal-700 hover:border-teal-400 rounded">
						Rejoins une ligue!
					</a>
				</div>	      				      		
		    </div>
	    </div>	   	
	</div>

@endsection
