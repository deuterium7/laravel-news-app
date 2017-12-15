<template>
    <div id="home" v-if="articlesLoadStatus === 2">
        <articles :data="articles.data"></articles>
        <div class="paginator">
            <pagination :data="articles" :limit="5" v-on:pagination-change-page="getArticles"></pagination>
        </div>
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
        },

        components: {
            Articles
        }
    }
</script>

<style>
    div.paginator { text-align: center; }
</style>