<template>
    <div id="articles">
        <div class="container">
            <div class="row">
                <ul v-for="article in articles">
                    <li>
                        <div class="clearfix">
                            <div class="col-md-4">
                                <img :src="article.image">
                            </div>
                            <div class="col-md-8">
                                <h3 class="center">
                                    {{ article.title }}
                                </h3>
                                <p>{{ article.body }}</p>
                                <div style="float:left;">
                                    Read
                                </div>
                                <div style="float:right;">
                                    <span>{{ article.updated_at }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadArticles');
        },

        computed: {
            articlesLoadStatus() {
                return this.$store.getters.getArticlesLoadStatus;
            },

            articles() {
                return this.$store.getters.getArticles;
            }
        }
    }
</script>

<style>
    li { list-style: none; }
</style>