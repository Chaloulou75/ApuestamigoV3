<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content=" {{  __('all.Betting leagues between friends on the champions league and find who is the best tipster.')}}">
        <meta name="google-site-verification" content="6W4yift1Bmm_Vc73-PUZ4DcHn3VS7OIYfIXjXRcGDD0" />
        <title>{{ config('app.name', 'Apuestamigo') }}</title>
        
        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
        
    </head>
    <body class="body bg-francagris">{{-- bg-scrollstyle="background-image: url(/img/champions.png)" --}}
        <div id="app">

            <navbar-component :user='@json(Auth::user())'></navbar-component>

            <x-carousel-card equipes= {{$equipes}}/>

            @include('layouts/partials/message')

            @if(session('success'))

            <div class="container mx-auto">
                <div class="relative px-3 py-3 mb-4 border rounded text-green-600 border-green-500 bg-green-400">
                    {{ session ('success')}}
                </div>
            </div>
            @endif
            
            @if (session('error'))
            <div class="container mx-auto">
                <div class="relative px-3 py-3 mb-4 border rounded text-red-700 border-red-500 bg-red-400">
                    {{ session ('error')}}
                </div>
            </div>
            @endif

            <main class="py-4">
                @yield('content')
            </main>
            
        </div>

        <script src="/js/app.js"></script>
        @stack('scripts')
        @livewireScripts
    </body>
</html>
