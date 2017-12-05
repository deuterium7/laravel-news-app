<template>
    <div id="user" v-if="userLoadStatus === 2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ user.name }}</div>

                        <div class="panel-body">
                            <div class="description">
                                <div class="col-md-3">
                                    <div class="center">
                                        <img class="avatar" :src="user.avatar">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="right">{{ user.updated_at }}</div>
                                    <div v-if="user.admin">Role: admin</div>
                                    <div v-else>Role: user</div>
                                    <div>Email: {{ user.email }}</div>
                                </div>
                            </div>

                            <comments :from="'user'"></comments>
                        </div>
                    </div>
                </div>
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
            this.$store.dispatch('loadUser', {
                id: this.$route.params.id
            });
        },

        computed: {
            userLoadStatus() {
                return this.$store.getters.getUserLoadStatus;
            },

            user() {
                return this.$store.getters.getUser;
            }
        }
    }
</script>

<style>
    .right { text-align: right; }
    .description { height: 120px; }
    .center { text-align: center; }
    img.avatar { border-radius: 50%; }
    .comment-title {}
</style>