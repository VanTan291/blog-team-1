window.Vue = require("vue");

import Vue from 'vue'
import VueRouter from 'vue-router';
import store from "./store";
import router from "./router";
import App from './App.vue'

// use
Vue.use(VueRouter);
Vue.config.productionTip = false
Vue.component('app', App);
Vue.component('pagination', require('laravel-vue-pagination'));
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

Vue.use(Toast);
const app = new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App),
});
