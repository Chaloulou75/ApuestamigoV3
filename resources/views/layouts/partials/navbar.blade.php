<header
    class="bg-francagris text-white border-b-2 border-francaverde md:flex md:justify-between md:items-center md:px-4 sm:py-3"
    x-data="{ isOpen: false }" x-on:keydown.escape="isOpen = false">

    <div class="flex items-center justify-between px-4 py-3 md:p-0">

        <div class="flex items-center">
            <a href="{{ route('welcome') }}"
                class="block px-2 py-1 text-2xl rounded font-medium hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2" {{ Request::is('') ? 'active' : '' }}>

                Apuestamigo
            </a>
        </div>

        <div class="md:hidden">
            <button x-on:click="isOpen = !isOpen" type="button"
                class="block hover:text-francaverde focus:text-francaverde focus:outline-none">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                    <path x-show="isOpen" fill-rule="evenodd"
                        d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z" />
                    <path x-show="!isOpen" fill-rule="evenodd"
                        d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                </svg>
            </button>
        </div>

    </div>

    <nav class="md:block" x-bind:class="{ 'block': isOpen, 'hidden': !isOpen }" x-on:click.away="isOpen = false">

        <div class="px-2 pt-2 pb-1 md:flex md:p-0">

            <a href="{{ route('ligues.index') }}"
                class="block px-2 py-1 text-sm hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('*ligues') ? 'active' : '' }}">
                <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                {{ __('nav.ligues') }}
            </a>

            <a href="{{route('ligues.create')}}"
                class="mt-1 block px-2 py-1 text-sm hover:text-francaverde md:mt-0 md:ml-2 transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('*ligues/create') ? 'active' : '' }}">
                <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                    </path>
                </svg>
                {{ __('nav.creer') }}
            </a>

            <a href="{{route('about')}}"
                class="mt-1 block px-2 py-1 text-sm hover:text-francaverde md:mt-0 md:ml-2 transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('*about') ? 'active' : '' }}">
                <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                {{ __('nav.about') }}
            </a>

            <livewire:langues />

            @guest
            <a href="{{route('login')}}"
                class="mt-1 block px-2 py-1 text-sm hover:text-francaverde md:mt-0 md:ml-2 transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('*login') ? 'active' : '' }}">
                <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ __('all.Login') }}
            </a>
            @endguest

            {{-- dropdown --}}
            @auth
            <div x-data="{ open: false }" class="relative hidden md:block md:ml-6">
                <button x-on:click="open = true"
                    class="z-10 block h-8 w-8 rounded-full overflow-hidden border-2 border-francaverde focus:outline-none focus:border-francaverde">
                    <img class="h-full w-full object-contain bg-white overflow-hidden" src="/img/cup.png" loading="auto"
                        alt="cup">
                </button>

                <ul x-show="open" x-on:click.away="open = false"
                    x-transition:enter="transition duration-300 transform ease-out" x-transition:enter-start="scale-75"
                    x-transition:leave="transition duration-200 transform ease-in"
                    x-transition:leave-end="opacity-0 scale-90">
                    <div
                        class="absolute z-50 right-0 mt-2 py-2 w-48 bg-francagris border-2 border-francaverde rounded-lg text-sm shadow-xl">

                        <a href="{{ route('profile.show', auth()->user()->id) }}"
                            class="px-4 py-2 text-white hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 flex items-center {{ Request::is('*profile*') ? 'active' : '' }}">
                            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="truncate">{{ auth()->user()->name }}</p>
                        </a>

                        @admin
                        <a href="{{route('admin.index')}}"
                            class="block px-4 py-2 text-white hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('admin*') ? 'active' : '' }}">
                            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z">
                                </path>
                            </svg>
                            Admin
                        </a>
                        @endadmin

                        <a href="{{route('contact.create')}}"
                            class="block px-4 py-2 text-white hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('contact*') ? 'active' : '' }}">
                            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                            {{ __('nav.contact') }}
                        </a>

                        <livewire:logout />

                    </div>
                </ul>
            </div>
            @endauth
        </div>

        <div class="px-2 py-1 md:hidden">
            @auth
            <div
                class="flex items-center mt-1 px-2 py-2 text-sm leading-none rounded transition duration-500 ease-in-out transform hover:translate-x-2{{ Request::is('profile*') ? 'active' : '' }} ">
                <img class="h-8 w-8 border border-francaverde rounded-full object-contain overflow-hidden bg-white"
                    src="/img/cup.png" loading="auto" alt="cup">
                <span class="ml-3 hover:text-francaverde"><a href="{{route('profile.show', auth()->user()->id) }}">
                        {{  auth()->user()->name }}</a></span>
            </div>
            @endauth

            <div class="mt-1">
                @admin
                <a href="{{ route('admin.index') }}"
                    class="mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('admin*') ? 'active' : '' }}">
                    <svg class="h-5 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z">
                        </path>
                    </svg>
                    Admin
                </a>
                @endadmin

                @auth
                <a href="{{route('contact.create')}}"
                    class="mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francaverde transition duration-500 ease-in-out transform hover:translate-x-2 {{ Request::is('contact') ? 'active' : '' }}">
                    <svg class="h-5 w-5 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                        </path>
                    </svg>
                    {{ __('nav.contact') }}
                </a>

                <livewire:logout />

                @endauth
            </div>
        </div>
    </nav>

</header>
