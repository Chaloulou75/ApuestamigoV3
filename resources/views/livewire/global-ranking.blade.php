<div class="w-full lg:w-3/4 m-auto p-1">  
  
	<div class="w-full text-francagris">

		<h3 class="animate__animated animate__flipInX uppercase tracking-wide text-center text-white text-sm mb-8"> {{__('all.Global ranking')}}</h3>

		
		<div class="flex flex-row justify-between">
			<div class="mb-2 text-white text-sm">
				{{ __('Show') }}
				<select id="per_page" wire:model.lazy="perPage" class="text-francagris border border-francaverde rounded-lg px-2 mx-1 py-1 text-sm">
					@for($i=2; $i<=10; $i+= 2)
						<option value="{{ $i }}">{{ $i }}</option>	
					@endfor					
				</select>
				<label for="per_page">{{ __('per page') }}</label>
			</div>

			<div class="mb-2 text-white text-sm">
				<label for="query" class="sr-only"> {{__('Search')}}</label>
				<input id="query" wire:model="query" type="search" class="text-francagris border border-francaverde rounded-lg px-4 py-1 ml-1 text-sm">
			</div>
		</div>
		
		<div class="py-4 flex justify-center">
			<table class="table-auto w-full text-md bg-white shadow-md border-t-4 border rounded border-francaverde rounded mb-4">			
			  <thead>
			    <tr class="border border-solid border-francaverde bg-francagris text-white ">
			      <th scope="col" class="p-3 px-5 font-light">#</th>
			      <th scope="col" class="text-left p-3 px-5 font-light">{{ __('all.Name')}}</th>
			      <th scope="col" class="text-left p-3 px-5 font-light">{{ __('all.Club')}}</th>
			      <th scope="col" class="text-center p-3 px-5 font-light">{{ __('all.Points')}}</th>
			    </tr>
			  </thead>
			  <tbody>				
			  	@foreach ($users as $user)
			    <tr class="border border-solid border-francaverde">
			      <td scope="row" class="py-2 px-4 text-center"> {{ $loop->iteration }} </td>
				  <td class="py-2 px-4 text-sm">
			  		{{ $user->name }}
				  </td>
				  <td class="py-2 px-4">				  	
				  	<img class="inline w-10 h-8 pr-2" loading="lazy" src="{{ $user->equipe->logourl ? url($user->equipe->logourl) : URL::to('/img/' .$user->equipe->logo) }}" loading="lazy" alt="club"> 
				  	<span class="hidden md:inline-block text-xs uppercase">{{ $user->equipe->name}}</span>
				  </td>
				  <td class="text-center font-medium py-2 px-4">
				{{--    {{ $user->pivot->totalPoints }}   --}}
				  </td> 
			    </tr>
			    @endforeach
			  </tbody>
			</table>			
		</div>

		<div class="text-sm py-2 px-4 text-white">
			{{ $users->links() }}
		</div>
	</div>	
</div>
