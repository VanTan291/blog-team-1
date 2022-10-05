<template src="./detail.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'Home',
    data() {
        return {
            id: ''
        };
    },
    watch: {
        id() {
            this.getDetailBlog(this.id);
        }
    },
    mounted() {
        this.id = this.$route.params.id;
        this.getDetailBlog(this.id);
    },
    computed: {
        ...mapGetters({
            detailBlog: 'Home/detailBlog',
            listOfRelatedBlogs: 'Home/listOfRelatedBlogs',
        })
    },
    methods: {
        ...mapActions({
            getDetailBlog: 'Home/getDetailBlog',
        }),

        showDetail(idBlog) {
            this.id = idBlog
            this.$router.push({ name: 'detail', params: { id: idBlog } });
        }
    }
};
</script>
