@extends('layouts.app')

@section('content')
               

<div class="w-full max-w-xs lg:max-w-xl lg:w-2/3 m-auto p-auto pt-8">

    <form class="bg-gray-900 border-2 border-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('contact.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-white text-base font-bold mb-2">{{ __('all.Name') }}</label>

            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
             @error('name') bg-red-dark @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white text-base font-bold mb-2">{{ __('all.E-Mail Address') }}</label>
           
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email" autofocus>

                @error('email')
                    <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror           
        </div>

        <div class="mb-4">
            <label for="msg" class="block text-white text-base font-bold mb-2">{{ __('all.Message') }}</label>
           
                <textarea id="msg" type="msg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 h-24 lg:h-40 resize leading-tight focus:outline-none focus:shadow-outline @error('msg') bg-red-dark @enderror" name="msg" value="{{ old('msg') }}" required autocomplete="msg" placeholder="message" autofocus></textarea>

                @error('msg')
                    <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror           
        </div>     

        <div class="mb-4">
            <div class="flex items-center justify-between">
                <button class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 border-2 border-white rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('all.Send') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
