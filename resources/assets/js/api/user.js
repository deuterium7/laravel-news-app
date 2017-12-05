export default {

    auth: function () {
        return axios.get('api/auth');
    },

    show: function (id) {
        return axios.get('api/users/' + id);
    }
}