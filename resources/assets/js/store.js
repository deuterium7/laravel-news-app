import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

/*
 * Imports all of the modules used in the application to build the data store.
 */
import { articles } from './modules/articles.js';

/*
 * Exports our data store.
 */
export default new Vuex.Store({
    modules: {
        articles,
    }
});