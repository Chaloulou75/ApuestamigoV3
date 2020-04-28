  
<template>
  <header class="bg-francagris text-white border-b-4 border-francaverde sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">

    <div class="flex items-center justify-between px-4 py-3 sm:p-0 sticky">

      <div class="flex items-center" >
        <!-- <img class="h-8" src="/img/logopoulpe.svg" alt="Poulpe"> -->
        <a 
          :href=" '/' " 
          class="animated fadeInLeftBig block px-2 py-1 text-2xl rounded font-medium hover:text-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            
            Apuestamigo 
       </a>
      </div>

      <div class="sm:hidden">
        <button @click="isOpen = !isOpen" type="button" class="block hover:text-julienred focus:text-julienred focus:outline-none">
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
            class="animated bounceInDown block px-2 py-1 text-sm rounded hover:text-francagris hover:bg-white transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
              <i class="fas fa-award pr-1"></i>
              {{ __('nav.ligues') }}
        </a>

        <a :href="route('ligues.create')" 
            class="animated bounceInDown mt-1 block px-2 py-1 text-sm rounded hover:text-francagris hover:bg-white sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
          <i class='far fa-hand-point-right pr-1'></i>
           {{ __('nav.creer') }}
        </a>

        <a :href="route('about')" 
            class="animated bounceInDown mt-1 block px-2 py-1 text-sm rounded hover:text-francagris hover:bg-white sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"> 
          <i class="fas fa-info-circle pr-1"></i> 
           {{ __('nav.about') }}
        </a>

        <a :href="route('langues')" 
            class="animated bounceInDown mt-1 block px-2 py-1 text-sm rounded hover:text-francagris hover:bg-white sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <!-- <i class="fas fa-globe "></i> -->
            <i class="fas fa-globe-americas pr-1"></i>
              {{ __('all.Translations') }}
        </a>
        
        <a :href="route('login')" 
            v-if="! isAuthenticated"
            class="animated bounceInDown mt-1 block px-4 py-2 text-sm leading-none border border-white hover:border-francaverde rounded hover:text-francagris hover:bg-white sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
            <i class='fas fa-user pr-1'></i>
            {{ __('all.Login') }}
        </a>
               
        <a :href="route('register')"
            v-if="! isAuthenticated" 
            class="animated bounceInDown mt-1 block px-4 py-2 text-sm leading-none border border-white hover:border-francaverde rounded hover:text-francagris hover:bg-white sm:mt-0 sm:ml-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
          <i class="fas fa-user-circle pr-1"></i>
          {{ __('all.Register') }}
        </a>

        
      
        <AccountDropdown v-if="isAuthenticated" :user="user" @logout="logout" class="animated bounceInDown hidden sm:block sm:ml-6"/>
      </div>

      <div class="px-2 py-1 sm:hidden" v-if="isAuthenticated">

        <div class="flex items-center animated bounceInDown mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francagris hover:bg-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
          <img class="h-8 w-8 border border-gray-900 rounded-full object-cover bg-white" src="/img/cup.png" alt="cup">
          <span class="ml-3"><a :href="route('profile.show', user)"> {{user.name}} </a></span>
        </div>

        <div class="mt-1">

          <a :href="route('admin.index')" 
              v-if="isAdmin"
              class="animated bounceInDown mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francagris hover:bg-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
              Admin
          </a>

          <a :href="route('contact.create')" 
              class="animated bounceInDown mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francagris hover:bg-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
              {{ __('nav.contact') }}
          </a>

          <a href="#" 
             @click.prevent="logout" 
             class="animated bounceInDown mt-1 block px-2 py-2 text-sm leading-none rounded hover:text-francagris hover:bg-francaverde transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
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
