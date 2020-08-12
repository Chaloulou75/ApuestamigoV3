@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

    <h3 class="animate__animated animate__flipInX text-base text-center text-white py-2">
        Hey <span class="text-francaverde">{{ $user->name }} </span>, la liste de tous les matchs:
    </h3>

    <div class="my-2">
        <a class="py-4 text-francaverde" href="{{route('admin.index')}}">
            <svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
            Revenir au Dashboard Admin
        </a>
    </div>

    <div class="py-4 flex flex-wrap justify-between">
        @livewire('admin.list-games', ['championnats' => $championnats])
    </div>

</div>

@endsection
