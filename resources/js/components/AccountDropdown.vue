<template>
  <div class="relative">
    <button @click="isOpen = !isOpen" class="relative z-10 block h-8 w-8 rounded-full overflow-hidden border-2 border-teal-400 focus:outline-none focus:border-julienred">
      <img class="h-full w-full object-cover bg-white" src="/img/cup.png" alt="cup">
        
    </button>

    <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-teal-200 opacity-50 cursor-default"></button><!-- -->

    <div v-if="isOpen" class="absolute z-20 right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl">

      <a :href="route('profile.show', user)" class="block px-4 py-2 text-juliengris hover:bg-francaverde hover:text-francagris transition duration-500 ease-in-out transform hover:-translate-y-1">{{ user.name }}</a>

      <a :href="route('admin.index')" v-if="isAdmin" class="block px-4 py-2 text-juliengris hover:bg-francaverde hover:text-francagris transition duration-500 ease-in-out transform hover:-translate-y-1">Admin</a>

      <a :href="route('contact.create')" class="block px-4 py-2 text-juliengris hover:bg-francaverde hover:text-francagris transition duration-500 ease-in-out transform hover:-translate-y-1">{{ __('nav.contact') }}</a>

      <a href="#" @click.prevent="logout" class="block px-4 py-2 text-juliengris hover:bg-francaverde hover:text-francagris transition duration-500 ease-in-out transform hover:-translate-y-1">{{ __('all.Logout') }}</a>
      
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
