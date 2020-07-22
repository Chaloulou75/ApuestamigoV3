@extends('layouts.app' , ['title' => $ligue->name])

@section('content')

<div class="w-full lg:w-3/4 m-auto p-1">

  @include('ligues/partials/nav/navLigue')  
  

</div>

@endsection
