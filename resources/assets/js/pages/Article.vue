<template>
    <div id="article" v-if="articleLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div class="clearfix">
                    <div class="col-md-4"><img :src="article.image"></div>
                    <div class="col-md-8">
                        <div class="article-date">{{ article.updated_at }}</div>
                        <h3 class="article-title">{{ article.title }}</h3>
                        <h4>{{ trans('catalog.category') }}:
                            <router-link :to="{ name: 'category', params: { id: article.category_id } }">
                                {{ article.category.name }}
                            </router-link>
                        </h4>
                        <h4>{{ trans('catalog.author') }}:
                            <router-link :to="{ name: 'user', params: { id: article.user_id } }">
                                {{ article.user.name }}
                            </router-link>
                        </h4>
                        <p>{{ article.body }}</p>
                    </div>
                </div>

                <comment-create></comment-create>
                <comments :from="'article'"></comments>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentCreate from '../components/CommentCreate';
    import Comments from '../components/Comments';

    export default {
        data() {
            return {
                article: {},
                articleLoadStatus: 0
            }
        },

        created() {
            this.getArticle();
        },

        methods: {
            getArticle() {
                this.articleLoadStatus = 1;
                axios.get('api/articles/' + this.$route.params.id)
                    .then((response) => {
                        this.article = response.data;
                        this.articleLoadStatus = 2;
                    });
            }
        },

        components: {
            CommentCreate,
            Comments
        }
    }
</script>

<style>
    #article { margin-bottom: 10px; }
    .article-title { text-align: center; }
    .article-date { text-align: right; }
</style>