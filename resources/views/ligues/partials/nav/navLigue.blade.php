<div class="lg:relative  bg-white border-t-4 border-francaverde rounded-b text-francagris px-4 py-3 mb-4">
    @if($ligue->finished == true)
    <div class="lg:absolute lg:top-0 lg:right-0 text-center text-red-600 text-xs font-thin uppercase pt-2 px-4">
        {{ __('all.League finished')}}
    </div>
    @endif
    <h1 class="text-center text-3xl font-medium">{{ $ligue->name }}</h1>
    <p class="text-center text-sm mt-1">{{$ligue->championnat->name}}</p>

    <div class="sm:flex block justify-between text-sm lg:text-base p-2">

        <div
            class="w-full border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1 transition duration-500 ease-in-out transform hover:translate-x-1 {{ Request::is('*classement*') ? 'active' : '' }}">
            <a href="{{ route('classementligue.show', $ligue) }}">
                <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                {{ __('all.Ranking')}}
            </a>
        </div>

        <div
            class="w-full border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1 transition duration-500 ease-in-out transform hover:translate-x-1 {{ Request::is('*apuestas*') ? 'active' : '' }}">
            <a href="{{ action('ApuestasController@create', $ligue) }}">
                <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                    </path>
                    <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('all.Bets')}}
            </a>
        </div>

        <div
            class="w-full border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1 transition duration-500 ease-in-out transform hover:translate-x-1 {{ Request::is('*settings') ? 'active' : '' }}">
            <a href="{{ route('ligueSettings.show', $ligue) }}">
                <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                {{ __('all.Parameters')}}
            </a>
        </div>

    </div>
</div>
