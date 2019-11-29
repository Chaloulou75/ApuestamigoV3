<header class="flex items-center justify-between flex-wrap bg-teal-300 border-solid border-b-2 border-gray-600 p-5">
    <div class="flex items-center flex-shrink-0 text-orange-600 hover:text-white mr-6 font-bolt text-2xl">
       <a href="{{ url('/') }}">
              {{ config('app.name', 'Apuestamigo') }}
       </a>
    </div>

    <label for="menu-toggle" class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-orange-600 border-orange-600 hover:text-orange-700 hover:border-orange-700" id="nav-toggle">
        <svg class="fill-current mb-2 font-medium leading-tight text-2xl w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </label>

    <div class="hidden w-full flex-grow lg:flex lg:items-center lg:w-auto" id="nav-content">

      <div class="text-sm lg:flex-grow">
        <a  href="{{ route('ligues.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-orange-600 hover:text-white mr-4 font-bolt">
            <i class="fas fa-award pr-1"></i> Mes Ligues
        </a>
        <a href="{{ route('ligues.create') }}" class="block mt-4 lg:inline-block lg:mt-0 text-orange-600 hover:text-white mr-4 font-bolt">
          <i class='far fa-hand-point-right pr-1'></i>Creer une ligue
        </a>
        <a href="{{ route('contact.create') }}" class="block mt-4 lg:inline-block lg:mt-0 text-orange-600 hover:text-white mr-4 font-bolt">
          <i class='far fa-envelope pr-1'></i>Contact
        </a>
      </div>

      <div >
        @if (Route::has('login'))             
            @auth  
            <div class="flex justify-between">       
              @if ( Auth::user()->admin == 1)  
                <button class="inline-block text-sm px-4 py-2 leading-none border rounded text-orange-600 border-orange-600 hover:border-transparent hover:text-orange-700 hover:bg-white mt-4 lg:mt-0 lg:mr-4 lg:mb-2">
                  <a href="{{ route('admin.index') }}"><i class='fas fa-graduation-cap'></i> Admin</a>
                </button>
              @endif
              <label for="logout-toggle" class="block">
                <button id="logout-toggle" class="inline-block text-sm px-4 py-2 leading-none border rounded text-orange-600 border-orange-600 hover:border-transparent hover:text-orange-700 hover:bg-white mt-4 lg:mt-0 lg:mb-2" >
                  <i class="fas fa-user-circle pr-1"></i>{{ Auth::user()->name }}
                </button>
              </label>  
            </div>   
            <div class="hidden" id="logout-content">
                <a href="{{ route('logout') }}" class="lg:float-right inline-block text-sm px-4 py-2 leading-none border rounded text-orange-600 border-orange-600 hover:border-transparent hover:text-orange-700 hover:bg-white mt-4 lg:mt-0"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-user-alt-slash pr-1"></i>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else
              <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-orange-600 border-orange-600 hover:border-transparent hover:text-orange-700 hover:bg-white mt-4 lg:mt-0 lg:mr-2">
                  <i class='fas fa-user pr-1'></i>Login
                </a>
                <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-orange-600 border-orange-600 hover:border-transparent hover:text-orange-700 hover:bg-white mt-4 lg:mt-0">
                  <i class="fas fa-user-circle pr-1"></i>Register
                </a>
              </div>             
            @endauth             
        @endif          
      </div>
    </div> 
</header>

