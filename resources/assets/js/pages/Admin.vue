<template>
    <div id="admin">
        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <li><a @click="toggle = 'articles'">{{ trans('catalog.news') }}</a></li>
                    <li><a @click="toggle = 'categories'">{{ trans('catalog.categories') }}</a></li>
                    <li><a @click="toggle = 'comments'">{{ trans('catalog.comments') }}</a></li>
                    <li><a @click="toggle = 'users'">{{ trans('catalog.users') }}</a></li>
                    <li><a href="/logs">{{ trans('catalog.logs') }}</a></li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <articles   v-if="toggle === 'articles'"></articles>
                <categories v-if="toggle === 'categories'"></categories>
                <comments   v-if="toggle === 'comments'"></comments>
                <users      v-if="toggle === 'users'"></users>
            </div>
        </div>
    </div>
</template>

<script>
    import Articles from '../components/admin/Articles';
    import Categories from '../components/admin/Categories';
    import Comments from '../components/admin/Comments';
    import Users from '../components/admin/Users';

    export default {
        data() {
            return {
                toggle: 'articles'
            }
        },

        components: {
            Articles,
            Categories,
            Comments,
            Users
        }
    }
</script>

<style>
    .sidebar {
        padding-left: 0;
    }

    .main-container {
        background: #FFF;
        padding-top: 15px;
        margin-top: -20px;
    }

    div.container-fluid { height: 90vh; }
</style>