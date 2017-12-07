<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <router-link class="navbar-brand" :to="{ name: 'articles' }">
                    News
                </router-link>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <router-link :to="{ name: 'categories' }">
                            Categories
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'contact' }">
                            Contact
                        </router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Locales -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Locales <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/locale/ru">Russian</a>
                            </li>
                            <li>
                                <a href="/locale/uk">Ukraine</a>
                            </li>
                            <li>
                                <a href="/locale/en">English</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" v-if="authLoadStatus === 2">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ auth.name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li v-if="auth.admin">
                                <router-link :to="{ name: 'admin' }">
                                    Admin
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'user', params: { id: auth.id } }">
                                    My Profile
                                </router-link>
                            </li>
                            <li>
                                <a href="/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            authLoadStatus() {
                return this.$store.getters.getAuthLoadStatus;
            },

            auth() {
                return this.$store.getters.getAuth;
            }
        }
    }
</script>