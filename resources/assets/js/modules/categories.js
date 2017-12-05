/*
|-------------------------------------------------------------------------------
| VUEX modules/categories.js
|-------------------------------------------------------------------------------
| The Vuex data store for the categories
*/

import categoryAPI from '../api/category.js';

export const categories = {
    state: {
        categories: {},
        categoriesLoadStatus: 0,

        category: [],
        categoryLoadStatus: 0
    },

    actions: {
        loadCategories({ commit }) {
            commit('setCategoriesLoadStatus', 1);

            categoryAPI.index()
                .then(function(response) {
                    commit('setCategories', response.data);
                    commit('setCategoriesLoadStatus', 2);
                })
                .catch(function() {
                    commit('setCategories', {});
                    commit('setCategoriesLoadStatus', 3);
                });
        },

        loadCategory({ commit }, data) {
            commit('setCategoryLoadStatus', 1);

            categoryAPI.show(data.id)
                .then(function(response) {
                    commit('setCategory', response.data);
                    commit('setCategoryLoadStatus', 2);
                })
                .catch(function() {
                    commit('setCategory', []);
                    commit('setCategoryLoadStatus', 3);
                });
        }
    },

    mutations: {
        setCategoriesLoadStatus(state, status) {
            state.categoriesLoadStatus = status;
        },

        setCategories(state, categories) {
            state.categories = categories;
        },

        setCategoryLoadStatus(state, status) {
            state.categoryLoadStatus = status;
        },

        setCategory(state, category) {
            state.category = category;
        }
    },

    getters: {
        getCategoriesLoadStatus(state) {
            return state.categoriesLoadStatus;
        },

        getCategories(state) {
            return state.categories;
        },

        getCategoryLoadStatus(state) {
            return state.categoryLoadStatus;
        },

        getCategory(state) {
            return state.category;
        }
    }
}