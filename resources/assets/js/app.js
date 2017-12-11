
require('./bootstrap');

import Vue from 'vue';
import router from './routes.js'

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(require('vue-moment'));

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

new Vue({
    router
}).$mount('#app');