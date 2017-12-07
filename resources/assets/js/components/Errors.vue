<template>
    <div id="errors" class="alert alert-danger" v-if="content.length > 0">
        <ul>
            <li v-for="error in content">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['content']
    }
</script>