<template>
    <div id="articles_favorite" v-if="articlesLoadStatus === 2">
        <articles :data="articles"></articles>
    </div>
</template>

<script>
    import Articles from '../components/Articles';

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
            getArticles() {
                this.articlesLoadStatus = 1;
                axios.get('api/favorite/articles')
                    .then((response) => {
                        this.articles = response.data;
                        this.articlesLoadStatus = 2;
                    });
            }
        },

        components: {
            Articles
        }
    }
</script>