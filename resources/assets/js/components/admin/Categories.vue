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
                    <tr v-for="category in categories">
                        <td>
                            <router-link :to="{ name: 'category', params: { id: category.id } }">
                                {{ category.name }}
                            </router-link>
                        </td>
                        <td>
                            {{ category.image }}
                        </td>
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadCategories');
        },

        computed: {
            categoriesLoadStatus() {
                return this.$store.getters.getCategoriesLoadStatus;
            },

            categories() {
                return this.$store.getters.getCategories;
            }
        }
    }
</script>