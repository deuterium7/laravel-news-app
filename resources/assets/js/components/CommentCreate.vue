<template>
    <div id="comment-create">
        <button @click="initAddComment" class="btn btn-primary btn-xs pull-right">
            + {{ trans('catalog.addComment') }}
        </button>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_comment_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ trans('catalog.createComment') }}</h4>
                    </div>
                    <div class="modal-body">
                        <errors :content="errors"></errors>
                        <div class="form-group">
                            <label for="body">{{ trans('catalog.enterComment') }}</label>
                            <textarea id="body" name="body" cols="30" rows="5" class="form-control" v-model="comment.body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('catalog.close') }}</button>
                        <button type="button" class="btn btn-primary" @click="createComment">{{ trans('catalog.submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from '../components/Errors';

    export default {
        data() {
            return {
                comment: {
                    article_id: this.$route.params.id,
                    user_id: this.$root.auth.id,
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
                axios.post('api/comments', this.comment)
                    .then(() => {
                        this.comment.body = '';
                        $('#add_comment_modal').modal('hide');

                        location.reload();
                    })
                    .catch((error) => {
                        this.errors = [];

                        if (error.response.data.errors.body) {
                            Array.prototype.push.apply(this.errors, error.response.data.errors.body);
                        }
                    });
            }
        },

        components: {
            Errors
        }
    }
</script>