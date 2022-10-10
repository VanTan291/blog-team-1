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
            deleteBlog: 'Blog/deleteBlog'
        }),

        async destroy(id) {
            this.$confirm({
                message: 'Bạn có chắc chắn muốn xóa?',
                button: {
                    no: 'Không',
                    yes: 'Đúng'
                },
                callback: confirm => {
                    if (confirm) {
                        this.deleteBlog(id).then(result => {
                            if (result.code == 200) {
                                this.getListBlog(this.param);
                                this.toastSuccess('Xóa thành công');
                            } else {
                                this.toastSuccess('Xóa thất bại');
                                console.log(result);
                            }
                        }).catch(error => {
                            console.log(error.message);
                        });
                    }
                }
            }
            )
        }
    }
};
</script>
