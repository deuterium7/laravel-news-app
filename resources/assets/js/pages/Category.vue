<template>
    <div id="category" v-if="categoryLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div v-for="article in category">
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
            this.$store.dispatch('loadCategory', {
                id: this.$route.params.id
            });
        },

        computed: {
            categoryLoadStatus() {
                return this.$store.getters.getCategoryLoadStatus;
            },

            category() {
                return this.$store.getters.getCategory;
            }
        }
    }
</script>

<style>
    .article-title { text-align: center; }
    .article-date { text-align: right; }
</style>