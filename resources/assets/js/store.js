import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

/*
 * Imports all of the modules used in the application to build the data store.
 */
import { categories } from './modules/categories.js';
import { articles } from './modules/articles.js';
import { comments } from './modules/comments.js';
import { users } from './modules/users.js';

/*
 * Exports our data store.
 */
export default new Vuex.Store({
    modules: {
        categories,
        articles,
        comments,
        users,
    }
});