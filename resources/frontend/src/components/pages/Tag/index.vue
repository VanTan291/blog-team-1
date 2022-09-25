<template>
    <div class="container mt-5 bg-light p-2">
        <div class="row">
            <div class="col">
                <form class="bg-white p-2 rounded-cs d-flex flex-column" @submit.prevent="updateOrCreate">
                    <div class="row">
                        <div v-if="getError">
                            <div v-for="error in getError">
                                <small id="passwordHelp" class="text-danger">
                                    {{ error[0] }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <input type="text" v-model="tag.name" class="form-control"
                                    placeholder="Tên Danh Mục">
                                <input type="hidden" v-model="tag.id">
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" v-model="tag.status"
                            v-bind:id="tag.status">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Trạng thái</label>
                    </div>
                    <button type="submit" class="btn bg-gradient-info w-auto me-2 align-self-end" v-if="tag.id">
                        <span class="btn-inner--text">Cập nhật</span>
                    </button>
                    <button type="submit" class="btn-slack btn btn-icon align-self-end" v-else>
                        <span class="btn-inner--text">Thêm mới</span>
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
                                        Tên Tag</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trạng Thái</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tag in listTags.data" :key="tag.id">
                                    <td>
                                        <div class=" px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0">{{ tag.name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm">
                                        <span class="badge" :class="tag.status ? 'bg-success' : 'bg-gradient-danger'">
                                            {{ tag.status ? 'ACTIVE' : 'INACTIVE' }}</span>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-facebook my-0 mx-1 p-2 f-item"
                                            @click="show(tag.id)">
                                            <span class="btn-inner--text">Sửa</span>
                                        </button>
                                        <button type="button" class="btn btn-youtube my-0 mx-1 p-2 f-item"
                                            @click="destroy(tag.id)">
                                            <span class="btn-inner--text">Xóa</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-5 d-flex justify-content-center">
                            <pagination :data="listTags" :size="size" @pagination-change-page="getTags"
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
