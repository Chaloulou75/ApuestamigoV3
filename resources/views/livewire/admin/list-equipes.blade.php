@foreach ($championnats as $championnat)
<div class="m-2" x-data="{ show: false }" x-on:click.away="show = false">
    <button class="relative transition duration-500 ease-in-out transform hover:translate-x-1 focus:outline-none text-white hover:text-francaverde text-sm" 
    x-bind:class="{'font-medium': show, 'shadow-none': show}" 
    x-on:click="show = ! show" 
    >
        <svg class="inline w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
    	{{ __('Liste des equipes en')}} {{$championnat->name}}
    	
    	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-1 transform inline-block fill-current w-6 h-6" x-bind:class="{'rotate-180': show }" ><path fill-rule="evenodd" d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
    </button>

    <div class="absolute z-30 bg-francagris text-white py-2 rounded mt-1"
     		x-show="show"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">

		<ul class="list-none">	
    	@forelse($championnat->equipes as $equipe)		
			<div class="border-b border-francaverde py-2 px-2">
				<li class="text-sm py-2 px-2">
					<img class="inline w-10 h-10" loading="lazy" src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}">
					<span class="text-xs text-gray-300">id: {{$equipe->id}}</span>-
					<span class="text-francaverde">{{$equipe->name}}</span>													
				</li>
				<div class="flex justify-between">
					<a class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-xs py-2 px-4" href="{{route('equipes.edit', $equipe)}}"> Edit
			        </a>
			        <form class="inline-block" method="POST" action="{{route('equipes.destroy', $equipe)}}">
			         	@csrf 
				  		@honeypot
				  		@method('DELETE')
				  		<button type="submit" class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-xs py-2 px-4"> Suprimir</button>
				  	</form>	
				</div>		    	
		  	</div>   		
	    @empty
	    	<li class="py-4 px-2"> Pas d\'équipe pour l'instant</li>		
    	@endforelse
    	</ul>    		
    </div>
</div>
@endforeach
