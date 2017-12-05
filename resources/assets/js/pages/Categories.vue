<template>
    <div id="categories" v-if="categoriesLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div class="col-md-4 category" v-for="category in categories">
                    <div class="category-image">
                        <router-link :to="{ name: 'category', params: { id: category.id } }">
                            <img :src="category.image">
                        </router-link>
                    </div>
                    <div class="category-name">
                        <router-link :to="{ name: 'category', params: { id: category.id } }">
                            {{ category.name }}
                        </router-link>
                    </div>
                </div>
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

<style>
    .category { margin-bottom: 16px; text-align: center; }
    .category-name { margin-top: 4px; }
</style>