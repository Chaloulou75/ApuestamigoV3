<div class="m-2" x-data="{ show: false }" x-on:click.away="show = false">
    <button
        class="relative transition duration-500 ease-in-out transform hover:translate-x-1 focus:outline-none text-white hover:text-francaverde text-sm"
        x-bind:class="{'font-medium': show, 'shadow-none': show}" x-on:click="show = ! show">
        <svg class="inline w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" stroke="currentColor">
            <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
        </svg>
        {{ __('Liste des championnats')}}

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            class="ml-1 transform inline-block fill-current w-6 h-6" x-bind:class="{'rotate-180': show }">
            <path fill-rule="evenodd"
                d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z" /></svg>
    </button>

    <div class="absolute z-30 bg-francagris text-white py-2 rounded mt-1" x-show="show"
        x-transition:enter="transition duration-200 transform ease-out" x-transition:enter-start="scale-75"
        x-transition:leave="transition duration-100 transform ease-in" x-transition:leave-end="opacity-0 scale-90">

        <ul class="list-none">
            @forelse($championnats as $championnat)
            <div class="border-b border-francaverde py-2">
                <li class="text-sm py-2 px-4">
                    <img class="inline w-10 h-10" loading="lazy"
                        src="{{ $championnat->logourl ? url($championnat->logourl) : URL::to('/img/' .$championnat->logo) }}">
                    id <span class="text-gray-300">{{$championnat->id}}</span>:
                    <span class="text-francaverde">{{$championnat->name}}</span>

                    <span class="text-xs text-gray-300">Championnat terminé? (0 = en cours): {{$championnat->finished }}
                    </span>
                </li>
                <div class="flex justify-between">
                    <a class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-sm py-2 px-4"
                        href="{{route('championnats.edit', $championnat)}}"> Edit {{$championnat->name}}
                    </a>
                    <form class="inline-block" method="POST" action="{{route('championnats.destroy', $championnat)}}">
                        @csrf
                        @honeypot
                        @method('DELETE')
                        <button type="submit"
                            class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-sm py-2 px-4">
                            Suprimir {{$championnat->name}}</button>
                    </form>
                </div>
            </div>
            @empty
            <li class="py-4 px-2"> Pas de championnat pour l'instant</li>

            @endforelse
        </ul>

    </div>
</div>
