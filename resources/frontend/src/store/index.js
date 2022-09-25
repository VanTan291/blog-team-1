import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
Vue.use(Vuex);

import Category from './modules/Category/Category';
import Tag from './modules/Tag/Tag';

export default new Vuex.Store({
    modules: {
        Auth,
        Category,
        Tag,
    }  
});
