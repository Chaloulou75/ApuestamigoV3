<div class="flex-grow lg:w-1/3 justify-around m-4 shadow-lg focus:shadow-outline animated bounceInDown">
	<div class="border-4 border-francaverde rounded bg-white p-4 flex flex-col justify-between">
	    <div class="mb-8">
		    <p class="text-sm text-francagris flex items-center pb-4">
		        {{-- <svg class="fill-current text-francagris w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		          <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
		        </svg> --}}
		        <svg class="text-gray-900 w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
		    </p>
		    <div class="bg-francagris hover:bg-white text-white font-medium hover:text-francagris text-lg text-center py-2 px-4 border-4 border-francaverde rounded-full">
		      	<a href="{{ route('ligues.show', $ligue) }}" >
					{{ $ligue->name }}
				</a>
			</div>		      				      		
	    </div>
	    <div class="flex items-center justify-between">
	      <img class="w-10 h-10 rounded-full mr-4" src="/img/logo.png" alt="img">
	      <div class="text-sm">
	        <p class="text-gray-900 leading-none">{{ __('all.created by:') }} <span class="font-bold" >{{ $ligue->user_name }}</span> </p>
	        <p class="text-gray-600">{{ __('all.supporter') }} <span class="font-bold">
	        	{{ $ligue->user_club }}</span></p>
	      </div>
	    </div>
	</div>
</div>
