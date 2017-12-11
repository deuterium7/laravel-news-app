<template>
    <div id="comments" v-if="commentsLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('catalog.comments') }}
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>{{ trans('catalog.comment') }}</th>
                        <th>{{ trans('catalog.article') }}</th>
                        <th>{{ trans('catalog.user') }}</th>
                        <th>{{ trans('catalog.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(comment, index) in comments.data">
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
                            <button class="btn btn-danger" @click="deleteComment(index)">{{ trans('catalog.destroy') }}</button>
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
            },

            deleteComment(index) {
                axios.delete('api/comments/' + this.comments.data[index].id)
                    .then(() => {
                        location.reload();
                    });
            }
        }
    }
</script>