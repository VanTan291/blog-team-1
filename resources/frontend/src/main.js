window.Vue = require("vue");

import Vue from 'vue'
import VueRouter from 'vue-router';
import store from "./store";
import router from "./router";
import App from './App.vue'
import Notifications from 'vue-notification'

// use
Vue.use(Notifications)
Vue.use(VueRouter);
Vue.config.productionTip = false
Vue.component('app', App);

const app = new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App),
});
