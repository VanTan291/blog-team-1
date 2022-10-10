<template src="./index.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'profile',
    computed: {
        ...mapGetters({
            params: 'Profile/params',
        }),
    },
    mounted() {
        this.getUserProfile();
    },

    methods: {
        ...mapActions({
            getUserProfile: 'Profile/getProfile'
        }),
    }
};
</script>
