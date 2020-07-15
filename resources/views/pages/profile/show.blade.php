@extends('layouts.app', ['title' => __('all.Profil') ])

@section('content')

<div class="w-full md:w-1/2 mx-auto">
	<div class="border-t-4 border-double rounded border-francaverde bg-francagris">
		<h1 class="animate__animated animate__flipInX text-center text-white text-3xl tracking-wider font-semibold pt-4">{{ __('all.Profil') }}</h1>
	</div>

	<form class="animate__animated animate__fadeInUp bg-francagris px-6 py-6 mb-1" method="POST" action="{{ route('profile.update', $user) }}">
        @csrf
        @honeypot
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

			<label for="equipe_id" class="text-left text-white text-sm font-medium"> {{ __('all.Favorite Club') }} : </label>

			<select id="equipe_id" class="bg-teal-100 rounded text-left text-gray-900 text-sm font-medium px-2 py-2 {{ $errors->has('equipe_id') ? ' bg-red-dark' : '' }}" name="equipe_id" value=""> 

        @foreach($equipes as $equipe)

          <option value="{{ $equipe->id}}" @if($user->equipe_id == $equipe->id)selected @endif>{{ $equipe->name}}</option>
        @endforeach                               
      </select>

      @if ($errors->has('equipe_id'))
        <span class="mt-1 text-sm text-orange-500" role="relative px-3 py-3 mb-4 border rounded">
            <strong>{{ $errors->first('equipe_id') }}</strong>
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

  <div class="px-6 py-4 mb-4 mx-6 flex flex-col justify-between ">
    <div class="divide-y divide-francaverde">
      @foreach($user->ligues as $ligue)   
          @if($loop->first)
            <h3 class="text-left text-white text-base font-medium uppercase py-2 px-4">{{$loop->count}} {{ __('all.leagues') }}:</h3>
          @endif
            <div class="text-white hover:text-francaverde font-medium tracking-wide text-sm truncate py-2 transition duration-500 ease-in-out transform hover:translate-x-1 px-4">
                <a href="{{ route('ligues.show', $ligue) }}">
                  {{ $ligue->name }} <span class="text-xs font-thin italic text-gray-300">({{ $ligue->championnat->name}})</span>
                  @if($ligue->finished == true)
                    <span class="text-xs font-thin uppercase px-4">{{ __('all.League finished')}}</span>
                  @endif
                </a>
            </div>
      @endforeach
    </div>               
  </div>

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

