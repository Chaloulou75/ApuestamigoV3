/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('cookie-banner-component', require('./components/CookieBannerConsentmentComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

//Javascript to toggle the menu
document.getElementById('nav-toggle').onclick = function(){
document.getElementById("nav-content").classList.toggle("hidden");
}
//Javascript to toggle the logout button
document.getElementById('logout-toggle').onclick = function(){
document.getElementById("logout-content").classList.toggle("hidden");
}

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

