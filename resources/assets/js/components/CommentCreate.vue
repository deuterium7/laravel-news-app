<template>
    <div id="comment-create">
        <button @click="initAddComment" class="btn btn-primary btn-xs pull-right">
            + Add New Comment
        </button>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_comment_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Create New Comment</h4>
                    </div>
                    <div class="modal-body">
                        <errors :content="errors"></errors>
                        <div class="form-group">
                            <textarea name="body" cols="30" rows="5" class="form-control" placeholder="Enter Your Comment" v-model="comment.body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="createComment">Submit</button>
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

        data() {
            return {
                comment: {
                    body: ''
                },
                errors: []
            }
        },

        methods: {
            initAddComment() {
                this.errors = [];
                $('#add_comment_modal').modal('show');
            },
            createComment() {
                axios.post('api/comments', {
                    article_id: this.$route.params.id,
                    user_id: this.$store.getters.getAuth.id,
                    body: this.comment.body,
                })
                    .then(() => {
                        this.comment.body = '';
                        $('#add_comment_modal').modal('hide');

                        location.reload(); // DELETE THIS
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.body) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.body);
                        }
                    });
            }
        }
    }
</script>