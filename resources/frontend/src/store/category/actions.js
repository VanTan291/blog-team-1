import api from '../../configs/api';

export default {
    async getCategories({ commit }) {
        const { data } = await api.get('/categories');
        commit('CATEGORIES', data);
    }
}