/*
|-------------------------------------------------------------------------------
| VUEX modules/articles.js
|-------------------------------------------------------------------------------
| The Vuex data store for the articles
*/

import ArticleAPI from '../api/article.js';

export const articles = {
    state: {
        articles: [],
        articlesLoadStatus: 0,

        article: {},
        articleLoadStatus: 0
    },

    actions: {
        loadArticles({ commit }) {
            commit('setArticlesLoadStatus', 1);

            ArticleAPI.index()
                .then(function(response) {
                    commit('setArticles', response.data);
                    commit('setArticlesLoadStatus', 2);
                })
                .catch(function() {
                    commit('setArticles', []);
                    commit('setArticlesLoadStatus', 3);
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
        setArticlesLoadStatus(state, status) {
            state.articlesLoadStatus = status;
        },

        setArticles(state, articles) {
            state.articles = articles;
        },

        setArticleLoadStatus(state, status) {
            state.articleLoadStatus = status;
        },

        setArticle(state, article) {
            state.article = article;
        }
    },

    getters: {
        getArticlesLoadStatus(state) {
            return state.articlesLoadStatus;
        },

        getArticles(state) {
            return state.articles;
        },

        getArticleLoadStatus(state) {
            return state.articleLoadStatus;
        },

        getArticle(state) {
            return state.article;
        }
    }
}