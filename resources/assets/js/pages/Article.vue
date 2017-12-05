<template>
    <div id="article" v-if="articleLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div class="col-md-4"><img :src="article.image"></div>
                <div class="col-md-8">
                    <h3 class="article-title">{{ article.title }}</h3>
                    <h4>Category:
                        <router-link :to="{ name: 'category', params: { id: article.category_id } }">
                            {{ article.category.name }}
                        </router-link>
                    </h4>
                    <h4>Author:
                        <router-link :to="{ name: 'user', params: { id: article.user_id } }">
                            {{ article.user.name }}
                        </router-link>
                    </h4>
                    <p>{{ article.body }}</p>
                    <div class="article-date">{{ article.updated_at }}</div>
                </div>

                <comments :from="'article'"></comments>
            </div>
        </div>
    </div>
</template>

<script>
    import Comments from '../components/Comments';

    export default {
        components: {
            Comments
        },

        created() {
            this.$store.dispatch('loadArticle', {
                id: this.$route.params.id
            });
        },

        computed: {
            articleLoadStatus() {
                return this.$store.getters.getArticleLoadStatus;
            },

            article() {
                return this.$store.getters.getArticle;
            }
        }
    }
</script>

<style>
    #article { margin-bottom: 10px; }
    .article-title { text-align: center; }
    .article-date { text-align: right; }
</style>