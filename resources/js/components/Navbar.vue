  
<template>
  <header class="bg-transparent sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">

    <div class="flex items-center justify-between px-4 py-3 sm:p-0">

      <div>
        <!-- <img class="h-8" src="/img/logo-inverted.svg" alt="Workcation"> -->
        <a 
          :href=" '/' " 
          class="block px-2 py-1 text-white text-2xl rounded font-medium hover:bg-gray-900">
              Apuestamigo
       </a>
      </div>

      <div class="sm:hidden">
        <button @click="isOpen = !isOpen" type="button" class="block text-gray-500 hover:text-white focus:text-white focus:outline-none">
          <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
          </svg>
        </button>
      </div>

    </div>

    <nav :class="isOpen ? 'block' : 'hidden'" class="sm:block">

      <div class="px-2 pt-2 pb-4 sm:flex sm:p-0">
        
        <a :href="route('ligues.index')" 
            class="block px-2 py-1 text-white text-sm rounded hover:bg-gray-900 "> 
              <i class="fas fa-award pr-1"></i>
              {{ __('nav.ligues') }}
        </a>

        <a :href="route('ligues.create')" 
            class="mt-1 block px-2 py-1 text-white text-sm rounded hover:bg-gray-900 sm:mt-0 sm:ml-2"> 
          <i class='far fa-hand-point-right pr-1'></i>
           {{ __('nav.creer') }}
        </a>

        <a :href="route('about')" 
            class="mt-1 block px-2 py-1 text-white text-sm rounded hover:bg-gray-900 sm:mt-0 sm:ml-2"> 
          <i class="fas fa-info-circle pr-1"></i> 
           {{ __('nav.about') }}
        </a>

        <a :href="route('langues')" 
            class="mt-1 block px-2 py-1 text-white text-sm rounded hover:bg-gray-900 sm:mt-0 sm:ml-2">
            <!-- <i class="fas fa-globe "></i> -->
            <i class="fas fa-globe-americas pr-1"></i>
              {{ __('all.Translations') }}
        </a>
        
        <a :href="route('login')" 
            v-if="! isAuthenticated"
            class="mt-1 block px-4 py-2 text-sm leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white sm:mt-0 sm:ml-2 " >
            <i class='fas fa-user pr-1'></i>
            {{ __('all.Login') }}
        </a>
               
        <a :href="route('register')"
            v-if="! isAuthenticated" 
            class="mt-1 block px-4 py-2 text-sm leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white sm:mt-0 sm:ml-2">
          <i class="fas fa-user-circle pr-1"></i>
          {{ __('all.Register') }}
        </a>

        
      
        <AccountDropdown v-if="isAuthenticated" :user="user" @logout="logout" class="hidden sm:block sm:ml-6"/>
      </div>

      <div class="px-4 py-5 border-t border-gray-800 sm:hidden" v-if="isAuthenticated">

        <div class="flex items-center">
          <img class="h-8 w-8 border border-gray-900 rounded-full object-cover bg-white" src="/img/cup.png" alt="cup">
          <span class="ml-3 text-white"><a :href="route('profile.show', user)"> {{user.name}} </a></span>
        </div>

        <div class="mt-4">

          <a :href="route('admin.index')" 
              v-if="isAdmin"
              class="block text-gray-400 hover:text-white">
              Admin
          </a>

          <a :href="route('contact.create')" 
              class="mt-2 block text-gray-400 hover:text-white">
              {{ __('nav.contact') }}
          </a>

          <a href="#" 
             @click.prevent="logout" 
             class="mt-2 block text-gray-400 hover:text-white">
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
