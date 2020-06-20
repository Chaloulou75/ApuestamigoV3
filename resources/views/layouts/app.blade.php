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
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-5RMT6BBR84"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-5RMT6BBR84');
        </script>
        <!--  stripe -->
        <script src="https://js.stripe.com/v3/"></script>
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

            @admin

            <footer class='w-full text-center text-lg text-white hover:text-francaverde tracking-wider border-t border-gray-700 p-4 mt-4 bottom-0'>
                <a href="{{ route('donate.index') }}"><svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> {{ __('all.Wanna`\' buy me a beer?')}}</a>
            </footer>

            @endadmin
            
        </div>

        <script src="/js/app.js"></script>
        @stack('scripts')
        @livewireScripts
    </body>
</html>
