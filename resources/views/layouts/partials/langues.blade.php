@extends('layouts.app')

@section('content')
               

<div class="w-full max-w-xs lg:max-w-xl lg:w-2/3 m-auto p-auto pt-8">

	<div class="border-2 border-solid border-julienred rounded py-4 px-4 bg-teal-100 shadow-2xl animated bounceInDown">

	<h1 class="text-2xl font-base text-juliengris m-3"> {{__('all.Translations')}}</h1>

	@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
	  <div class="flex items-center pr-2">    
	    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="overflow-hidden flex items-center justify-center focus:outline-none focus:border-julienred m-2">
	        
	        <img class="h-8 w-8 border border-gray-900 focus:outline-none focus:border-juliengris rounded-full object-cover" alt="{{ $properties['native'] }}" src="{!! asset('img/flags/' . $localeCode. '.png') !!}"/>
	        
		    <div class="text-juliengris ml-2 mr-2">
		     	{{ $properties['native'] }} 
		 	</div>
		</a>
	  </div>    
	@endforeach

	</div>

</div>

@endsection
