<template>
    <div class="container mt-5 bg-light p-2">
        <div class="row">
            <div class="col">
                <form class="bg-white p-2 rounded-cs d-flex flex-column" @submit.prevent="updateOrCreate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="text" v-model="category.name" class="form-control"
                                    placeholder="category name">
                                <input type="hidden" v-model="category.id">
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" v-model="category.status"
                            v-bind:id="category.status">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                    </div>
                    <button type="submit" class="btn-slack btn btn-icon align-self-end">
                        <span class="btn-inner--text">add new</span>
                    </button>
                </form>
            </div>
            <div class="col">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        category name</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cate in listCategory.data" :key="cate.id">
                                    <td>
                                        <div class=" px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0">{{ cate.name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm">
                                        <span class="badge" :class="cate.status ? 'bg-success' : 'bg-gradient-danger'">
                                            {{ cate.status ? 'ACTIVE' : 'INACTIVE' }}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-facebook my-0 mx-1 p-2 f-item"
                                            @click="show(cate.id)">
                                            <span class="btn-inner--text">edit</span>
                                        </button>
                                        <button type="button" class="btn btn-youtube my-0 mx-1 p-2 f-item">
                                            <span class="btn-inner--text">delete</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-5 d-flex justify-content-center">
                            <pagination :data="listCategory" :size="size" @pagination-change-page="getListCategories"
                                :limit="1"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { utils } from '../../../helper/function';

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
                        this.toastSuccess('Update category success');
                    } else {
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
                        this.toastSuccess('Create category success');
                    } else {
                        console.log(result);
                    }
                }).catch(error => {
                    console.log(error.message);
                });
            }
        },

        // async createCategory() {
        //     await this.storeCategory(this.category).then(result => {
        //         if (result.data.code == 200) {
        //             this.getListCategories(this.page);
        //             this.category = {
        //                 name: '',
        //                 status: true,
        //             }
        //             this.toastSuccess('Create category success');
        //         } else {
        //             console.log(result);
        //         }
        //     }).catch(error => {
        //         console.log(error.message);
        //     });
        // },

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

        // async updateCategory() {
        //     await this.updateCategory(this.category).then(result => {
        //         if (result.data.code == 200) {
        //             this.getListCategories(this.page);
        //             this.category = {
        //                 name: '',
        //                 status: true,
        //             }
        //             this.toastSuccess('Update category success');
        //         } else {
        //             console.log(result);
        //         }
        //     }).catch(error => {
        //         console.log(error.message);
        //     });
        // },
    },

    computed: {
        ...mapGetters({
            listCategory: 'Category/getCategories',
        })
    },
}
</script>