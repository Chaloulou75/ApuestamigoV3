@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="animate__animated animate__headShake flex flex-col break-words bg-francagris text-white border-2 border-francaverde rounded shadow-md mt-6">

                <div class="font-normal text-francaverde py-3 px-6 mb-0">
                        {{ __('all.Register') }}
                </div>

                <form id="register-form" class="w-full py-2 px-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    @honeypot

                    <div class="flex flex-wrap mb-6">
                        <label for="name" class="block text-sm font-normal mb-2">
                            {{ __('all.Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full shadow appearance-none border rounded py-2 px-3 text-francagris leading-tight focus:outline-none focus:shadow-outline @error('name')  border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-sm font-normal mb-2">
                            {{ __('all.E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-francagris leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="equipe_id" class="block text-sm font-normal mb-2">
                            {{ __('all.Favorite Club') }}
                        </label>
                        <select id="equipe_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-francagris leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('equipe_id') ? ' bg-red-dark' : '' }}" name="equipe_id" value="{{ old('equipe_id') }}" required>
                            <option value=""></option>
                            @foreach($equipes as $equipe)

                            <option value="{{ $equipe->id}}"  @if(old('equipe_id') == $equipe->name)selected @endif>{{ $equipe->name}} </option>

                            @endforeach
                        </select>

                        @if ($errors->has('club'))
                            <span class="mt-1 text-sm text-julienred" role="relative px-3 py-3 mb-4 border rounded">
                                <strong>{{ $errors->first('club') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-sm font-normal mb-2">
                            {{ __('all.Password') }}:
                        </label>

                        <input id="password" type="password" class="form-input w-full shadow appearance-none border rounded py-2 px-3 text-francagris leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class="block text-sm font-normal mb-2">
                            {{ __('all.Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="form-input w-full shadow appearance-none border rounded py-2 px-3 text-francagris leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit" class="g-recaptcha inline-block align-middle text-center select-none whitespace-no-wrap text-base leading-normal no-underline w-full bg-francagris  text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline"
                        data-sitekey="{{ config('services.recaptcha.key')}}" data-callback='onSubmit'>
                            {{ __('all.Register') }}
                        </button>

                        <p class="w-full text-xs text-center my-4">
                            {{ __('all.Already have an account?') }}
                            <a class="hover:text-francaverde uppercase tracking-wide underline" href="{{ route('login') }}">
                                {{ __('all.Login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            <p class="text-center text-white text-xs mt-5">
                  &copy; {{ date('Y') }} &middot; Charles Jeandey. {{__('all.All rights reserved.')}}.
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
     document.getElementById("register-form").submit();
    }
    </script>

@endpush
