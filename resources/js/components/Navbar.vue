<template>
  <header class="bg-francagris text-white border-b-4 border-francaverde sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">

    <div class="flex items-center justify-between px-4 py-3 sm:p-0">

      <div class="flex items-center">
        <!-- <img class="h-8" src="/img/logopoulpe.svg" alt="Poulpe"> -->
        <a 
          :href=" '/' " 
          class="animate__animated animate__flipInY block px-2 py-1 text-2xl rounded font-medium hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            
          Apuestamigo
       </a>
      </div>

      <div class="sm:hidden">
        <button @click="isOpen = !isOpen" type="button" class="block hover:text-francaverde focus:text-francaverde focus:outline-none">
          <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
          </svg>
        </button>
      </div>

    </div>

    <nav :class="isOpen ? 'block' : 'hidden'" class="sm:block">

      <div class="px-2 pt-2 pb-1 sm:flex sm:p-0">
        
        <a :href="route('ligues.index')" 
            class="animate__animated animate__lightSpeedInLeft block px-2 py-1 text-sm hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
              <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
              {{ __('nav.ligues') }}
        </a>

        <a :href="route('ligues.create')" 
            class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-1 text-sm hover:text-francaverde sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
          <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
           {{ __('nav.creer') }}
        </a>

        <a :href="route('about')" 
            class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-1 text-sm hover:text-francaverde sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
          <!-- <i class="fas fa-info-circle pr-1"></i> -->
          <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
           {{ __('nav.about') }}
        </a>

        <a :href="route('langues')" 
            class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-1 text-sm hover:text-francaverde sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
              {{ __('all.Translations') }}
        </a>
        
        <a :href="route('login')" 
            v-if="! isAuthenticated"
            class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-1 text-sm hover:text-francaverde sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <svg class="inline-block h-4 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('all.Login') }}
        </a>
               
        <!-- <a :href="route('register')"
            v-if="! isAuthenticated" 
            class="mt-1 block px-2 py-1 text-sm hover:text-francaverde sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
          <i class="fas fa-user-circle pr-1"></i>
          {{ __('all.Register') }}
        </a> -->

        
      
        <AccountDropdown v-if="isAuthenticated" :user="user" @logout="logout" class="hidden sm:block sm:ml-6"/>
      </div>

      <div class="px-2 py-1 sm:hidden" v-if="isAuthenticated">

        <div class="animate__animated animate__lightSpeedInLeft flex items-center mt-1 block px-2 py-2 text-sm leading-none rounded transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
          <img class="h-8 w-8 border border-francaverde rounded-full object-contain overflow-hidden bg-white" src="/img/cup.png" loading="auto" alt="cup">
          <span class="ml-3 hover:text-francaverde"><a :href="route('profile.show', user)"> {{user.name}} </a></span>
        </div>

        <div class="mt-1">

          <a :href="route('admin.index')" 
              v-if="isAdmin"
              class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
              <svg class="h-5 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
              Admin
          </a>

          <a :href="route('contact.create')" 
              class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
              <svg class="h-5 w-5 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
              {{ __('nav.contact') }}
          </a>

          <a href="#" 
             @click.prevent="logout" 
             class="animate__animated animate__lightSpeedInLeft mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
             <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            {{ __('all.Logout') }}
          </a>
          
        </div>

      </div>

    </nav>
  </header>
</template>

<script>

import AccountDropdown from './AccountDropdown'

export default {

  props: {
    user: {
        type: Object,
        default: () => ({}),
      },
  },

  components: {

    AccountDropdown,

  },

  data() {

    return {

      isOpen: false,

    }
    
  },

  methods: {

    logout() {
      axios.post('/logout')
          .catch(error => {
             window.location.href = '/';
          });
    }
  },

  computed: { 

    isAuthenticated(){

      return this.user != null;

    },

    isAdmin(){

      return this.user.admin === 1;

    }
  }

}
</script>
