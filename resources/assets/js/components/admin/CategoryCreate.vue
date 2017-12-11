<template>
    <div id="category-create">
        <button type="button" class="btn btn-success" @click="initAddArticle">{{ trans('catalog.create') }}</button>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_category_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ trans('catalog.createCategory') }}</h4>
                    </div>
                    <form enctype="multipart/form-data">
                        <div class="modal-body">
                            <errors :content="errors"></errors>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter Category Name" v-model="category.name">
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control" accept="image/*" @change="onFileChange">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('catalog.close') }}</button>
                            <button type="button" class="btn btn-primary" @click="createCategory">{{ trans('catalog.submit') }}</button>
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
                category: {
                    name: '',
                    image: '',
                },
                errors: []
            }
        },

        methods: {
            initAddCategory() {
                this.errors = [];
                $('#add_category_modal').modal('show');
            },

            onFileChange(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.category.image = e.target.result;
                };
            },

            createCategory() {
                axios.post('api/categories', this.category)
                    .then(() => {
                        this.category.name = '';
                        this.category.image = '';
                        $('#add_category_modal').modal('hide');

                        location.reload();
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.name) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.name);
                        }

                        if (error.response.data.errors.image) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.image);
                        }
                    });
            }
        },

        components: {
            Errors
        }
    }
</script>