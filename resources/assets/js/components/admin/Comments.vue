<template>
    <div id="comments" v-if="commentsLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('catalog.comments') }}
            </div>
            <div class="panel-body">
                <form @submit.prevent="getComments">
                    <search description="Search By Comment"></search>
                </form>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>
                            <a class="button" @click="initSort('body')">
                                {{ trans('catalog.comment') }}
                            </a>
                        </th>
                        <th>
                            <a class="button" @click="initSort('article_id')">
                                {{ trans('catalog.article') }}
                            </a>
                        </th>
                        <th>
                            <a class="button" @click="initSort('user_id')">
                                {{ trans('catalog.user') }}
                            </a>
                        </th>
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
    import Search from '../Search';

    export default {
        data() {
            return {
                comments: {},
                commentsLoadStatus: 0,
                keywords: '',
                sort: {
                    field: 'updated_at',
                    direction: 'desc',
                }
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
                axios.get('api/admin/comments/?page='+page+'&keywords='+this.keywords+'&field='+this.sort.field+'&direction='+this.sort.direction)
                    .then((response) => {
                        this.comments = response.data;
                        this.commentsLoadStatus = 2;
                    });
            },

            switchDirection() {
                this.sort.direction = this.sort.direction === 'desc' ? 'asc' : 'desc';
            },

            initSort(field) {
                this.sort.field = field;
                this.switchDirection();
                this.getComments();
            },

            deleteComment(index) {
                axios.delete('api/comments/' + this.comments.data[index].id)
                    .then(() => {
                        this.getComments();
                    });
            }
        },

        components: {
            Search
        }
    }
</script>