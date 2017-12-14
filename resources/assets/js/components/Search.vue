<template>
    <div class="input-group stylish-input-group">
        <input type="text" name="keywords" class="form-control" :placeholder="description" v-model="$parent.keywords">
        <span class="input-group-addon">
            <button type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['description']
    }
</script>

<style>
    .stylish-input-group .input-group-addon{
        background: white !important;
    }

    .stylish-input-group .form-control{
        border-right:0;
        box-shadow:0 0 0;
        border-color:#ccc;
    }

    .stylish-input-group button{
        border:0;
        background:transparent;
    }
</style>