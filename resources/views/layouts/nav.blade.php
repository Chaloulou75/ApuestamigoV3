<header class="bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
    <div class="flex items-center justify-between px-4 py-3 sm:p-0">
       <a href="{{ url('/') }}" class="block px-2 py-1 text-white text-2xl rounded hover:bg-gray-800">
              {{ config('app.name', 'Apuestamigo') }}
       </a>
    </div>


    <label for="menu-toggle" class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-white border-white hover:text-gray-700 hover:border-gray-700" id="nav-toggle">
        <svg class="fill-current mb-2 font-medium leading-tight text-2xl w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </label>

    <nav class="hidden w-full flex-grow {{-- sm:block --}} lg:flex lg:items-center lg:w-auto" id="nav-content">

      <div class="px-2 pt-2 pb-4 sm:flex sm:p-0">
        <a href="{{ route('ligues.index') }}" class="block px-2 py-1 text-white font-semibold rounded hover:bg-gray-800">
            <i class="fas fa-award pr-1"></i> {{ __('nav.ligues') }}
        </a>
        <a href="{{ route('ligues.create') }}" class="block px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0 sm:ml-2">
          <i class='far fa-hand-point-right pr-1'></i> {{ __('nav.creer') }}
        </a>
        <a href="{{ route('contact.create') }}" class="block px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0 sm:ml-2">
          <i class='far fa-envelope pr-1'></i> {{ __('nav.contact') }}
        </a>
        <ul>
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li>
                  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="block px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0 sm:ml-2">
                      {{ $properties['native'] }}
                  </a>
              </li>
          @endforeach
      </ul>
        
      </div>

      <div >

        @if (Route::has('login'))             
            @auth  
            <div class="flex justify-between"> 
                      
              @if ( Auth::user()->admin == 1)  
                <button class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 lg:mt-0 lg:mr-4 lg:mb-2">
                  <a href="{{ route('admin.index') }}"><i class='fas fa-graduation-cap'></i> Admin</a>
                </button>
              @endif
              <label for="logout-toggle" class="block">
                <button id="logout-toggle" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 lg:mt-0 lg:mb-2" >
                  <i class="fas fa-user-circle pr-1"></i>{{ Auth::user()->name }}
                </button>
              </label>  
            </div>   
            <div class="hidden" id="logout-content">
                <a href="{{ route('logout') }}" class="lg:float-right inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 lg:mt-0"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-user-alt-slash pr-1"></i>{{ __('all.Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
            @else
            <div class="flex items-center justify-between">
              <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 lg:mt-0 lg:mr-2">
                <i class='fas fa-user pr-1'></i>{{ __('all.Login') }}
              </a>
              <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 lg:mt-0">
                <i class="fas fa-user-circle pr-1"></i>{{ __('all.Register') }}
              </a>

            </div>             
            @endauth             
        @endif

      </div>
    </nav> 
</header>

