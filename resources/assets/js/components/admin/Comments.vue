<template>
    <div id="comments" v-if="commentsLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Comments
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Article</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="comment in comments.data">
                        <td>{{ comment.body }}</td>
                        <td>
                            <router-link :to="{ name: 'article', params: { id: comment.article_id } }">
                                {{ comment.article.title }}
                            </router-link>
                        </td>
                        <td>
                            <router-link :to="{ name: 'user', params: { id: comment.user_id } }">
                                {{ comment.user.name }}
                            </router-link>
                        </td>
                        <td>
                            <form>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="paginator">
                    <pagination :data="comments" :limit="5" v-on:pagination-change-page="getComments"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                comments: {},
                commentsLoadStatus: 0
            }
        },

        created() {
            this.getComments();
        },

        methods: {
            getComments(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.commentsLoadStatus = 1;
                axios.get('api/admin/comments/?page=' + page)
                    .then((response) => {
                        this.comments = response.data;
                        this.commentsLoadStatus = 2;
                    });
            }
        }
    }
</script>