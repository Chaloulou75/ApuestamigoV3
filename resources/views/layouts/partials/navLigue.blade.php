<div class="bg-white border-t-4 border-francaverde rounded-b text-francagris px-4 py-3 mb-4 animated bounceInDown transition-none">
  <h1 class="text-center text-3xl font-medium">{{ $ligue->name }}</h1>
  <div class="sm:flex block justify-between text-sm lg:text-base p-2">
    <div class="w-auto border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1">
      <a href="{{ route('ligueClassement', $ligue) }}">
          <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
           {{ __('all.Ranking')}}
      </a>
    </div>
    <div class="w-auto border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1">
      <a href="{{ action('ApuestasController@index', $ligue) }}">
        <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
         {{ __('all.Bets')}}
      </a>
    </div>
    <div class="w-auto border-2 border-solid rounded-lg border-francaverde flex-grow text-center hover:text-francaverde text-white bg-francagris font-medium px-4 py-2 m-1">
        <a href="{{ route('ligueSettings', $ligue) }}">
        <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
         {{ __('all.Parameters')}}
      </a>
    </div>

  </div>
</div>
