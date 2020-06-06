@extends('layouts.app')

@section('content')
               
<div class="w-full md:w-1/3 mx-auto">

	<h1 class="text-2xl font-medium text-white text-center py-4"> {{__('all.Translations')}}</h1>

	<div class="items-center border-2 border-solid border-francaverde rounded py-4 px-4 bg-francagris ">

	@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
	  <div class="flex items-start ">    
	    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="overflow-hidden flex items-center justify-between focus:outline-none mx-auto my-3">	        
	        <img class="h-8 w-8 border border-francaverde focus:outline-none focus:border-white rounded-full object-cover mr-3" loading="lazy" alt="{{ $properties['native'] }}" src="{!! asset('img/flags/' . $localeCode. '.png') !!}"/>
	        
		    <div class="text-white hover:text-francaverde mx-auto">
		     	{{ $properties['native'] }} 
		 	</div>
		</a>
	  </div>    
	@endforeach

	</div>

</div>

@endsection
