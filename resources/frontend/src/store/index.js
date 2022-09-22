import Vue from 'vue';
import Vuex from 'vuex';
import Auth from './modules/Auth/Auth';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Auth,
    }
});
