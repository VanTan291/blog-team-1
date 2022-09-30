<template src="./index.html"></template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../../helper/function';

export default {
    mixins: [utils],
    data() {
        return {
            category: {
                id: null,
                name: '',
                status: true,
            },
            page: 1,
            size: 'small',
        }
    },
    mounted() {
        this.getListCategories(this.page);
    },

    methods: {
        ...mapActions({
            getListCategories: 'Category/getCategories',
            storeCategory: 'Category/storeCategory',
            showCategory: 'Category/showCategory',
            updateCategory: 'Category/updateCategory',
            deleteCategory: 'Category/deleteCategory',
        }),

        async updateOrCreate() {
            if (this.category.id) {
                await this.updateCategory(this.category).then(result => {
                    if (result.data.code == 200) {
                        this.getListCategories(this.page);
                        this.category = {
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
                await this.storeCategory(this.category).then(result => {
                    if (result.data.code == 200) {
                        this.getListCategories(this.page);
                        this.category = {
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

        show(categoryId) {
            this.showCategory(categoryId).then(result => {
                if (result.data.code == 200) {
                    this.category = result.data.data;
                } else {
                    console.log(result);
                }
            }).catch(error => {
                console.log(error.message);
            });
        },

        destroy(category) {
            this.$confirm({
                    message: 'Bạn có chắc chắn muốn xóa?',
                    button: {
                        no: 'Không',
                        yes: 'Đúng'
                    },
                    callback: confirm => {
                        if (confirm) {
                            this.deleteCategory(category).then(result => {
                                if (result.data.code == 200) {
                                    this.getListCategories(this.page);
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
            listCategory: 'Category/getCategories',
            getError: 'Category/getErrors',
            params: 'Category/params',
        })
    },
}
</script>
