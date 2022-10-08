import api from '../../../configs/api';

export default {
    async getListTags({ commit }, page) {
        const { data } = await api.get('/tags?page=' + page + '&page_size=5');
        if (data.data) {
            commit('TAGS', data);
        }
    },

    async storeTag({commit}, parameter) {
        let formData = new FormData();
        formData.append('status', parameter.status ? 1 : 0);
        formData.append('name', parameter.name);

        return await api.post('/tags', formData).then((response) => {
            if (response && response != undefined) {
                commit('ERRORS', null);
                return response
            }
        }).catch((error) => {
            console.log(error.response.data.errors);
            commit('ERRORS', error.response.data.errors);
            return false
        });
    },

    async showTag({commit}, id) {
        return await api.get('/tags/' + id).then((response) => {
            if (response && response != undefined) {
                commit('ERRORS', null);
                return response
            }
        }).catch((error) => {
            console.log(error);
            commit('ERRORS', error.response.data.errors);
            return false
        });
    },

    async updateTag({commit}, parameter) {
        let formData = new FormData();
        formData.append('id', parameter.id);
        formData.append('status', parameter.status ? 1 : 0);
        formData.append('name', parameter.name);

        return await api.put('/tags/' + parameter.id, parameter).then((response) => {
            if (response && response != undefined) {
                commit('ERRORS', null);
                return response
            }
        }).catch((error) => {
            console.log(error);
            commit('ERRORS', error.response.data.errors);
            return false
        });
    },

    async deleteTag({}, id) {
        return await api.delete('/tags/' + id).then((response) => {
            if (response && response != undefined) {
                return response
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    },

    async getListTag({commit}) {
        return await api.get('/listTag').then((response) => {
            if (response && response != undefined) {
                commit("LIST_TAG", response.data);
            }
        }).catch((error) => {
            console.log(error);
            return false
        });
    }
}
