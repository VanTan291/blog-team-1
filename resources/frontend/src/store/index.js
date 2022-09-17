import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import Category from './Category/Category';

export default new Vuex.Store({
    modules: {
        Category
    }
});
