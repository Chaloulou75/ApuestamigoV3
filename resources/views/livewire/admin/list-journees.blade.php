@foreach ($championnats as $championnat)
<div class="m-2" x-data="{ show: false }" x-on:click.away="show = false">
    <button
        class="relative transition duration-500 ease-in-out transform hover:translate-x-1 focus:outline-none text-white hover:text-francaverde text-sm"
        x-bind:class="{'font-medium': show, 'shadow-none': show}" x-on:click="show = ! show">
        <svg class="inline w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" stroke="currentColor">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        {{ __('Liste des journées pour ')}} {{ $championnat->name}}

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            class="ml-1 transform inline-block fill-current w-6 h-6" x-bind:class="{'rotate-180': show }">
            <path fill-rule="evenodd"
                d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z" /></svg>
    </button>

    <div class="absolute z-30 bg-francagris text-white py-2 rounded mt-1" x-show="show"
        x-transition:enter="transition duration-200 transform ease-out" x-transition:enter-start="scale-75"
        x-transition:leave="transition duration-100 transform ease-in" x-transition:leave-end="opacity-0 scale-90">

        <ul class="list-none">
            @forelse($championnat->journees as $datejournee)
            <div class="border-b border-francaverde py-2 px-2">
                <li class="text-sm py-2 px-4">
                    <span class="text-xs text-gray-300">id: {{$datejournee->id}}</span>-
                    <span class="text-francaverde">{{$datejournee->namejournee }} </span>

                </li>
                <li class="text-sm py-2 px-4 italic text-gray-400"> le
                    {{ \Carbon\Carbon::parse($datejournee->timejournee)->isoFormat('dddd Do MMMM YYYY H:mm') }}</li>
                <div class="flex justify-between">
                    <a class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-sm py-2 px-4"
                        href="{{ route('datejournees.edit', ['datejournee' => $datejournee]) }}"> Edit
                    </a>
                    <form class="inline-block" method="POST" action="{{route('datejournees.destroy', $datejournee)}}">
                        @csrf
                        @honeypot
                        @method('DELETE')
                        <button type="submit"
                            class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-sm py-2 px-4">Suprimir</button>
                    </form>
                </div>
            </div>
            @empty
            <li class="py-4 px-2"> Pas de journée pour l'instant</li>
            @endforelse
        </ul>
    </div>
</div>
@endforeach
