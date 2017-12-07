<template>
    <div id="comments" v-if="commentsAdminLoadStatus === 2">
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
                    <tr v-for="comment in commentsAdmin">
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadCommentsAdmin');
        },

        computed: {
            commentsAdminLoadStatus() {
                return this.$store.getters.getCommentsAdminLoadStatus;
            },

            commentsAdmin() {
                return this.$store.getters.getCommentsAdmin;
            }
        }
    }
</script>