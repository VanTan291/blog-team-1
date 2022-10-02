window.Vue = require("vue");

import Vue from 'vue';
import VueRouter from 'vue-router';
import store from "./store";
import router from "./router";
import App from './App.vue';
import Notifications from 'vue-notification';
import VueConfirmDialog from 'vue-confirm-dialog';
import Multiselect from 'vue-multiselect';
import CKEditor from "@ckeditor/ckeditor5-vue2";

// use
Vue.use(Notifications);
Vue.use(VueRouter);
Vue.use(VueConfirmDialog);
Vue.use(CKEditor);
Vue.config.productionTip = false;
Vue.component('app', App);
// register globally
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)
Vue.component('multiselect', Multiselect)

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import "vue-multiselect/dist/vue-multiselect.min.css";

Vue.use(Toast);
const app = new Vue({
  el: "#app",
  router,
  store,
  render: h => h(App),
});
