/*
|-------------------------------------------------------------------------------
| VUEX modules/comments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the comments
*/

import commentAPI from '../api/comment.js';

export const comments = {
    state: {
        commentsClient: {},
        commentsClientLoadStatus: 0,

        commentsAdmin: {},
        commentsAdminLoadStatus: 0
    },

    actions: {
        loadCommentsClient({ commit }, data) {
            commit('setCommentsClientLoadStatus', 1);

            commentAPI.commentsClient(data.id, data.from)
                .then(function(response) {
                    commit('setCommentsClient', response.data);
                    commit('setCommentsClientLoadStatus', 2);
                })
                .catch(function() {
                    commit('setCommentsClient', []);
                    commit('setCommentsClientLoadStatus', 3);
                });
        },

        loadCommentsAdmin({ commit }) {
            commit('setCommentsAdminLoadStatus', 1);

            commentAPI.commentsAdmin()
                .then(function(response) {
                    commit('setCommentsAdmin', response.data);
                    commit('setCommentsAdminLoadStatus', 2);
                })
                .catch(function() {
                    commit('setCommentsAdmin', []);
                    commit('setCommentsAdminLoadStatus', 3);
                });
        }
    },

    mutations: {
        setCommentsClientLoadStatus(state, status) {
            state.commentsClientLoadStatus = status;
        },

        setCommentsClient(state, comments) {
            state.commentsClient = comments;
        },

        setCommentsAdminLoadStatus(state, status) {
            state.commentsAdminLoadStatus = status;
        },

        setCommentsAdmin(state, comments) {
            state.commentsAdmin = comments;
        }
    },

    getters: {
        getCommentsClientLoadStatus(state) {
            return state.commentsClientLoadStatus;
        },

        getCommentsClient(state) {
            return state.commentsClient;
        },

        getCommentsAdminLoadStatus(state) {
            return state.commentsAdminLoadStatus;
        },

        getCommentsAdmin(state) {
            return state.commentsAdmin;
        }
    }
}