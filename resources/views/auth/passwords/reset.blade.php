@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">{{ __('all.Reset Password') }}

        <div class="flex-auto p-6">
            <form  method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-base font-bold mb-2">{{ __('all.E-Mail Address') }}</label>
                    
                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-base font-bold mb-2">{{ __('all.Password') }}</label>
                    
                    <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-dark @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4 ">
                    <label for="password-confirm" class="block text-gray-700 text-base font-bold mb-2">{{ __('all.Confirm Password') }}</label>
                   
                    <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                    
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('all.Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
