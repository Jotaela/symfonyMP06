import Vuex from 'vuex'
import VueRouter from 'vue-router'
import './bootstrap'
import Vue from 'vue'
import App from './layouts/App'
import store from './store'
import vuetify from './plugins/vuetify'
import eventBusCli from './plugins/eventBus.client'
import confirm from './plugins/confirm'

window.Vue = Vue
window.Vue.use(Vuex)
window.Vue.use(confirm, { vuetify })
window.Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.Vue.component('page', () => import('./components/Page' /* webpackChunkName: "channels" */))
window.Vue.component('landing-page', () => import('./pages/LandingPage' /* webpackChunkName: "landing-page" */))
window.Vue.component('animals', () => import('./pages/Animals' /* webpackChunkName: "animals" */))
window.Vue.component('habitats', () => import('./pages/Habitats' /* webpackChunkName: "habitats" */))
window.Vue.component('App', () => import('./layouts/App' /* webpackChunkName: "App" */))
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// eslint-disable-next-line no-unused-vars
const app = new Vue({
    el: '#app',
    store,
    vuetify,
    eventBusCli
})
