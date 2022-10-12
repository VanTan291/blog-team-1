<template src="./detail.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../helper/function';

export default {
    name: 'Home',
    mixins: [utils],
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
            followBlogger: 'Home/follow'
        }),

        showDetail(idBlog) {
            this.id = idBlog
            this.$router.push({ name: 'detail', params: { id: idBlog } });
        },

        async follow(userId) {
            console.log(userId);
            await this.followBlogger(userId).then(result => {
                if (result['code'] == 200) {
                    this.toastError('Theo dõi thành công');
                    this.getDetailBlog(this.id);
                }
            }).catch(e => {
                this.toastError('Bạn cần đăng nhập');
                console.log(e);
            })
        }
    }
};
</script>
