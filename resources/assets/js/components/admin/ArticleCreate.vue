<template>
    <div id="article-create">
        <button type="button" class="btn btn-success" @click="initAddArticle">{{ trans('catalog.create') }}</button>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_article_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ trans('catalog.createArticle') }}</h4>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="modal-body">
                            <errors :content="errors"></errors>
                            <div class="form-group">
                                <input type="text" name="category_id" class="form-control" placeholder="Enter Category ID" v-model="article.category_id">
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Enter Article Title" v-model="article.title">
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control" accept="image/*" @change="onFileChange">
                            </div>
                            <div class="form-group">
                                <textarea name="body" cols="30" rows="5" class="form-control" placeholder="Enter Article Body" v-model="article.body"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="from-check-label">
                                    <input type="checkbox" name="visibility" class="form-check-input" v-model="article.visibility">
                                    {{ trans('catalog.enterArticleVisible') }}
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('catalog.close') }}</button>
                            <button type="button" class="btn btn-primary" @click="createArticle">{{ trans('catalog.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../Errors';

    export default {
        data() {
            return {
                article: {
                    category_id: '',
                    user_id: this.$root.auth.id,
                    title: '',
                    image: '',
                    body: '',
                    visibility: true
                },
                errors: []
            }
        },

        methods: {
            initAddArticle() {
                this.errors = [];
                $('#add_article_modal').modal('show');
            },

            onFileChange(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.article.image = e.target.result;
                };
            },

            createArticle() {
                axios.post('api/articles', this.article)
                    .then(() => {
                        this.article.category_id = '';
                        this.article.title = '';
                        this.article.image = '';
                        this.article.body= '';
                        this.article.visibility = true;
                        $('#add_article_modal').modal('hide');

                        location.reload();
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.title) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.title);
                        }

                        if (error.response.data.errors.image) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.image);
                        }

                        if (error.response.data.errors.body) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.body);
                        }
                    });
            }
        },

        components: {
            Errors
        }
    }
</script>