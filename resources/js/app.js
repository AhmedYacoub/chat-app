
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import toastr from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

require('./bootstrap');

window.Vue = require('vue');
window.toastr = require('toastr');
Vue.use(toastr);

// Don't forget .default again -__-
Vue.component('chat-app', require('./components/ChatApp.vue').default);

const app = new Vue({
    el: '#app'
});
