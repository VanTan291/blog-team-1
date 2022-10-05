import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
import Category from './modules/Category/Category';
import Tag from './modules/Tag/Tag';
import Blog from './modules/Blog/Blog'

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        isLogin: localStorage.getItem("_token") ? true : false,
    },
    modules: {
        Auth,
        Category,
        Tag,
        Blog,
    },
});
