<template>
    <div class="container mt-5 bg-light p-2">
        <div class="row">
            <div class="col">
                <form class="bg-white p-2 rounded-cs d-flex flex-column" @submit.prevent="createCategory">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="text" v-model="category.name" class="form-control" placeholder="category name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="text" v-model="category.status" class="form-control">
                            </div>
                        </div>
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
                                        <span class="badge bg-success">{{ cate.status }}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-facebook my-0 mx-1 p-2 f-item">
                                            <span class="btn-inner--text">edit</span>
                                        </button>
                                        <button type="button" class="btn btn-youtube my-0 mx-1 p-2 f-item">
                                            <span class="btn-inner--text">delete</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :data="listCategory" @pagination-change-page="getListCategories"></pagination>
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
                name: '',
                status: '',
            },
            page: 1,
        }
    },
    mounted() {
        this.getListCategories(this.page);
    },

    methods: {
        ...mapActions({
            getListCategories: 'Category/getCategories',
            storeCategory: 'Category/storeCategory',
        }),

        createCategory() {
            this.storeCategory(this.category).then(result => {
                if(result.data.code == 200) {
                    this.getListCategories(this.page);
                    this.toastSuccess('Create category success');
                }else{
                    console.log(result);
                }
            }).catch(error => {
                console.log(error.message);
            });
        }
    },
    computed: {
        ...mapGetters({
            listCategory: 'Category/getCategories',
        })
    },
}
</script>