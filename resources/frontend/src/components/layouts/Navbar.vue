<template>
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav
          class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3" rel="tooltip" title="Designed and Coded by Creative Tim"
              data-placement="bottom" target="_blank">
              Lâm Văn Tân
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
                    Blog
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
                <router-link :to="{ name: 'profile' }" tag="li" class="nav-item mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" v-bind:class="(urlSegment[1] == 'profile') ? 'activeSidebar' : ''">
                    <i class="material-icons opacity-6 me-2 text-md">assignment_ind</i>
                    Profile
                  </a>
                </router-link>
                <router-link :to="{ name: 'login' }" tag="li" class="nav-item mx-2">
                  <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" v-bind:class="(urlSegment[1] == 'login') ? 'activeSidebar' : ''">
                    Login
                  </a>
                </router-link>
                <li class="nav-item ms-lg-auto">
                  <a class="nav-link nav-link-icon me-2" target="_blank">
                    <i class="fa fa-github me-1"></i>
                    <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip"
                      data-bs-placement="bottom" title="Star us on Github">Github</p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  data() {
    return {
      urlSegment: '',
    }
  },
  methods: {
    path() {
      this.urlSegment = (new URL(window.location.href)).pathname.split('/');
      return this.urlSegment;
    },
  },
  mounted() {
    this.path();
  }
}
</script>

<style>
  .activeSidebar {
    color: mediumblue !important;
  }
</style>
