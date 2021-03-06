<div
    class=" animate__animated animate__fadeIn animate__slower flex-grow w-full lg:w-1/3 my-4 md:m-4 focus:shadow-outline hover:bg-gray-900 transition transform hover:translate-x-2 duration-200">
    <div class="ligueCard border-2 border-francaverde rounded p-4 flex flex-col justify-between
	@if($ligue->finished == true) opacity-50 @endif">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <p class="text-sm flex items-center pb-4">
                    <svg class="text-gray-300 w-4 h-4" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </p>
                <p class="font-thin text-xs text-white">
                    @if($ligue->finished == true) {{ __('all.League finished')}}
                    @else {{ __('all.League in progress')}} @endif</p>
            </div>
            <div
                class="text-white hover:text-francaverde font-medium tracking-wide text-lg text-center truncate py-2 px-4">
                <a href="{{ route('ligues.show', $ligue) }}">
                    <p>{{ $ligue->name }}</p>
                    <p class="text-xs mt-1 text-francaverde">{{$ligue->championnat->name}}</p>
                </a>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <img class="w-10 h-10 mr-4" loading="lazy"
                src="{{ $ligue->championnat->logourl ? url($ligue->championnat->logourl) : URL::to('/img/' .$ligue->championnat->logo) }}"
                alt="championnat">
            <div class="text-xs tracking-wide">
                <p class="text-gray-300 truncate">{{ __('all.created by:') }}
                    <span class="font-medium text-francaverde">
                        @isset($ligue->creator)
                        {{ $ligue->creator->name }}
                        @endisset
                        @empty($ligue->creator)
                        John Doe
                        @endempty
                    </span>
                    @isset($ligue->creator)
                    <img class="inline w-10 h-8 mx-2" loading="lazy"
                        src="{{ $ligue->creator->equipe->logourl ? url($ligue->creator->equipe->logourl) : URL::to('/img/' .$ligue->creator->equipe->logo) }}"
                        alt="club">
                    @endisset
                    @empty($ligue->creator)
                    <img class="inline w-10 h-8 mx-2" loading="lazy" src="{{ URL::to('/img/cup.png') }}" alt="cup">
                    @endempty
                </p>
            </div>
        </div>
    </div>
</div>
