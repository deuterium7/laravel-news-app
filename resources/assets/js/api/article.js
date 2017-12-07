export default {

    articlesAdmin: function() {
        return axios.get('api/admin/articles');
    },

    index: function () {
        return axios.get('api/articles');
    },

    show: function (id) {
        return axios.get('api/articles/' + id);
    }
}