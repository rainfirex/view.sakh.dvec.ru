<template>
    <div class="is-loading">
        <img src="../assets/icons/Spinner-1s-200px.svg" alt="progress">
    </div>
</template>

<script>
    export default {
        name: "Loading"
    }
</script>

<style lang="scss" scoped>
    .is-loading{
        position: fixed;
        left: 0;
        bottom: 0;
        z-index: 3;
    }
</style>
