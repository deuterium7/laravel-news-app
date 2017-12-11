<template>
    <div id="category" v-if="categoryLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div v-for="article in category.data">
                    <div class="clearfix">
                        <div class="col-md-4">
                            <router-link :to="{ name: 'article', params: { id: article.id } }">
                                <img :src="article.image">
                            </router-link>
                        </div>
                        <div class="col-md-8">
                            <h3 class="article-title">
                                <router-link :to="{ name: 'article', params: { id: article.id } }">
                                    {{ article.title }}
                                </router-link>
                            </h3>
                            <p>{{ article.body }}</p>
                            <router-link :to="{ name: 'article', params: { id: article.id } }">
                                {{ trans('catalog.read') }}
                            </router-link>
                            <div class="article-date">
                                <span>{{ article.updated_at }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="paginator">
                    <pagination :data="category" :limit="5" v-on:pagination-change-page="getCategory"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: {},
                categoryLoadStatus: 0
            }
        },

        created() {
            this.getCategory();
        },

        methods: {
            getCategory(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.categoryLoadStatus = 1;
                axios.get('api/categories/' + this.$route.params.id + '/?page=' + page)
                    .then((response) => {
                        this.category = response.data;
                        this.categoryLoadStatus = 2;
                    });
            }
        },
    }
</script>

<style>
    .article-title, div.paginator { text-align: center; }
    .article-date { text-align: right; }
</style>