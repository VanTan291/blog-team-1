<template src="./index.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../../helper/function';

export default {
    mixins: [utils],
    data() {
        return {
            tag: {
                id: null,
                name: '',
                status: true,
            },
            page: 1,
            size: 'small',
        }
    },
    mounted() {
        this.getTags(this.page);
    },

    methods: {
        ...mapActions({
            getTags: 'Tag/getListTags',
            storeTag: 'Tag/storeTag',
            showTag: 'Tag/showTag',
            updateTag: 'Tag/updateTag',
            deleteTag: 'Tag/deleteTag',
        }),

        async updateOrCreate() {
            if (this.tag.id) {
                await this.updateTag(this.tag).then(result => {
                    if (result.data.code == 200) {
                        this.getTags(this.page);
                        this.tag = {
                            name: '',
                            status: true,
                        }
                        this.toastSuccess('Cập nhật thành công');
                    } else {
                        this.toastSuccess('Cập nhật thất bại');
                        this.errors = result;
                        console.log(result);
                    }
                }).catch(error => {
                    console.log(error.message);
                });
            } else {
                await this.storeTag(this.tag).then(result => {
                    if (result.data.code == 200) {
                        this.getTags(this.page);
                        this.tag = {
                            name: '',
                            status: true,
                        }
                        this.toastSuccess('Tạo mới thành công');
                    } else {
                        this.toastSuccess('Tạo mới thất bại');
                        console.log(result);
                    }
                }).catch(error => {
                    console.log(error.message);
                });
            }
        },

        show(tagId) {
            this.showTag(tagId).then(result => {
                if (result.data.code == 200) {
                    this.tag = result.data.data;
                } else {
                    console.log(result);
                }
            }).catch(error => {
                console.log(error.message);
            });
        },

        destroy(tag) {
            this.$confirm({
                    message: 'Bạn có chắc chắn muốn xóa?',
                    button: {
                        no: 'Không',
                        yes: 'Đúng'
                    },
                    callback: confirm => {
                        if (confirm) {
                            this.deleteTag(tag).then(result => {
                                if (result.data.code == 200) {
                                    this.getTags(this.page);
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
    },

    computed: {
        ...mapGetters({
            listTags: 'Tag/getListTags',
            getError: 'Tag/getErrors',
        })
    },
}
</script>
