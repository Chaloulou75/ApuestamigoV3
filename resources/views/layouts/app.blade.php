<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{  __('all.Betting leagues between friends on the champions league and find who is the best tipster.')}}">
        <meta name="google-site-verification" content="6W4yift1Bmm_Vc73-PUZ4DcHn3VS7OIYfIXjXRcGDD0" />
        <title> @isset($title) {{ $title }} | @endisset {{ config('app.name', 'Apuestamigo') }}</title>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-5RMT6BBR84"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-5RMT6BBR84');
        </script>        
        <!--  stripe -->
        {{-- <script src="https://js.stripe.com/v3/" ></script> --}}                
        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" >
        <!-- Livewire -->  
        @livewireStyles
        <!-- Scripts -->               
        <script src="{{ mix('js/app.js') }}"></script> 
        @stack('scripts') 
        <!-- Livewire --> 
        @livewireScripts                 
    </head>
    
    <body class="body bg-francagris">{{-- bg-scrollstyle="background-image: url(/img/champions.png)" --}}
        <div id="app" class="h-screen flex flex-col space-between">

            {{-- <navbar-component :user='@json(Auth::user())'></navbar-component> --}}

            @include('layouts/partials/navbar')

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

            <main class="py-4 mb-auto">
                @yield('content')
            </main>

            <x-carousel-card equipes= {{$equipes}}/>            
        </div>         
    </body>
</html>
