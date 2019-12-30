<div class="border-2 border-solid rounded border-white text-white bg-gray-900 mb-4 p-1">
  <h1 class="text-center text-3xl font-bold">{{ $ligue->name }}</h1>
  <div class="sm:flex block justify-between text-sm lg:text-base p-2">
    <div class="w-auto border-2 border-solid rounded-full border-white flex-grow text-center hover:text-gray-900 text-white bg-gray-900 hover:bg-white font-semibold px-4 py-2 m-1">
      <a  href="{{ route('ligueClassement', $ligue) }}">
          <i class="fas fa-award pr-1 hidden sm:inline-block"></i> {{ __('all.Ranking')}}
      </a>
    </div>
    <div class="w-auto border-2 border-solid rounded-full border-white flex-grow text-center hover:text-gray-900 text-white bg-gray-900 hover:bg-white font-semibold px-4 py-2 m-1">
      <a href="{{ action('ApuestasController@index', $ligue) }}">
        <i class="far fa-hand-point-right pr-1 hidden sm:inline-block"></i> {{ __('all.Bets')}}
      </a>
    </div>
    <div class="w-auto border-2 border-solid rounded-full border-white flex-grow text-center hover:text-gray-900 text-white bg-gray-900 hover:bg-white font-semibold px-4 py-2 m-1">
        <a href="{{ route('ligueSettings', $ligue) }}">
        <i class="fas fa-cog pr-1 hidden sm:inline-block"></i> {{ __('all.Parameters')}}
      </a>
    </div>

  </div>
</div>
