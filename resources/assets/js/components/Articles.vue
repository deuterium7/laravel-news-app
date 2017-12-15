<template>
    <div id="articles">
        <div class="container">
            <div class="row">
                <div v-for="article in data">
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
                            <span class="article-views"><i class="fa fa-eye" aria-hidden="true"></i> {{ article.views }}</span>
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
        props: ['data']
    }
</script>

<style>
    .article-title { text-align: center; }
    .article-views { float: right; }
</style>