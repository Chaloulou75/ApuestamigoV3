@extends('layouts.app')

@section('content')

<div class="w-full md:w-1/2 mx-auto">
	<div class="border-t-4 border-double rounded border-francaverde bg-francagris">
		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-semibold pt-4">{{ __('all.Profil') }}</h1>
	</div>

	<form class="animate__animated animate__fadeInUp bg-francagris px-6 py-6 mb-1" method="POST" action="{{ route('profile.update', $user) }}">
        @csrf
        @method('PATCH')

		<div class="border-t-4 border-francaverde rounded bg-francagris py-4 mb-4 flex flex-col justify-between">

			<label for="name" class="text-left text-white text-sm font-medium"> {{ __('all.Name')}} : </label>

			<input id="name" name="name" type="text" class="bg-teal-100 rounded text-left text-gray-900 text-sm font-medium px-2 py-2 @error('name') bg-red-dark @enderror" value="{{ $user->name }}" placeholder="{{ $user->name }}">
		
			@error('name')
	            <span class=" mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror	
		</div>
		
		<div class="border-t-4 border-francaverde rounded bg-francagris py-4 mb-4 flex flex-col justify-between">

			<label for="email" class="text-left text-white text-sm font-medium"> Email : </label>

			<input id="email" name="email" type="email" class="bg-teal-100 rounded text-left text-gray-900 text-sm font-medium px-2 py-2" value="{{ $user->email }}" placeholder="{{ $user->email }}">
			@error('email')
                <span class=" mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
		</div>	

		<div class="border-t-4 border-francaverde rounded bg-francagris py-4 mb-4 flex flex-col justify-between">

			<label for="club" class="text-left text-white text-sm font-medium"> {{ __('all.Favorite Club') }} : </label>

			<select id="club" class="bg-teal-100 rounded text-left text-gray-900 text-sm font-medium px-2 py-2 {{ $errors->has('club') ? ' bg-red-dark' : '' }}" name="club" value="">              
                <option value="Borussia Dortmund"  @if($user->club == 'Borussia Dortmund')selected @endif>Borussia Dortmund</option>
                <option value="Bayer Leverkusen" @if( $user->club == 'Bayer Leverkusen')selected @endif>Bayer Leverkusen</option>
                <option value="FC Bayern" @if($user->club == 'FC Bayern')selected @endif>FC Bayern</option>
                <option value="FC Schalke" @if($user->club == 'FC Schalke')selected @endif>FC Schalke</option>
                <option value="RB Leipzig" @if($user->club == 'RB Leipzig')selected @endif>RB Leipzig</option>                
                <option value="TSG Hoffenheim" @if($user->club == 'TSG Hoffenheim')selected @endif>TSG Hoffenheim</option>
                <option value="Atletico Madrid" @if($user->club == 'Atletico Madrid')selected @endif>Atletico Madrid</option>
                <option value="FC Barcelona" @if($user->club == 'FC Barcelona')selected @endif>FC Barcelona</option>
                <option value="Real Madrid" @if(old('club') == 'Real Madrid')selected @endif>Real Madrid</option>
                <option value="Valence CF" @if($user->club == 'Valence CF')selected @endif>Valence CF</option>                
                <option value="CSKA Moscow" @if($user->club == 'CSKA Moscow')selected @endif>CSKA Moscow</option>
                <option value="Zénith Saint-Petersbourg" @if($user->club == 'Zénith Saint-Petersbourg')selected @endif>Zénith Saint-Pétersbourg</option>                
                <option value="Lokomotiv Moscow" @if($user->club == 'Lokomotiv Moscow')selected @endif>Lokomotiv Moscow</option>
                <option value="RB Salzburg" @if($user->club == 'RB Salzburg')selected @endif>RB Salzburg</option>                 
                <option value="Galatasaray" @if($user->club == 'Galatasaray')selected @endif>Galatasaray</option>
                <option value="Juventus FC" @if($user->club == 'Juventus FC')selected @endif>Juventus FC</option>
                <option value="FC Inter" @if($user->club == 'FC Inter')selected @endif>FC Inter</option>
                <option value="Atalanta Bergame" @if($user->club == 'Atalanta Bergame')selected @endif>Atalanta Bergame</option>               
                <option value="SSC Napoli" @if($user->club == 'SSC Napoli')selected @endif>SSC Napoli</option>
                <option value="AS Roma" @if($user->club == 'AS Roma')selected @endif>AS Roma</option>
                <option value="Liverpool FC" @if($user->club == 'Liverpool FC')selected @endif>Liverpool FC</option>
                <option value="Chelsea FC" @if($user->club == 'Chelsea FC')selected @endif>Chelsea FC</option>
                <option value="Manchester City" @if($user->club == 'Manchester City')selected @endif>Manchester City</option>
                <option value="Manchester United" @if($user->club == 'Manchester United')selected @endif>Manchester United</option>
                <option value="Tottenham Hotspur" @if($user->club == 'Tottenham Hotspur')selected @endif>Tottenham Hotspur</option>
                <option value="Slavia Prague" @if($user->club == 'Slavia Prague')selected @endif>Slavia Prague</option>                
                <option value="Olympique Lyonnais" @if($user->club == 'Olympique Lyonnais')selected @endif>Olympique Lyonnais</option>
                <option value="Paris SG" @if($user->club == 'Paris SG')selected @endif>Paris SG</option>
                <option value="LOSC Lille" @if($user->club == 'LOSC Lille')selected @endif>LOSC Lille</option>
                <option value="AS Monaco" @if($user->club == 'AS Monaco')selected @endif>AS Monaco</option>
                <option value="FC Porto" @if($user->club == 'FC Porto')selected @endif>FC Porto</option>
                <option value="Benfica" @if($user->club == 'Benfica')selected @endif>Benfica</option>
                <option value="PSV Eindhoven" @if($user->club == 'PSV Eindhoven')selected @endif>PSV Eindhoven</option>
                <option value="Ajax Amsterdam" @if($user->club == 'Ajax Amsterdam')selected @endif>Ajax Amsterdam</option>                
                <option value="Red Star Belgrade" @if($user->club == 'Red Star Belgrade')selected @endif>Red Star Belgrade</option>
                <option value="Dinamo Zagreb" @if($user->club == 'Dinamo Zagreb')selected @endif>Dinamo Zagreb</option> 
                <option value="Shakhtar Donetsk" @if($user->club == 'Shakhtar Donetsk')selected @endif>Shakhtar Donetsk</option>
                <option value="Viktoria Plzeň" @if($user->club == 'Viktoria Plzeň')selected @endif>Viktoria Plzeň</option>
                <option value="Brugge FC" @if($user->club == 'Brugge FC')selected @endif>Brugge FC</option>
                <option value="Racing Genk" @if($user->club == 'Racing Genk')selected @endif>Racing Genk</option>
                <option value="Olympiakos" @if($user->club == 'Olympiakos')selected @endif>Olympiakos</option>
                <option value="Young Boys Berne" @if($user->club == 'Young Boys Berne')selected @endif>Young Boys Berne</option>
                <option value="AEK Athen" @if($user->club == 'AEK Athen')selected @endif>AEK Athen</option>  
              </select>

              @if ($errors->has('club'))
                <span class="mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
                    <strong>{{ $errors->first('club') }}</strong>
                </span>
               @endif
		</div>

		<div class="mb-4">
            <div class="flex items-center justify-between">
                <button class="w-full bg-francagris text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
                    <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    {{ __('all.Edit') }}
                </button>
            </div>
        </div>
	</form>

	<form class="bg-francagris px-6 py-4 mb-4" method="POST" action="{{ route('profile.destroy', $user) }}">
        @csrf
        @method('DELETE')
		<div class="border-2 border-francaverde rounded bg-francagris p-4 flex flex-col justify-between">
          <p class="block text-white text-sm font-medium mb-2">{{ __('all.Please note, this action is irreversible.') }} </p>
          <button class="w-full bg-julienred text-white hover:text-francaverde font-medium py-2 px-4 border-2 border-francaverde rounded focus:outline-none focus:shadow-outline" type="submit">
                <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                {{ __('all.Delete my account') }}
           </button>
      	</div>
	</form>
</div>

@endsection

