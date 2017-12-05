export default {

    comments: function (id, from) {
        return axios.get('api/comments/' + id + '/' + from);
    }
}