<div x-data="{ open: false }" class="relative">
    <button x-on:click="open = true"
        class="mt-1 block px-2 py-1 text-sm focus:outline-none hover:text-francaverde md:mt-0 md:ml-2 transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('langues') ? 'active' : '' }}">
        <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            viewBox="0 0 24 24" stroke="currentColor">
            <path
                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129">
            </path>
        </svg>
        {{ __('all.Translations') }}
    </button>

    <ul x-show="open" x-on:click.away="open = false" x-transition:enter="transition duration-200 transform ease-out"
        x-transition:enter-start="scale-75" x-transition:leave="transition duration-200 transform ease-in"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="absolute z-50 mt-2 p-2 w-40 bg-francagris border-2 border-francaverde rounded-lg text-sm shadow-xl">

            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="flex items-center px-4 py-2 text-white hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 overflow-hidden focus:outline-none my-1"
                rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                <img class="inline-block h-5 w-5 border border-francaverde focus:outline-none focus:border-white rounded-full object-cover"
                    loading="lazy" alt="{{ $properties['native'] }}"
                    src="{!! asset('img/flags/' . $localeCode. '.png') !!}" />
                <div class="text-white hover:text-francaverde ml-2">
                    {{ $properties['native'] }}
                </div>
            </a>
            @endforeach

        </div>
    </ul>
</div>
