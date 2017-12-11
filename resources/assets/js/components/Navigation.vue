<template>
    <nav id="navigation" class="navbar navbar-default navbar-static-top">
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
                    {{ trans('catalog.news') }}
                </router-link>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <router-link :to="{ name: 'categories' }">
                            {{ trans('catalog.categories') }}
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'contact' }">
                            {{ trans('catalog.contact') }}
                        </router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ trans('catalog.locales') }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/locale/ru">{{ trans('catalog.russian') }}</a>
                            </li>
                            <li>
                                <a href="/locale/uk">{{ trans('catalog.ukraine') }}</a>
                            </li>
                            <li>
                                <a href="/locale/en">{{ trans('catalog.english') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" v-if="authLoadStatus === 2">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ this.$root.auth.name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li v-if="this.$root.auth.admin">
                                <router-link :to="{ name: 'admin' }">
                                    {{ trans('catalog.admin') }}
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'user', params: { id: this.$root.auth.id } }">
                                    {{ trans('catalog.profile') }}
                                </router-link>
                            </li>
                            <li>
                                <a href="/logout">{{ trans('catalog.logout') }}</a>
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
        data() {
            return {
                authLoadStatus: 0
            }
        },

        created() {
            this.getAuth();
        },

        methods: {
            getAuth() {
                this.authLoadStatus = 1;
                axios.get('api/auth')
                    .then((response) => {
                        this.$root.auth = response.data;
                        this.authLoadStatus = 2;
                    });
            }
        }
    }
</script>