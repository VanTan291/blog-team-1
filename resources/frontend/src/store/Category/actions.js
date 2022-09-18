import api from '../../configs/api';

export default {
    async getCategories({ commit }, page) {
        const { data } = await api.get('/categories?page=' + page + '&page_size=5');
        if (data.data.data) {
            commit('CATEGORIES', data.data);
        }
    },

    async storeCategory({}, parameter) {
        let formData = new FormData();
        formData.append('status', parameter.status ? 1 : 0); 
        formData.append('name', parameter.name);

        return await api.post('/categories', formData).then((response) => {
            if (response && response != undefined) {
                return response
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    },

    async showCategory({}, id) {
        return await api.get('/categories/' + id).then((response) => {
            if (response && response != undefined) {
                return response
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    },

    async updateCategory({}, parameter) {
        let formData = new FormData();
        formData.append('id', parameter.id);
        formData.append('status', parameter.status ? 1 : 0); 
        formData.append('name', parameter.name);

        return await api.put('/categories/' + parameter.id, parameter).then((response) => {
            if (response && response != undefined) {
                return response
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    }
}