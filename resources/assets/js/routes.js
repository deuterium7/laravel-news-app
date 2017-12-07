/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

/*
 * Imports Vue and VueRouter to extend with the routes.
 */
import Vue from 'vue';
import VueRouter from 'vue-router';

/*
 * Extends Vue to use Vue Router
 */
Vue.use(VueRouter);

/*
 * Makes a new VueRouter that we will use to run all of the routes
 * for the app.
 */
export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'root',
            component: Vue.component('Root', require('./pages/Root.vue')),
            children: [
                {
                    path: 'articles',
                    name: 'articles',
                    component: Vue.component('Articles', require('./pages/Articles.vue'))
                },
                {
                    path: 'articles/:id',
                    name: 'article',
                    component: Vue.component('Article', require('./pages/Article.vue'))
                },
                {
                    path: 'categories',
                    name: 'categories',
                    component: Vue.component('Categories', require('./pages/Categories.vue'))
                },
                {
                    path: 'categories/:id',
                    name: 'category',
                    component: Vue.component('Category', require('./pages/Category.vue'))
                },
                {
                    path: 'users/:id',
                    name: 'user',
                    component: Vue.component('User', require('./pages/User.vue'))
                },
                {
                    path: 'contact',
                    name: 'contact',
                    component: Vue.component('Contact', require('./pages/Contact.vue'))
                },
                {
                    path: 'admin',
                    name: 'admin',
                    component: Vue.component('Admin', require('./pages/Admin.vue'))
                }
            ]
        },
    ]
});