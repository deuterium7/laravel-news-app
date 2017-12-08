<template>
    <div id="articles" v-if="usersLoadStatus === 2">
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
                    <tr v-for="user in users.data" v-if="user.id !== $root.auth.id">
                        <td>
                            <router-link :to="{ name: 'user', params: { id: user.id } }">
                                {{ user.name }}
                            </router-link>
                        </td>
                        <td>{{ user.email}}</td>

                        <td v-if="user.admin">Yes</td>
                        <td v-else>No</td>

                        <td v-if="user.ban">Yes</td>
                        <td v-else>No</td>

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
                <div class="paginator">
                    <pagination :data="users" :limit="5" v-on:pagination-change-page="getUsers"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                usersLoadStatus: 0
            }
        },

        created() {
            this.getUsers();
        },

        methods: {
            getUsers(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.usersLoadStatus = 1;
                axios.get('api/admin/users/?page=' + page)
                    .then((response) => {
                        this.users = response.data;
                        this.usersLoadStatus = 2;
                    });
            }
        }
    }
</script>