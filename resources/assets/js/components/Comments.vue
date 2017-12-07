<template>
    <div id="comments" v-if="commentsClientLoadStatus === 2 && commentsClient.length > 0">
        <div class="container">
            <div class="row">
                <h4 class="comment-title">Latest comments</h4>
                <div v-for="(comment, index) in commentsClient">
                    <h5 v-if="from === 'article'">
                        [
                        <router-link :to="{ name: 'user', params: { id: comment.user_id } }">
                            {{ comment.user.name }}
                        </router-link>
                        ]
                        <div class="comment-edit" v-if="comment.user_id === $store.getters.getAuth.id">
                            : <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                        </div>
                    </h5>
                    <h5 v-else>
                        <router-link :to="{ name: 'article', params: { id: comment.article_id } }">
                            {{ comment.article.title}}
                        </router-link>
                    </h5>
                    <p>{{ comment.body }}</p>
                    <div class="comment-date">{{ comment.updated_at }}</div>

                    <div class="modal fade" tabindex="-1" role="dialog" id="update_comment_model">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Comment</h4>
                                </div>
                                <div class="modal-body">
                                    <errors :content="errors"></errors>
                                    <div class="form-group">
                                        <textarea cols="30" rows="5" class="form-control" placeholder="Task Description" v-model="update_comment.body"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" @click="updateComment" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../components/Errors';

    export default {
        components: {
            Errors
        },

        props: ['from'],

        data() {
            return {
                update_comment: {},
                errors: []
            }
        },

        created() {
            this.$store.dispatch('loadCommentsClient', {
                id: this.$route.params.id,
                from: this.from
            });
        },

        computed: {
            commentsClientLoadStatus() {
                return this.$store.getters.getCommentsClientLoadStatus;
            },

            commentsClient() {
                return this.$store.getters.getCommentsClient;
            }
        },

        methods: {
            initUpdate(index) {
                this.errors = [];
                $('#update_comment_model').modal('show');
                this.update_comment = this.commentsClient[index];
            },

            updateComment() {
                axios.put('api/comments/' + this.update_comment.id, {
                    body: this.update_comment.body
                })
                    .then(() => {
                        $('#update_comment_model').modal('hide');
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.body) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.body);
                        }
                    })
            }
        }
    }
</script>

<style>
    .comment-edit { display: inline-block; }
    .comment-title { text-align: center; }
    .comment-date { text-align: right; }
</style>