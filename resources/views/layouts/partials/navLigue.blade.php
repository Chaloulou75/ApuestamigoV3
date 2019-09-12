<div class="border border-solid rounded border-teal-600 bg-teal-300 mb-4 p-1">
  <h1 class="text-center text-orange-600 text-3xl font-bold">{{ $ligue->name }}</h1>
  <div class="flex text-md text-center">
    <a  href="{{ route('ligueClassement', $ligue) }}" class="flex-grow block mt-1 inline-block text-orange-600 hover:text-orange-800 mr-4 font-bolt">
        <i class="fas fa-award pr-1"></i> Classement
    </a>
    <a href="{{ route('ligueApuestas', $ligue) }}" class="flex-grow block mt-1 inline-block text-orange-600 hover:text-orange-800 mr-4 font-bolt">
      <i class='far fa-hand-point-right pr-1'></i>Apuestas
    </a>
    <a href="{{ route('ligueSettings', $ligue) }}" class="flex-grow block mt-1 inline-block text-orange-600 hover:text-orange-800 mr-4 font-bolt">
      <i class='fas fa-cog pr-1'></i>Settings
    </a>
  </div>
</div>
