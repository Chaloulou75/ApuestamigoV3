<template>
  <div class="relative">
    <button @click="isOpen = !isOpen" class="relative z-10 block h-8 w-8 rounded-full overflow-hidden border-2 border-francaverde focus:outline-none focus:border-francaverde">
      <img class="h-full w-full object-contain bg-white overflow-hidden" src="/img/cup.png" loading="auto" alt="cup">
    </button>

    <button v-show="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-gray-400 opacity-25 cursor-default"></button> <!-- le fond de l'ecran qd le dropdown est ouvert -->

    <transition name="slide-fade">     <!-- des supers transitions -->

      <div v-if="isOpen" class="absolute z-50 right-0 mt-2 py-2 w-48 bg-francagris border-2 border-francaverde rounded-lg shadow-xl"> <!--  -->

          <a :href="route('profile.show', user)" class="animate__animated animate__lightSpeedInLeft block px-4 py-2 text-white hover:text-francaverde"> 
            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ user.name }}
          </a>  <!-- transition duration-500 ease-in-out transform hover:-translate-y-1 -->

          <a :href="route('admin.index')" v-if="isAdmin" class="animate__animated animate__lightSpeedInLeft block px-4 py-2 text-white hover:text-francaverde">
            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
            Admin
          </a>

          <a :href="route('contact.create')" class="animate__animated animate__lightSpeedInLeft block px-4 py-2 text-white hover:text-francaverde">
            <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
            {{ __('nav.contact') }}
          </a>

          <a href="#" @click.prevent="logout" class="animate__animated animate__lightSpeedInLeft block px-4 py-2 text-white hover:text-francaverde">
                <svg class="h-6 w-6 inline-block pr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                {{ __('all.Logout') }} 
          </a>
          
      </div>
    </transition>
  </div>
</template>

<script>
export default {

  props: {
    user: {
        type: Object,
        default: () => ({}),
      },
  },

  data() {
    return {
      isOpen: false
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

  created() {
    const handleEscape = (e) => {
      if (e.key === 'Esc' || e.key === 'Escape') {
        this.isOpen = false
      }
    }
    document.addEventListener('keydown', handleEscape)
    this.$once('hook:beforeDestroy', () => {
      document.removeEventListener('keydown', handleEscape)
    })
  },

  computed: { 

    isAdmin(){

      return this.user.admin === 1;

    }
  }

}
</script>
