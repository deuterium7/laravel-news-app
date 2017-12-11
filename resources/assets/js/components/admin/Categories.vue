<template>
    <div id="categories" v-if="categoriesLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Categories
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(category, index) in categories">
                        <td>
                            <router-link :to="{ name: 'category', params: { id: category.id } }">
                                {{ category.name }}
                            </router-link>
                        </td>
                        <td>
                            {{ category.image }}
                        </td>
                        <td>
                            <button class="btn btn-warning" @click="initUpdate(index)">Edit</button>
                            <button class="btn btn-danger" @click="deleteCategory(index)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <category-create></category-create>
                <div class="modal fade" tabindex="-1" role="dialog" id="update_category_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Update Category</h4>
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="modal-body">
                                    <errors :content="errors"></errors>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Enter Category Name" v-model="update_category.name">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control" accept="image/*" @change="onFileChange">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" @click="updateCategory">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CategoryCreate from './CategoryCreate';
    import Errors from '../Errors';

    export default {
        data() {
            return {
                categories: [],
                categoriesLoadStatus: 0,
                update_category: {},
                errors: []
            }
        },

        created() {
            this.getCategories();
        },

        methods: {
            getCategories() {
                this.categoriesLoadStatus = 1;
                axios.get('api/categories')
                    .then((response) => {
                        this.categories = response.data;
                        this.categoriesLoadStatus = 2;
                    });
            },

            initUpdate(index) {
                this.errors = [];
                $('#update_category_modal').modal('show');
                this.update_category = this.categories[index];
            },

            onFileChange(e) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.update_category.imageNew = e.target.result;
                };
            },

            updateCategory() {
                axios.put('api/categories/' + this.update_category.id, this.update_category)
                    .then(() => {
                        $('#update_category_modal').modal('hide');
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.name) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.name);
                        }

                        if (error.response.data.errors.image) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.image);
                        }
                    })
            },

            deleteCategory(index) {
                axios.delete('api/categories/' + this.categories[index].id)
                    .then(() => {
                        location.reload();
                    });
            }
        },

        components: {
            CategoryCreate,
            Errors
        }
    }
</script>