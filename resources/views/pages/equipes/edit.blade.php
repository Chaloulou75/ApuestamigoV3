@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto">

		<div class="border-t-4 border-double border-francaverde bg-francagris">
	  		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-semibold my-4">{{ $equipe->name }}</h1>
	  	</div>
			
		</h1>
		<p class="text-base text-center text-francaverde py-2"><a href="{{route('equipes.index')}}">Retourner à la liste des équipes</a></p>

		@if ($errors->any())
		    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-200 p-4" role="alert">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<div class="w-full lg:w-1/2 mx-auto bg-francagris shadow-md border-2 border-white rounded py-8 px-8 my-4">
		  <form class="mx-auto" method="POST" enctype="multipart/form-data" action="{{ action('EquipeController@update', $equipe) }}">
		  		@csrf
		  		@honeypot
		  		@method('PUT')
		  	<div class="mb-4">
		        <label for="championnat_id" class="block text-white text-base font-medium mb-2">
		            {{ __('all.choose a championship') }}
		        </label>            
		        <select id="championnat_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('championnat_id') ? ' bg-red-dark' : '' }}" name="championnat_id" value="{{ old('championnat_id') }}" placeholder="{{$equipe->championnat_id}}" required> 

		          @foreach($championnats as $championnat)

		          <option class="py-4" value="{{ $championnat->id }}">{{ $championnat->name}} </option>

		          @endforeach     
		        </select>

		        @if ($errors->has('championnat_id'))
		            <span class="mt-1 text-sm text-julienred" role="relative px-3 py-3 mb-4 border rounded">
		                <strong>{{ $errors->first('championnat_id') }}</strong>
		            </span>
		        @endif            
		    </div>	
		  	<div class="mb-4">
		      <label for="name" class="block text-white text-sm font-medium tracking-wide mb-2">{{ __('Nom d\'équipe') }}</label>

	            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-julien-gris leading-loose focus:outline-none focus:shadow-outline
	             @error('name') bg-red-dark @enderror" name="name" value="{{ $equipe->name }}" required autocomplete="name">

	            @error('name')
	                <span class=" mt-1 text-sm text-red-500" role="relative px-3 py-3 mb-4 border rounded">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
		    </div>

		      <div class="mb-4">
		        <label for="logo" class="block text-white text-sm font-medium tracking-wide mb-2 ">{{ __(' logo du club') }}</label>
				<div class="flex">
		            <input id="logo" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-white leading-loose focus:outline-none focus:shadow-outline @error('logo') bg-red-dark @enderror" name="logo" value="" autocomplete="logo">

		            <img src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}" loading="auto" class="h-12 w-12 object-scale-down" alt="logo">
		        </div>

	            @error('logo')
	                <span class=" mt-1 text-sm text-red-500" role="relative px-3 py-3 mb-4 border rounded">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
		    </div>
		    <div class="mb-4">
		      <label for="groupe" class="block text-white text-sm font-medium tracking-wide mb-2">{{ __('Groupe') }}</label>

	            <input id="groupe" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-julien-gris leading-loose focus:outline-none focus:shadow-outline
	             @error('groupe') bg-red-dark @enderror" name="groupe" value="{{ $equipe->groupe }}" autocomplete="groupe">

	            @error('groupe')
	                <span class=" mt-1 text-sm text-red-500" role="relative px-3 py-3 mb-4 border rounded">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
		    </div>
		    
		    <div class="flex items-center justify-between">
		      <button class="w-full bg-francagris text-white hover:text-francaverde text-sm py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
		        Mettre à jour l'équipe
		      </button>
		      
		    </div>
		  </form>	  
		</div>
	
</div>

@endsection
