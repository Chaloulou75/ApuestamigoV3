/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var Turbolinks = require("turbolinks");
Turbolinks.start();

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

import { turbolinksAdapterMixin } from 'vue-turbolinks';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('carousel-component', require('./components/CarouselComponent.vue').default);
//Vue.component('date-component', require('./components/DateComponent.vue').default);
//Vue.component('cookie-banner-component', require('./components/CookieBannerConsentmentComponent.vue').default);
Vue.component('navbar-component', require('./components/Navbar.vue').default);
Vue.component('account-dropdown', require('./components/AccountDropdown.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Pour faire marcher Turbolinks avec Vuejs

// document.addEventListener('turbolinks:load', () => {

//   let app = new Vue({
//       el: '#app',
//       mixins: [turbolinksAdapterMixin],
//   });
// });
 
 //Pour faire marcher Turbolinks avec Vuejs et Livewire 
 
function initiateVue() {
  const app = new Vue({
         el: '#app'
  });
}

document.addEventListener("turbolinks:load", function(event) {
    document.querySelectorAll('[wire\\:id]').forEach(function(el) {
        const component = el.__livewire;
        const dataObject = {
            data: component.data,
            events: component.events,
            children: component.children,
            checksum: component.checksum,
            name: component.name,
            errorBag: component.errorBag,
            redirectTo: component.redirectTo,
        };
        el.setAttribute('wire:initial-data', JSON.stringify(dataObject));
    });
    initiateVue();
    window.livewire.start();
});

