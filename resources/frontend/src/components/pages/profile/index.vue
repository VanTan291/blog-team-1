<template src="./index.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'profile',
    computed: {
        ...mapGetters({
            infoProfile: 'Profile/infoProfile',
            infoUser: 'Profile/infoUser',
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
