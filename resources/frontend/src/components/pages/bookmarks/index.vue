<template src="./template.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'BookMark',
    data() {
        return {
            param: {
                page: 1,
            },
            size: 'small',
        };
    },
    mounted() {
        this.getListBookmarks(this.param);
    },
    computed: {
        ...mapGetters({
            listBookmarks: 'Home/listBookmarks',
            createBookMark: 'Home/BookMark'
        })
    },
    methods: {
        ...mapActions({
            getListBookmarks: 'Home/getListBookmarks',
        }),

        async bookMark(id) {
            await this.createBookMark(id).then(result => {
                if (result['code'] == 200) {
                    this.getListBookmarks(this.param)
                } else {
                    this.toastError(result.message);
                }
            }).catch(e => {
                this.toastError('đã có lỗi');
                console.log(e);
            })
        }
    }
};
</script>
