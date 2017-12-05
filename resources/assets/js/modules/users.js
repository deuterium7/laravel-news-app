/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import userAPI from '../api/user.js';

export const users = {
    state: {
        auth: {},
        authLoadStatus: 0,

        user: {},
        userLoadStatus: 0,
    },

    actions: {
        loadAuth({ commit }) {
            commit('setAuthLoadStatus', 1);

            userAPI.auth()
                .then(function(response) {
                    commit('setAuth', response.data);
                    commit('setAuthLoadStatus', 2);
                })
                .catch(function() {
                    commit('setAuth', {});
                    commit('setAuthLoadStatus', 3);
                });
        },

        loadUser({ commit }, data) {
            commit('setUserLoadStatus', 1);

            userAPI.show(data.id)
                .then(function(response) {
                    commit('setUser', response.data);
                    commit('setUserLoadStatus', 2);
                })
                .catch(function() {
                    commit('setUser', {});
                    commit('setUserLoadStatus', 3);
                });
        }
    },

    mutations: {
        setAuthLoadStatus(state, status) {
            state.authLoadStatus = status;
        },

        setAuth(state, auth) {
            state.auth = auth;
        },

        setUserLoadStatus(state, status) {
            state.userLoadStatus = status;
        },

        setUser(state, user) {
            state.user = user;
        }
    },

    getters: {
        getAuthLoadStatus(state) {
            return state.authLoadStatus;
        },

        getAuth(state) {
            return state.auth;
        },

        getUserLoadStatus(state) {
            return state.userLoadStatus;
        },

        getUser(state) {
            return state.user;
        }
    }
}