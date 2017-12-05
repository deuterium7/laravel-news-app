<template>
    <div id="comments" v-if="commentsLoadStatus === 2 && comments.length > 0">
        <h4 class="comment-title">Latest comments</h4>
        <div v-for="comment in comments">
            <h5 v-if="from === 'article'">
                [
                    <router-link :to="{ name: 'user', params: { id: comment.user_id } }">
                        {{ comment.user.name }}
                    </router-link>
                ]
            </h5>
            <h5 v-else>
                <router-link :to="{ name: 'article', params: { id: comment.article_id } }">
                    {{ comment.article.title}}
                </router-link>
            </h5>
            <p>{{ comment.body }}</p>
            <div class="comment-date">{{ comment.updated_at }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['from'],

        created() {
            this.$store.dispatch('loadComments', {
                id: this.$route.params.id,
                from: this.from
            });
        },

        computed: {
            commentsLoadStatus() {
                return this.$store.getters.getCommentsLoadStatus;
            },

            comments() {
                return this.$store.getters.getComments;
            }
        }
    }
</script>

<style>
    .comment-title { text-align: center; }
    .comment-date { text-align: right; }
</style>