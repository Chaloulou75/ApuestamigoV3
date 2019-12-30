/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import messages from './messages';
import Lang from 'lang.js';
import route from 'ziggy';
import { Ziggy } from './ziggy';

const lang = new Lang({

  messages: messages

});

window.Vue = require('vue');

Vue.mixin({

	methods: { 
      //methode traduction
		  __(...args){

        	return lang.get(...args);

      	},
      //methode de route (ziggy)
      route: (name, params, absolute) => route(name, params, absolute, Ziggy),
        
    }
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('carousel-component', require('./components/CarouselComponent.vue').default);
Vue.component('date-component', require('./components/DateComponent.vue').default);
Vue.component('cookie-banner-component', require('./components/CookieBannerConsentmentComponent.vue').default);
Vue.component('navbar-component', require('./components/Navbar.vue').default);
Vue.component('account-dropdown', require('./components/AccountDropdown.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

//Javascript to toggle the menu
// document.getElementById('nav-toggle').onclick = function(){
// document.getElementById("nav-content").classList.toggle("hidden");
// }
// //Javascript to toggle the logout button
// document.getElementById('logout-toggle').onclick = function(){
// document.getElementById("logout-content").classList.toggle("hidden");
// }


//copie du token
document.getElementById('copyToken').onclick = function copyTok() {
  var copyText = document.getElementById("copyToken");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copié: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copié le token";
}

