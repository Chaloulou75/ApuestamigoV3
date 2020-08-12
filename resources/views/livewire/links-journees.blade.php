<div class="m-2 relative" x-data="{ show: false }" x-on:click.away="show = false">
    <button
        class=" transition duration-500 ease-in-out transform hover:translate-x-1 focus:outline-none text-white hover:text-francaverde text-sm"
        x-bind:class="{'font-medium': show, 'shadow-none': show}" x-on:click="show = ! show">
        {{ __('all.View fixtures')}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            class="ml-1 transform inline-block fill-current w-6 h-6" x-bind:class="{'rotate-180': show }">
            <path fill-rule="evenodd"
                d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z" /></svg>
    </button>

    <div class="absolute z-30 bg-francagris text-white py-2 rounded mt-1" x-show="show"
        x-transition:enter="transition duration-200 transform ease-out" x-transition:enter-start="scale-75"
        x-transition:leave="transition duration-100 transform ease-in" x-transition:leave-end="opacity-0 scale-90">

        @foreach($todasjornadas as $fecha)

        <a class="transition duration-500 ease-in-out transform hover:translate-x-1 block hover:text-francaverde text-xs py-2 px-8"
            href="{{ action('ApuestasController@show', [$ligue, $user, $fecha]) }}">
            {{ $fecha->namejournee }}
        </a>

        @endforeach
    </div>
</div>
