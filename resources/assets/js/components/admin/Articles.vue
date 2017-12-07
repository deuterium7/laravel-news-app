<template>
    <div id="articles" v-if="articlesAdminLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Articles
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Visibility</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="article in articlesAdmin">
                        <td>
                            <router-link :to="{ name: 'article', params: { id: article.id } }">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>
                            <router-link :to="{ name: 'category', params: { id: article.category_id } }">
                                {{ article.category.name }}
                            </router-link>
                        </td>

                        <td v-if="article.visibility">True</td>
                        <td v-else>False</td>

                        <td>
                            <form>
                                <input type="submit" class="btn btn-warning" value="Edit">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form>
                    <input type="submit" class="btn btn-success" value="Create">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadArticlesAdmin');
        },

        computed: {
            articlesAdminLoadStatus() {
                return this.$store.getters.getArticlesAdminLoadStatus;
            },

            articlesAdmin() {
                return this.$store.getters.getArticlesAdmin;
            }
        }
    }
</script>