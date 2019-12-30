<header class="bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">

    <div class="flex items-center justify-between px-4 py-3 sm:p-0">

      <div>
        
        <a href="{{ url('/') }}" class="block px-2 py-1 text-white text-2xl rounded font-medium hover:bg-gray-800">
              {{ config('app.name', 'Apuestamigo') }}
       </a>
      </div>

      <div class="sm:hidden">
        <button {{-- @click="isOpen = !isOpen" --}} type="button" class="block text-gray-500 hover:text-white focus:text-white focus:outline-none">
          <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
          </svg>
        </button>
      </div>


    </div>

    @if (Route::has('login')) 

      @auth

      {{-- on fait un nav pour les utilisateurs connectés  --}}
      <div class="px-2 pt-2 pb-4 sm:flex sm:p-0">
        
        <a href="{{ route('ligues.index') }}" class="block px-2 py-1 text-white font-medium  rounded hover:bg-gray-800 "> 
              <i class="fas fa-award pr-1"></i> {{ __('nav.ligues') }}
        </a>

        <a href="{{ route('ligues.create') }}" class="mt-1 block px-2 py-1 text-white font-medium rounded hover:bg-gray-800 sm:mt-0 sm:ml-2"> 
          <i class='far fa-hand-point-right pr-1'></i> {{ __('nav.creer') }}
        </a>

        <a class="mt-1 block px-4 py-2 text-sm leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white sm:mt-0 sm:ml-2">
          <i class="fas fa-user-circle pr-1"></i>{{ Auth::user()->name }}
        </a>
        

        

        <AccountDropdown class="hidden sm:block sm:ml-6"/>

      </div>

      <div class="px-4 py-5 border-t border-gray-800 sm:hidden">

        <div class="flex items-center">
          
          <img class="h-8 w-8 border-2 border-gray-600 rounded-full object-cover" src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&q=80" alt="Your avatar">
          <span class="ml-3 text-white">{{ Auth::user()->name }} </span>

        </div>

        <div class="mt-4">

          @if ( Auth::user()->admin == 1) 

          <a href="{{ route('admin.index') }}" class="block text-gray-400 hover:text-white">Admin</a>

          @endif
          
          <a href="{{ route('contact.create') }}" class="mt-2 block text-gray-400 hover:text-white">{{ __('nav.contact') }}</a>


          <div class="hidden" id="logout-content">
            <a href="{{ route('logout') }}" class="mt-2 block text-gray-400 hover:text-white" 
               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
              {{-- <i class="fas fa-user-alt-slash pr-1"></i> --}}
              Sign out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
          
        </div>

      </div>

    @else 
    {{-- le user n'est pas connecté --}}

      <div class="px-2 pt-2 pb-4 sm:flex sm:p-0">
        
        <a href="{{ route('ligues.index') }}" class="block px-2 py-1 text-white font-medium rounded hover:bg-gray-800 "> 
              <i class="fas fa-award pr-1"></i> {{ __('nav.ligues') }}
        </a>

        <a href="{{ route('ligues.create') }}" class="mt-1 block px-2 py-1 text-white font-medium rounded hover:bg-gray-800 sm:mt-0 sm:ml-2"> 
          <i class='far fa-hand-point-right pr-1'></i> {{ __('nav.creer') }}
        </a>
        
        <a href="{{ route('login') }}" class="mt-1 block px-4 py-2 text-sm leading-none border  rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white sm:mt-0 sm:ml-2 " >
            <i class='fas fa-user pr-1'></i>{{ __('all.Login') }}
        </a>
               
        <a href="{{ route('register') }}" class="mt-1 block px-4 py-2 text-sm leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white sm:mt-0 sm:ml-2">
          <i class="fas fa-user-circle pr-1"></i>{{ __('all.Register') }}
        </a>
      
        <AccountDropdown class="hidden sm:block sm:ml-6"/>
      </div>
    

     @endauth  

    @endif
</header> 
