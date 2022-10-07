import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
import Category from './modules/Category/Category';
import Tag from './modules/Tag/Tag';
import Profile from './modules/Profile/Profile';

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        isLogin: localStorage.getItem('_token') ? true : false,
    },
    modules: {
        Auth,
        Category,
        Tag,
        Profile,
    }
});
