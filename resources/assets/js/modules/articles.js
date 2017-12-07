/*
|-------------------------------------------------------------------------------
| VUEX modules/articles.js
|-------------------------------------------------------------------------------
| The Vuex data store for the articles
*/

import ArticleAPI from '../api/article.js';

export const articles = {
    state: {
        articlesAdmin: [],
        articlesAdminLoadStatus: 0,

        articlesClient: [],
        articlesClientLoadStatus: 0,

        article: {},
        articleLoadStatus: 0
    },

    actions: {
        loadArticlesClient({ commit }) {
            commit('setArticlesClientLoadStatus', 1);

            ArticleAPI.index()
                .then(function(response) {
                    commit('setArticlesClient', response.data);
                    commit('setArticlesClientLoadStatus', 2);
                })
                .catch(function() {
                    commit('setArticlesClient', []);
                    commit('setArticlesClientLoadStatus', 3);
                });
        },

        loadArticlesAdmin({ commit }) {
            commit('setArticlesAdminLoadStatus', 1);

            ArticleAPI.articlesAdmin()
                .then(function(response) {
                    commit('setArticlesAdmin', response.data);
                    commit('setArticlesAdminLoadStatus', 2);
                })
                .catch(function() {
                    commit('setArticlesAdmin', []);
                    commit('setArticlesAdminLoadStatus', 3);
                });
        },

        loadArticle({ commit }, data) {
            commit('setArticleLoadStatus', 1);

            ArticleAPI.show(data.id)
                .then(function(response) {
                    commit('setArticle', response.data);
                    commit('setArticleLoadStatus', 2);
                })
                .catch(function() {
                    commit('setArticle', {});
                    commit('setArticleLoadStatus', 3);
                });
        }
    },

    mutations: {
        setArticlesClientLoadStatus(state, status) {
            state.articlesClientLoadStatus = status;
        },

        setArticlesClient(state, articlesClient) {
            state.articlesClient = articlesClient;
        },

        setArticlesAdminLoadStatus(state, status) {
            state.articlesAdminLoadStatus = status;
        },

        setArticlesAdmin(state, articlesAdmin) {
            state.articlesAdmin = articlesAdmin;
        },

        setArticleLoadStatus(state, status) {
            state.articleLoadStatus = status;
        },

        setArticle(state, article) {
            state.article = article;
        }
    },

    getters: {
        getArticlesClientLoadStatus(state) {
            return state.articlesClientLoadStatus;
        },

        getArticlesClient(state) {
            return state.articlesClient;
        },

        getArticlesAdminLoadStatus(state) {
            return state.articlesAdminLoadStatus;
        },

        getArticlesAdmin(state) {
            return state.articlesAdmin;
        },

        getArticleLoadStatus(state) {
            return state.articleLoadStatus;
        },

        getArticle(state) {
            return state.article;
        }
    }
}