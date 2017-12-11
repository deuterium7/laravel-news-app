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
                    <tr v-for="(article, index) in articles.data">
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
                            <button class="btn btn-warning" @click="initUpdate(index)">Edit</button>
                            <button class="btn btn-danger" @click="deleteArticle(index)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <article-create></article-create>
                <div class="modal fade" tabindex="-1" role="dialog" id="update_article_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Update Article</h4>
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="modal-body">
                                    <errors :content="errors"></errors>
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" placeholder="Enter Article Title" v-model="update_article.title">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control" accept="image/*" @change="onFileChange">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="body" cols="30" rows="5" class="form-control" placeholder="Enter Article Body" v-model="update_article.body"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="from-check-label">
                                            <input type="checkbox" name="visibility" class="form-check-input" v-model="update_article.visibility">
                                            Enter Article Visibility
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" @click="updateArticle">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="paginator">
                    <pagination :data="articles" :limit="5" v-on:pagination-change-page="getArticles"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ArticleCreate from './ArticleCreate';
    import Errors from '../Errors';

    export default {
        data() {
            return {
                articles: {},
                articlesLoadStatus: 0,
                update_article: {},
                errors: []
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
            },

            initUpdate(index) {
                this.errors = [];
                $('#update_article_modal').modal('show');
                this.update_article = this.articles.data[index];
            },

            onFileChange(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.update_article.imageNew = e.target.result;
                };
            },

            updateArticle() {
                axios.put('api/articles/' + this.update_article.id, this.update_article)
                    .then(() => {
                        $('#update_article_modal').modal('hide');
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.title) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.title);
                        }

                        if (error.response.data.errors.body) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.body);
                        }
                    })
            },

            deleteArticle(index) {
                axios.delete('api/articles/' + this.articles.data[index].id)
                    .then(() => {
                        location.reload();
                    });
            }
        },

        components: {
            ArticleCreate,
            Errors
        }
    }
</script>

<style>
    div.paginator { text-align: center; }
</style>