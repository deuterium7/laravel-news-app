export default {

    index: function () {
        return axios.get('api/articles');
    },

    show: function (id) {
        return axios.get('api/articles/' + id);
    },

    store: function (category, user, title, image, body, visibility) {
        return axios.post('api/articles', {
            category_id: category,
            user_id: user,
            title: title,
            image: image,
            body: body,
            visibility: visibility
        });
    },

    update: function (id, title, image, body, visibility) {
        return axios.put('api/articles/' + id, {
            title: title,
            image: image,
            body: body,
            visibility: visibility
        });
    },

    destroy: function (id) {
        return axios.delete('api/articles/' + id);
    }
}