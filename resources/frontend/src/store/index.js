import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
Vue.use(Vuex);

import Category from './modules/Category/Category';

export default new Vuex.Store({
    modules: {
        Auth,
        Category
    }  
});
