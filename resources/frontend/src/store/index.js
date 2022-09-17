import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import Category from './category/category';

export default new Vuex.Store({
    modules: {
        Category
    }
});
