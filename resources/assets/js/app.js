
require('./bootstrap');

import Vue from 'vue';
import router from './routes.js'
import store from './store.js'

new Vue({
    router,
    store
}).$mount('#app');