export default {

    usersAdmin: function () {
        return axios.get('api/admin/users');
    },

    auth: function () {
        return axios.get('api/auth');
    },

    show: function (id) {
        return axios.get('api/users/' + id);
    }
}