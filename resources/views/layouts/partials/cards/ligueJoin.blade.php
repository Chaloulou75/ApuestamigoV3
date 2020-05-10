<div class="flex-grow lg:w-1/3 justify-around m-4 border-4 border-white rounded bg-francaverde p-4 shadow-xl focus:shadow-outline">	    
    <p class="flex text-sm text-francagris items-center m-3 pb-4">
        <svg class="fill-current text-francagris w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        </svg>
        {{ __('all.Members only')}}
    </p>

	<div class="text-center mx-auto px-auto mb-4 pb-4">
      	<a href="{{ route('joinLiguesIndex') }}" class="bg-francagris hover:bg-white text-white hover:text-francagris text-base text-center py-2 px-4 border-2 border-white hover:border-francagris rounded">
			{{ __('all.Join a league')}}
		</a>
	</div>	      				      		
</div>
