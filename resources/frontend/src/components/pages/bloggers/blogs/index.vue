<template src="./index.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../../helper/function'

export default {
    name: 'blog',
    data() {
        return {
            param: {
                page: 1,
            },
        };
    },
    mixins: [utils],
    mounted() {
        this.getListBlog(this.param);
    },
    computed: {
        ...mapGetters({
            listBlog: 'Blog/blogs',
        })
    },
    methods: {
        ...mapActions({
            getListBlog: 'Blog/getListBlog',
        }),
    }
};
</script>
