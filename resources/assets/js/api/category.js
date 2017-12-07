export default {

    index: function () {
        return axios.get('api/categories');
    },

    show: function (id) {
        return axios.get('api/categories/' + id);
    }
}