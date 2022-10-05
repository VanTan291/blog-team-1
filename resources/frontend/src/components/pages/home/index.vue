<template src="./index.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'Home',
    data() {
        return {
            param: {
                page: 1,
            },
        };
    },
    mounted() {
        this.getListBlogHome(this.param);
    },
    computed: {
        ...mapGetters({
            listBlogTrend: 'Home/listBlogTrend',
            listBlog: 'Home/listBlog',
        })
    },
    methods: {
        ...mapActions({
            getListBlogHome: 'Home/getListBlogHome',
        }),
    }
};
</script>
