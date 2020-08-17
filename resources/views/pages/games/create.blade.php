@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-1">

    <h3 class="text-base text-center text-white py-2">
        Hey <span class="text-francaverde">{{ $user->name }}</span>, mets les prochains matchs
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
        <form class="mx-auto" method="POST" action="{{ action('GameController@store') }}">
            @csrf
            @honeypot

            <div class="mb-4">
                <label for="championnat_id" class="block text-white text-base font-medium mb-2">
                    {{ __('all.choose a championship') }}
                </label>
                <select id="championnat_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('championnat_id') ? ' bg-red-dark' : '' }}"
                    name="championnat_id" value="{{ old('championnat_id') }}" required>

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
                    Journée
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                    id="journee" name="journee" placeholder="{{old('journee')}}">

                    @foreach($journees as $journee)
                    <option value="{{$journee->id }}"> {{ $journee->namejournee }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="equipe1_id">
                    Home Team
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                    id="equipe1_id" name="equipe1_id" placeholder="{{old('equipe1_id')}}">
                    @foreach ($equipes as $equipe)

                    <option value="{{ $equipe->id }}">{{ $equipe->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-white text-sm font-base mb-2" for="equipe2_id"> Away Team</label>
                <select
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="equipe2_id" name="equipe2_id" placeholder="{{old('equipe2_id')}}">
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
                    Enregistrer le match
                </button>

            </div>
        </form>
    </div>

</div>

@endsection
