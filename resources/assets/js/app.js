
require('./bootstrap');

import Vue from 'vue';
import router from './routes.js'

Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
    router
}).$mount('#app');