<template>
  <div class="relative">
    <button @click="isOpen = !isOpen" class="relative z-10 block h-8 w-8 rounded-full overflow-hidden border border-gray-900 focus:outline-none focus:border-white">
      <img class="h-full w-full object-cover bg-white" src="/img/cup.png" alt="cup">
        
    </button>

    <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-black opacity-50 cursor-default"></button>

    <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl">

      <a :href="route('admin.index')" v-if="isAdmin" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Admin</a>

      <a :href="route('contact.create')" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">{{ __('nav.contact') }}</a>

      <a href="#" @click.prevent="logout" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">{{ __('all.Logout') }}</a>
      
    </div>
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
