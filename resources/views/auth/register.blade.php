@extends('layouts.app')

@section('content')
               

<div class="w-full max-w-xs lg:w-1/3 m-auto p-auto pt-8">

    <form class="bg-gray-900 shadow-md border-2 border-white rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-white text-base font-medium mb-2">{{ __('all.Name') }}</label>

            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
             @error('name') bg-red-dark @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class=" mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white text-base font-medium mb-2">{{ __('all.E-Mail Address') }}</label>
           
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email" autofocus>

                @error('email')
                    <span class=" mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror           
        </div>

        <div class="mb-4">
            <label for="club" class="block text-white text-base font-medium mb-2">
                {{ __('all.Favorite Club') }}
            </label>            
              <select id="club" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('club') ? ' bg-red-dark' : '' }}" name="club" value="{{ old('club') }}" required>              
                <option value="Borussia Dortmund"  @if(old('club') == 'Borussia Dortmund')selected @endif>Borussia Dortmund</option>
                <option value="Bayer Leverkusen" @if(old('club') == 'Bayer Leverkusen')selected @endif>Bayer Leverkusen</option>
                <option value="FC Bayern" @if(old('club') == 'FC Bayern')selected @endif>FC Bayern</option>
                <option value="FC Schalke" @if(old('club') == 'FC Schalke')selected @endif>FC Schalke</option>
                <option value="RB Leipzig" @if(old('club') == 'RB Leipzig')selected @endif>RB Leipzig</option>                
                <option value="TSG Hoffenheim" @if(old('club') == 'TSG Hoffenheim')selected @endif>TSG Hoffenheim</option>
                <option value="Atletico Madrid" @if(old('club') == 'Atletico Madrid')selected @endif>Atletico Madrid</option>
                <option value="FC Barcelona" @if(old('club') == 'FC Barcelona')selected @endif>FC Barcelona</option>
                <option value="Real Madrid" @if(old('club') == 'Real Madrid')selected @endif>Real Madrid</option>
                <option value="Valence CF" @if(old('club') == 'Valence CF')selected @endif>Valence CF</option>                
                <option value="CSKA Moscow" @if(old('club') == 'CSKA Moscow')selected @endif>CSKA Moscow</option>
                <option value="Zénith Saint-Petersbourg" @if(old('club') == 'Zénith Saint-Petersbourg')selected @endif>Zénith Saint-Pétersbourg</option>                
                <option value="Lokomotiv Moscow" @if(old('club') == 'Lokomotiv Moscow')selected @endif>Lokomotiv Moscow</option>
                <option value="RB Salzburg" @if(old('club') == 'RB Salzburg')selected @endif>RB Salzburg</option>                 
                <option value="Galatasaray" @if(old('club') == 'Galatasaray')selected @endif>Galatasaray</option>
                <option value="Juventus FC" @if(old('club') == 'Juventus FC')selected @endif>Juventus FC</option>
                <option value="FC Inter" @if(old('club') == 'FC Inter')selected @endif>FC Inter</option>
                <option value="Atalanta Bergame" @if(old('club') == 'Atalanta Bergame')selected @endif>Atalanta Bergame</option>               
                <option value="SSC Napoli" @if(old('club') == 'SSC Napoli')selected @endif>SSC Napoli</option>
                <option value="AS Roma" @if(old('club') == 'AS Roma')selected @endif>AS Roma</option>
                <option value="Liverpool FC" @if(old('club') == 'Liverpool FC')selected @endif>Liverpool FC</option>
                <option value="Chelsea FC" @if(old('club') == 'Chelsea FC')selected @endif>Chelsea FC</option>
                <option value="Manchester City" @if(old('club') == 'Manchester City')selected @endif>Manchester City</option>
                <option value="Manchester United" @if(old('club') == 'Manchester United')selected @endif>Manchester United</option>
                <option value="Tottenham Hotspur" @if(old('club') == 'Tottenham Hotspur')selected @endif>Tottenham Hotspur</option>
                <option value="Slavia Prague" @if(old('club') == 'Slavia Prague')selected @endif>Slavia Prague</option>                
                <option value="Olympique Lyonnais" @if(old('club') == 'Olympique Lyonnais')selected @endif>Olympique Lyonnais</option>
                <option value="Paris SG" @if(old('club') == 'Paris SG')selected @endif>Paris SG</option>
                <option value="LOSC Lille" @if(old('club') == 'LOSC Lille')selected @endif>LOSC Lille</option>
                <option value="AS Monaco" @if(old('club') == 'AS Monaco')selected @endif>AS Monaco</option>
                <option value="FC Porto" @if(old('club') == 'FC Porto')selected @endif>FC Porto</option>
                <option value="Benfica" @if(old('club') == 'Benfica')selected @endif>Benfica</option>
                <option value="PSV Eindhoven" @if(old('club') == 'PSV Eindhoven')selected @endif>PSV Eindhoven</option>
                <option value="Ajax Amsterdam" @if(old('club') == 'Ajax Amsterdam')selected @endif>Ajax Amsterdam</option>                
                <option value="Red Star Belgrade" @if(old('club') == 'Red Star Belgrade')selected @endif>Red Star Belgrade</option>
                <option value="Dinamo Zagreb" @if(old('club') == 'Dinamo Zagreb')selected @endif>Dinamo Zagreb</option> 
                <option value="Shakhtar Donetsk" @if(old('club') == 'Shakhtar Donetsk')selected @endif>Shakhtar Donetsk</option>
                <option value="Viktoria Plzeň" @if(old('club') == 'Viktoria Plzeň')selected @endif>Viktoria Plzeň</option>
                <option value="Brugge FC" @if(old('club') == 'Brugge FC')selected @endif>Brugge FC</option>
                <option value="Racing Genk" @if(old('club') == 'Racing Genk')selected @endif>Racing Genk</option>
                <option value="Olympiakos" @if(old('club') == 'Olympiakos')selected @endif>Olympiakos</option>
                <option value="Young Boys Berne" @if(old('club') == 'Young Boys Berne')selected @endif>Young Boys Berne</option>
                <option value="AEK Athen" @if(old('club') == 'AEK Athen')selected @endif>AEK Athen</option>  
              </select>

                @if ($errors->has('club'))
                    <span class="mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                        <strong>{{ $errors->first('club') }}</strong>
                    </span>
                @endif            
        </div>

        <div class="mb-4">
            <label for="password" class="block text-white text-base font-medium mb-2">
                {{ __('all.Password') }}
            </label>            
            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') bg-red-dark @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>

        <div class="mb-4">
            <label for="password-confirm" class="block text-white text-base font-medium mb-2">
                {{ __('all.Confirm Password') }}
            </label>
            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">            
        </div>

        <div class="mb-4">
            <div class="flex items-center justify-between">
                <button class="w-full bg-blue-600 hover:bg-blue-800 text-white font-medium py-2 px-4 border-2 border-white rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('all.Register') }}
                </button>
            </div>
        </div>
    </form>
    <p class="text-center text-gray-400 text-xs">
      &copy;2020 Charles Jeandey. {{__('all.All rights reserved.')}}.
    </p>
</div>
@endsection
