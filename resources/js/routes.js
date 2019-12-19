import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


export default {

	mode: 'history',

	linkActiveClass : 'font-bold',

	routes: [

		{
			path : '*',

			component: NotFound
		},

		{
			path : '/',

			component: Logo
		},
		
	]
};

