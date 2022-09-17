import api from '../../configs/api';

export default {
    async getCategories({ commit }) {
        const { data } = await api.get('/categories');
        if (data.data.data) {
            commit('CATEGORIES', data.data);
        }
    },

    async storeCategory({ commit }, parameter) {
        let formData = new FormData();
        formData.append('name', parameter.name);
        formData.append('status', parameter.status);

        return await api.post('/categories', formData).then((response) => {
            if (response && response != undefined) {
                return response
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    }
}