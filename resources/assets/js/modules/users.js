/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import userAPI from '../api/user.js';

export const users = {
    state: {
        usersAdmin: [],
        usersAdminLoadStatus: 0,

        auth: {},
        authLoadStatus: 0,

        user: {},
        userLoadStatus: 0
    },

    actions: {
        loadUsersAdmin({ commit }) {
            commit('setUsersAdminLoadStatus', 1);

            userAPI.usersAdmin()
                .then(function(response) {
                    commit('setUsersAdmin', response.data);
                    commit('setUsersAdminLoadStatus', 2);
                })
                .catch(function() {
                    commit('setUsersAdmin', {});
                    commit('setUsersAdminLoadStatus', 3);
                });
        },

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
        setUsersAdminLoadStatus(state, status) {
            state.usersAdminLoadStatus = status;
        },

        setUsersAdmin(state, usersAdmin) {
            state.usersAdmin = usersAdmin;
        },

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
        getUsersAdminLoadStatus(state) {
            return state.usersAdminLoadStatus;
        },

        getUsersAdmin(state) {
            return state.usersAdmin;
        },

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