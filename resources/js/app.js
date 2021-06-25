require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import router from './router';

Vue.use(Vuetify)
Vue.use(VueRouter)

/* Components */
Vue.component('main-component',require('./components/MainComponent.vue').default)

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
  })

