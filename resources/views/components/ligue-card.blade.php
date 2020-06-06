<div class="animate__animated animate__flipInY animate__slow flex-grow lg:w-1/3 justify-around m-4 shadow-lg focus:shadow-outline">
	<div class="border-4 border-francaverde rounded bg-francagris p-4 flex flex-col justify-between">
	    <div class="mb-8">
		    <p class="text-sm flex items-center pb-4">
		        <svg class="text-gray-200 w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
		    </p>
		    <div class="text-white hover:text-francaverde font-medium text-lg text-center py-2 px-4">
		      	<a href="{{ route('ligues.show', $ligue) }}" >
					{{ $ligue->name }}
				</a>
			</div>		      				      		
	    </div>
	    <div class="flex items-center justify-between">
	      <img class="w-10 h-10 rounded-full mr-4" src="/img/logo.png" alt="logoChampions">
	      <div class="text-sm">
	        <p class="text-gray-100 leading-none">{{ __('all.created by:') }} <span class="font-medium text-francaverde" >{{ $ligue->user_name }}</span> </p>
	        <p class="text-gray-300">{{ __('all.supporter') }} <span class="font-medium text-francaverde">
	        	{{ $ligue->user_club }}</span></p>
	      </div>
	    </div>
	</div>
</div>
