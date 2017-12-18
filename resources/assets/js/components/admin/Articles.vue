<template>
    <div id="articles" v-if="articlesLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('catalog.news') }}
            </div>
            <div class="panel-body">
                <form @submit.prevent="getArticles">
                    <search description="Search By Title"></search>
                </form>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>
                            <a class="button" @click="initSort('title')">
                                {{ trans('catalog.title') }}
                            </a>
                        </th>
                        <th>
                            <a class="button" @click="initSort('category_id')">
                                {{ trans('catalog.category') }}
                            </a>
                        </th>
                        <th>
                            <a class="button" @click="initSort('visibility')">
                                {{ trans('catalog.visibility') }}
                            </a>
                        </th>
                        <th>
                            <a class="button" @click="initSort('favorite')">
                                {{ trans('catalog.favorite') }}
                            </a>
                        </th>
                        <th>{{ trans('catalog.actions') }}</th>
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

                        <td v-if="article.visibility">{{ trans('catalog.yes') }}</td>
                        <td v-else>{{ trans('catalog.no') }}</td>

                        <td v-if="article.favorite">{{ trans('catalog.yes') }}</td>
                        <td v-else>{{ trans('catalog.no') }}</td>

                        <td>
                            <button class="btn btn-warning" @click="initUpdate(index)">{{ trans('catalog.edit') }}</button>
                            <button class="btn btn-danger" @click="deleteArticle(index)">{{ trans('catalog.destroy') }}</button>
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
                                <h4 class="modal-title">{{ trans('catalog.updateNews') }}</h4>
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
                                            {{ trans('catalog.enterArticleVisible') }}
                                        </label>
                                        <label class="from-check-label">
                                            <input type="checkbox" name="favorite" class="form-check-input" v-model="update_article.favorite">
                                            {{ trans('catalog.enterArticleFavorite') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('catalog.close') }}</button>
                                    <button type="button" class="btn btn-primary" @click="updateArticle">{{ trans('catalog.update') }}</button>
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
    import Search from '../Search';

    export default {
        data() {
            return {
                articles: {},
                articlesLoadStatus: 0,
                update_article: {},
                errors: [],
                keywords: '',
                sort: {
                    field: 'updated_at',
                    direction: 'desc',
                }
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
                axios.get('api/admin/articles/?page='+page+'&keywords='+this.keywords+'&field='+this.sort.field+'&direction='+this.sort.direction)
                    .then((response) => {
                        this.articles = response.data;
                        this.articlesLoadStatus = 2;
                    });
            },

            switchDirection() {
                this.sort.direction = this.sort.direction === 'desc' ? 'asc' : 'desc';
            },

            initSort(field) {
                this.sort.field = field;
                this.switchDirection();
                this.getArticles();
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
                        this.getArticles();
                    });
            }
        },

        components: {
            ArticleCreate,
            Errors,
            Search
        }
    }
</script>

<style>
    div.paginator {
        text-align: center;
    }

    .stylish-input-group button {
        border:0;
        background:transparent;
    }

    .button {
        cursor: pointer;
    }
</style>