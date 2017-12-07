<template>
    <div id="articles" v-if="articlesClientLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div v-for="article in articlesClient">
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadArticlesClient');
        },

        computed: {
            articlesClientLoadStatus() {
                return this.$store.getters.getArticlesClientLoadStatus;
            },

            articlesClient() {
                return this.$store.getters.getArticlesClient;
            }
        }
    }
</script>

<style>
    .article-title { text-align: center; }
    .article-date { text-align: right; }
</style>