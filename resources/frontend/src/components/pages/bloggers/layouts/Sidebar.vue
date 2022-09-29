<template>
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0">
                <span class="ms-1 font-weight-bold text-white">Quản lý bài viết</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{ name: 'dashboard' }" tag="a" class="nav-link text-white">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Thống kê</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'categories' }" tag="a" class="nav-link text-white">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Danh mục</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'tags' }" tag="a" class="nav-link text-white">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text ms-1">Nhãn</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Bài viết</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white">

                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">notifications</i>
                        </div>

                        <span class="nav-link-text ms-1">Thông báo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'profile' }" tag="a" class="nav-link text-white">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
export default {
    name: 'Sidebar'
}
</script>
<style scoped>
.bg-white {
    background-color: #344767 !important;
}
</style>
