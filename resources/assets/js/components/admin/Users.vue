<template>
    <div id="articles" v-if="usersAdminLoadStatus === 2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Ban</th>
                        <th>Registred At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in usersAdmin">
                        <td>
                            <router-link :to="{ name: 'user', params: { id: user.id } }">
                                {{ user.name }}
                            </router-link>
                        </td>
                        <td>{{ user.email}}</td>

                        <td v-if="user.admin">True</td>
                        <td v-else>False</td>

                        <td v-if="user.ban">True</td>
                        <td v-else>False</td>

                        <td>{{ user.created_at }}</td>
                        <td>
                            <form>
                                <input type="submit" class="btn btn-warning" value="Ban">
                                <input type="submit" class="btn btn-danger" value="Admin">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('loadUsersAdmin');
        },

        computed: {
            usersAdminLoadStatus() {
                return this.$store.getters.getUsersAdminLoadStatus;
            },

            usersAdmin() {
                return this.$store.getters.getUsersAdmin;
            }
        }
    }
</script>