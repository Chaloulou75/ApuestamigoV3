@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">

    <div class="flex flex-col break-words bg-francagris text-white border-2 border-francaverde rounded shadow-md">

        <div class="font-normal bg-francagris text-francaverde py-3 px-3 mb-0">{{ __('all.Reset Password') }}</div>


        @if (session('status'))
        <div class="relative px-3 py-3 mb-4 rounded text-white text-sm underline" role="relative px-3 py-3 mb-4">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="w-full py-2 px-6">
            @csrf
            @honeypot

            <div class="mb-4">
                <label for="email" class="block text-sm font-normal mb-2">
                    {{ __('all.E-Mail Address') }}
                </label>
                <input id="email" type="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-francagris text-white hover:text-francaverde text-sm font-normal py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline">
                        {{ __('all.Send Password Reset Link') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
