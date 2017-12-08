<template>
    <div id="articles" v-if="articlesLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Articles
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Visibility</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="article in articles.data">
                        <td>
                            <router-link :to="{ name: 'article', params: { id: article.id } }">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>
                            <router-link :to="{ name: 'category', params: { id: article.category_id } }">
                                {{ article.category.name }}
                            </router-link>
                        </td>

                        <td v-if="article.visibility">Yes</td>
                        <td v-else>No</td>

                        <td>
                            <form>
                                <input type="submit" class="btn btn-warning" value="Edit">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form>
                    <input type="submit" class="btn btn-success" value="Create">
                </form>
                <div class="paginator">
                    <pagination :data="articles" :limit="5" v-on:pagination-change-page="getArticles"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                articles: {},
                articlesLoadStatus: 0
            }
        },

        created() {
            this.getArticles();
        },

        methods: {
            getArticles(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.articlesLoadStatus = 1;
                axios.get('api/admin/articles/?page=' + page)
                    .then((response) => {
                        this.articles = response.data;
                        this.articlesLoadStatus = 2;
                    });
            }
        }
    }
</script>

<style>
    div.paginator { text-align: center; }
</style>