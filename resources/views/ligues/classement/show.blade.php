@extends('layouts.app' , ['title' => __('all.Ranking') ])

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

    @include('ligues/partials/nav/navLigue')

    <div class="w-full text-francagris">

        <livewire:apuestas.classement :ligue="$ligue" :journee="$journee" />

    </div>
</div>

@endsection
