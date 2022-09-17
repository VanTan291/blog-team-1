<template>
    <div class="container mt-5 bg-light p-2">
        <div class="row">
            <div class="col">
                <form class="bg-white p-2 rounded-cs d-flex flex-column">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="email" class="form-control" placeholder="category name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-slack btn btn-icon align-self-end">
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
                                <tr v-for="categories in category" :key="category.id">
                                    <td>
                                        <div class=" px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0">{{ category.name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm">
                                        <span class="badge bg-success">{{ category.status }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'CategoryComponent',

    data() {
        return {
            //
        }
    },
    mounted() {
        this.getListCategories();
    },

    methods: {
        ...mapActions({
            getListCategories: 'Category/getCategories',
        }),
    },
    computed: {
        ...mapGetters({
            categories: 'Category/getCategories',
        })
    },
}
</script>