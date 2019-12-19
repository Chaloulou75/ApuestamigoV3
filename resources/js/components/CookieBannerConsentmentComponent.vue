<template>
  <div v-bind:class="shouldBeDisplayed ? 'block' : 'hidden'">
    <div class="container text-gray-500 text-center test-sm">
        <p>{{ __('all.cookie_consentment') }}</p>
        <a href="#"> {{ __('all.Learn_More') }}</a>
        <button type="button" @click="handleCookieStorageApproval" class="bg-gray-900 border border-solid rounded-full py-2 px-2">OK</button>
    </div>
  </div>
</template>


<script>


import Cookies from 'js-cookie';



export default {

    data() {

      return {

        shouldBeDisplayed: false

      }
    },
   
    methods: {

      handleCookieStorageApproval(){

        Cookies.set('user_has_agree_to_cookie_storage', 'true', { expires: 0.5 });

        this.shouldBeDisplayed = false;
      }

      
    },

    mounted() {

      if( Cookies.set('user_has_agree_to_cookie_storage') === undefined)
      {
        this.shouldBeDisplayed = true;
      }
    }
}
</script>
