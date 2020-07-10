@extends('layouts.app' , ['title' => __('nav.contact') ])

@section('content')               

<div class="w-full lg:w-1/2 mx-auto">

    <div class="border-t-4 border-double border-francaverde bg-francagris mb-4">
        <h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-semibold pt-4">{{ __('nav.contact') }}</h1>
    </div>

    <form class="animate__animated animate__fadeInUp bg-francagris border-2 border-francaverde shadow-md rounded px-8 py-6 " method="POST" action="{{ route('contact.store') }}">
        @csrf
        @honeypot

        <div class="mb-4">
            <label for="name" class="block text-white text-base font-medium mb-2">{{ __('all.Name') }}</label>

            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
             @error('name') bg-red-dark @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

            @error('name')
                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white text-base font-medium mb-2">{{ __('all.E-Mail Address') }}</label>
           
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror           
        </div>

        <div class="mb-4">
            <label for="msg" class="block text-white text-base font-medium mb-2">{{ __('all.Message') }}</label>
           
                <textarea id="msg" type="msg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 h-24 lg:h-40 resize leading-tight focus:outline-none focus:shadow-outline @error('msg') bg-red-dark @enderror" name="msg" value="{{ old('msg') }}" required autocomplete="msg"></textarea>

                @error('msg')
                    <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror           
        </div>     

        <div class="mb-4">
            <div class="block items-center justify-between">
                <button class="w-full items-center bg-francagris text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    <svg class="h-5 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ __('all.Send') }} &raquo;
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
