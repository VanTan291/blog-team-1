<template src="./index.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../helper/function';

export default {
    name: 'Home',
    mixins: [utils],
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
            createBookMark: 'Home/BookMark'
        }),

        async bookMark(id) {
            await this.createBookMark(id).then(result => {
                if (result['code'] == 200) {
                    this.getListBlogHome(this.param)
                } else {
                    this.toastError(result.message);
                }
            }).catch(e => {
                this.toastError('Bạn cần đăng nhập');
                console.log(e);
            })
        }
    }
}
</script>
