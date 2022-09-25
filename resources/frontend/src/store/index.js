import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
Vue.use(Vuex);

import Category from './Category/Category';

import Category from './Category/Category';

export default new Vuex.Store({
    modules: {
        Auth,
        Category
    }
});
