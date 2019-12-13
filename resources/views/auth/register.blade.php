@extends('layouts.app')

@section('content')
               

<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">

    <form class="bg-gray-900 shadow-md border-2 border-white rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
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
            <label for="club" class="block text-white text-base font-bold mb-2">
                {{ __('all.Favorite Club') }}
            </label>            
              <select id="club" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('club') ? ' bg-red-dark' : '' }}" name="club" value="{{ old('club') }}" required>              
                <option value="Borussia Dortmund">Borussia Dortmund</option>
                <option value="Bayer Leverkusen">Bayer Leverkusen</option>
                <option value="FC Bayern">FC Bayern</option>
                <option value="FC Schalke">FC Schalke</option>
                <option value="RB Leipzig">RB Leipzig</option>                
                <option value="TSG Hoffenheim">TSG Hoffenheim</option>
                <option value="Atletico Madrid">Atletico Madrid</option>
                <option value="FC Barcelona">FC Barcelona</option>
                <option value="Real Madrid">Real Madrid</option>
                <option value="Valence CF">Valence CF</option>                
                <option value="CSKA Moscow">CSKA Moscow</option>
                <option value="Zénith Saint-Petersbourg">Zénith Saint-Pétersbourg</option>                
                <option value="Lokomotiv Moscow">Lokomotiv Moscow</option>
                <option value="RB Salzburg">RB Salzburg</option>                 
                <option value="Galatasaray">Galatasaray</option>
                <option value="Juventus FC">Juventus FC</option>
                <option value="FC Inter">FC Inter</option>
                <option value="Atalanta Bergame">Atalanta Bergame</option>               
                <option value="SSC Napoli">SSC Napoli</option>
                <option value="AS Roma">AS Roma</option>
                <option value="Liverpool FC" selected="selected">Liverpool FC</option>
                <option value="Chelsea FC">Chelsea FC</option>
                <option value="Manchester City">Manchester City</option>
                <option value="Manchester United">Manchester United</option>
                <option value="Tottenham Hotspur">Tottenham Hotspur</option>
                <option value="Slavia Prague">Slavia Prague</option>                
                <option value="Olympique Lyonnais">Olympique Lyonnais</option>
                <option value="Paris SG">Paris SG</option>
                <option value="LOSC Lille">LOSC Lille</option>
                <option value="AS Monaco">AS Monaco</option>
                <option value="FC Porto">FC Porto</option>
                <option value="Benfica">Benfica</option>
                <option value="PSV Eindhoven">PSV Eindhoven</option>
                <option value="Ajax Amsterdam">Ajax Amsterdam</option>                
                <option value="Red Star Belgrade">Red Star Belgrade</option>
                <option value="Dinamo Zagreb">Dinamo Zagreb</option> 
                <option value="Shakhtar Donetsk">Shakhtar Donetsk</option>
                <option value="Viktoria Plzeň">Viktoria Plzeň</option>
                <option value="Brugge FC">Brugge FC</option>
                <option value="Racing Genk">Racing Genk</option>
                <option value="Olympiakos">Olympiakos</option>
                <option value="Young Boys Berne">Young Boys Berne</option>
                <option value="AEK Athen">AEK Athen</option>  
              </select>

                @if ($errors->has('club'))
                    <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $errors->first('club') }}</strong>
                    </span>
                @endif            
        </div>

        <div class="mb-4">
            <label for="password" class="block text-white text-base font-bold mb-2">
                {{ __('all.Password') }}
            </label>            
            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-dark @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="hidden mt-1 text-sm text-red" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>

        <div class="mb-4">
            <label for="password-confirm" class="block text-white text-base font-bold mb-2"class="block text-gray-700 text-base font-bold mb-2">
                {{ __('all.Confirm Password') }}
            </label>
            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">            
        </div>

        <div class="mb-4">
            <div class="flex items-center justify-between">
                <button class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 border-2 border-white rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('all.Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
