@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

    <h3 class="text-base text-center text-white py-2">
        Hey <span class="text-francaverde">{{ $user->name }}</span>, Mets à jour le match:</br>
        {{$game->championnat->name }}, Journée <span
            class="text-blue-500">@isset($game->journee->namejournee){{ $game->journee->namejournee }}
            {{ $game->journee->season }}@endisset</span> Match qui oppose:
        <span class="text-francaverde">{{ $game->homeTeam->name }}</span> et <span
            class="text-francaverde">{{ $game->awayTeam->name }}</span>, prévu le <span
            class="italic">{{ \Carbon\Carbon::parse($game->gamedate)->timezone('Europe/Paris')->isoFormat('dddd Do MMMM YYYY H:mm') }} (FR)
        </span>
    </h3>
    <p class="text-base text-center text-francaverde py-2">
        <a href="{{route('games.index')}}">
            Retourner à la liste des matchs
        </a>
    </p>

    @if ($errors->any())
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-200 p-4" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full lg:w-1/3 mx-auto bg-francagris shadow-md border-2 border-white rounded py-8 px-8 my-4">
        <form class="mx-auto" method="POST" action="{{ action('GameController@update', $game)}}">
            @method('PUT')
            @csrf
            @honeypot

            <div class="mb-4">
                <label for="championnat_id" class="block text-white text-base font-medium mb-2">
                    {{ __('all.choose a championship') }}
                    <span class="text-xs text-gray-300 italic">
                    {{ $game->championnat->name }} </span>
                </label>
                <select id="championnat_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('championnat_id') ? ' bg-red-dark' : '' }}"
                    name="championnat_id" value="{{ old('championnat_id') }}" placeholder="{{$game->championnat_id}}"
                    required>

                    @foreach($championnats as $championnat)

                    <option class="py-4" value="{{ $championnat->id }}">{{ $championnat->name}} </option>

                    @endforeach
                </select>

                @if ($errors->has('championnat_id'))
                <span class="mt-1 text-sm text-julienred" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $errors->first('championnat_id') }}</strong>
                </span>
                @endif
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="journee">
                    Journée: <span class="text-xs text-gray-300 italic">{{ $game->journee->namejournee }} ({{ $game->journee->championnat->name }})</span>
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                    id="journee" name="journee" placeholder="{{ $game->journee->namejournee }}">
                    @foreach($journees as $journee)
                    <option value="{{ $journee->id }}"> {{ $journee->namejournee }} ({{ $journee->championnat->name }})</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="equipe1_id">
                    Home Team <span class="text-xs text-gray-300 italic">({{ $game->homeTeam->name }})</span>
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                    id="equipe1_id" name="equipe1_id" placeholder="{{ $game->homeTeam->name }}">
                    @foreach ($equipes as $equipe)

                    <option value="{{ $equipe->id }}">{{ $equipe->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="equipe2_id"> Away Team <span class="text-xs text-gray-300 italic">({{ $game->awayTeam->name }})</span>
                </label>
                <select
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="equipe2_id" name="equipe2_id" placeholder="{{ $game->awayTeam->name }}">
                    @foreach ($equipes as $equipe)

                    <option value="{{ $equipe->id }}">{{ $equipe->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="gamedate">Choose a date (UTC):</label>

                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                    type="datetime-local" id="gamedate" name="gamedate" value="">
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="w-full bg-francagris text-white hover:text-francaverde text-sm py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Editer le match
                </button>

            </div>
        </form>
    </div>

</div>

@endsection
