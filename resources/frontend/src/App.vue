<template>
    <div id="app">
        <notifications group="auth" position="top right" />
        <vue-confirm-dialog></vue-confirm-dialog>
        <router-view />
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>
