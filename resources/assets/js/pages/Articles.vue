<template>
    <div id="articles" v-if="articlesLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div v-for="article in articles.data">
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
                                Read more
                            </router-link>
                            <div class="article-date">
                                <span>{{ article.updated_at }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
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
                axios.get('api/articles/?page=' + page)
                    .then((response) => {
                        this.articles = response.data;
                        this.articlesLoadStatus = 2;
                    });
            }
        }
    }
</script>

<style>
    .article-title { text-align: center; }
    .article-date { text-align: right; }
    div.paginator { text-align: center; }
</style>