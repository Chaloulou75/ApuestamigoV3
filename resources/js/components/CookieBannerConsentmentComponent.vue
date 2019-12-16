<template>
  <div v-bind:class="shouldBeDisplayed ? 'block' : 'hidden'">
    <div class="container text-gray-500 text-center">
        <p>By continuing to browse this site, you consent to our use of cookies to immprove you online experience</p>
        <a href="#">Learn More</a>
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

        Cookies.set('user_has_agree_to_cookie_storage', 'true', { expires: 30 });

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
