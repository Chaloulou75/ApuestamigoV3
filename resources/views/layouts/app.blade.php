<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Apuestamigo') }}</title>

        <!-- Fonts -->
        
        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body class="body bg-gray-800">
        <div id="app">

            @include('layouts/nav')
            {{-- @include('layouts/partials/nav2') --}}

            <nav-component></nav-component>

            @include('layouts/partials/carousel')


            @include('layouts/partials/message')

            @if(session('success'))

            <div class="container mx-auto mx-auto">
                <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter">
                    {{ session ('success')}}
                </div>
            </div>
            @endif
            
            @if (session('error'))
            <div class="container mx-auto mx-auto">
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter">
                    {{ session ('error')}}
                </div>
            </div>
            @endif

            <main class="py-4">
                @yield('content')
            </main>

            <cookie-banner-component></cookie-banner-component>

            

        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
