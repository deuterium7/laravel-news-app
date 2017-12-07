export default {

    commentsAdmin: function() {
        return axios.get('api/admin/comments');
    },

    commentsClient: function (id, from) {
        return axios.get('api/comments/' + id + '/' + from);
    }
}