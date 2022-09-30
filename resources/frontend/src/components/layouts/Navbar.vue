<template>
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav
          class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3" rel="tooltip" title="Designed and Coded by Creative Tim"
              data-placement="bottom" target="_blank">
                TST
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
              data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-auto" v-on:click="path()">
                <router-link :to="{ name: 'home' }" tag="li" class="nav-item mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" v-bind:class="(urlSegment[1] == '') ? 'activeSidebar' : ''">
                    <i class="material-icons opacity-6 me-2 text-md">import_contacts</i>
                    Bài viết
                  </a>
                </router-link>
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                    Pages
                    <img src="/assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                  </a>
                  <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                    aria-labelledby="dropdownMenuPages">
                    <div class="d-none d-lg-block">
                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                        Landing Pages
                      </h6>
                      <a href="./pages/about-us.html" class="dropdown-item border-radius-md">
                        <span>About Us</span>
                      </a>
                    </div>
                    <div class="d-lg-none">
                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                        Landing Pages sss
                      </h6>
                      <a href="./pages/about-us.html" class="dropdown-item border-radius-md">
                        <span>About Us</span>
                      </a>
                    </div>
                  </div>
                </li>
                <router-link :to="{ name: 'profile' }" tag="li" class="nav-item mx-2" v-if="$store.state.isLogin">
                  <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuProfile"
                      data-bs-toggle="dropdown" aria-expanded="false"
                      v-bind:class="(urlSegment[1] == 'profile') ? 'activeSidebar' : ''">
                        <i class="material-icons opacity-6 me-2 text-md">assignment_ind</i>
                        Profile
                        <img src="/assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                        aria-labelledby="dropdownMenuProfile">
                        <!-- <div class="d-none d-lg-block">
                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                Setup profile
                            </h6> -->
                            <router-link :to="{ name: 'profile' }" class="dropdown-item border-radius-md">
                                <span>My profile</span>
                            </router-link>
                            <router-link :to="{ name: 'setupProfile' }" class="dropdown-item border-radius-md">
                                <span>Set up profile</span>
                            </router-link>
                        <!-- </div>
                        <div class="d-lg-none">
                            <a href="" class="dropdown-item border-radius-md">
                                <span>Set up profile</span>
                            </a>
                        </div> -->
                    </div>
                  </li>
                </router-link>
                <li tag="li" class="nav-item mx-2" v-if="$store.state.isLogin">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center"  @click="onLogout">
                    <i class="material-icons opacity-6 me-2 text-md">power_settings_new</i>
                    Đăng xuất
                  </a>
                </li>
                <router-link :to="{ name: 'login' }" tag="li" class="nav-item mx-2" v-else>
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" v-bind:class="(urlSegment[1] == 'login') ? 'activeSidebar' : ''">
                    <i class="material-icons opacity-6 me-2 text-md">fingerprint</i>
                    Đăng nhập
                  </a>
                </router-link>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import {utils} from '../../helper/function'

export default {
  name: 'Navbar',
  mixins: [utils],
  data() {
    return {
      urlSegment: '',
    }
  },
  mounted() {
    this.path();
  },
   methods: {
    ...mapActions({
        logoutAuth: 'Auth/logout'
    }),
    path() {
      this.urlSegment = (new URL(window.location.href)).pathname.split('/');
      return this.urlSegment;
    },
    async onLogout() {
        await this.logoutAuth().then(result => {
            if (result.code = 200) {
                this.toastSuccess(result.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.log(error);
        })
    }
  },
}
</script>

<style>
  .activeSidebar {
    color: mediumblue !important;
  }
</style>
