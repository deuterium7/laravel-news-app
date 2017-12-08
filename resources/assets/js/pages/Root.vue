<template>
    <div id="root">
        <navigation></navigation>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navigation from '../components/Navigation';

    export default {
        components: {
            Navigation
        }
    }
</script>

<style>
    * { font-family: sans-serif; }
    p { text-align: justify; }
</style>