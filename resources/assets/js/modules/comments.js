/*
|-------------------------------------------------------------------------------
| VUEX modules/comments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the comments
*/

import commentAPI from '../api/comment.js';

export const comments = {
    state: {
        comments: {},
        commentsLoadStatus: 0
    },

    actions: {
        loadComments({ commit }, data) {
            commit('setCommentsLoadStatus', 1);

            commentAPI.comments(data.id, data.from)
                .then(function(response) {
                    commit('setComments', response.data);
                    commit('setCommentsLoadStatus', 2);
                })
                .catch(function() {
                    commit('setComments', []);
                    commit('setCommentsLoadStatus', 3);
                });
        }
    },

    mutations: {
        setCommentsLoadStatus(state, status) {
            state.commentsLoadStatus = status;
        },

        setComments(state, comments) {
            state.comments = comments;
        }
    },

    getters: {
        getCommentsLoadStatus(state) {
            return state.commentsLoadStatus;
        },

        getComments(state) {
            return state.comments;
        }
    }
}