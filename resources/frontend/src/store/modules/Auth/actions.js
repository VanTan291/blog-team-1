import api from "../../../config/api";

export default {
    async register({ commit }, params) {
        let formData = new FormData();
        formData.append('name', params.name ?? '');
        formData.append('email', params.email ?? '');
        formData.append('password', params.password ?? '');
        formData.append('password_confirmation', params.password_confirmation ?? '');

        return await api.post('register', formData)
            .then(response => {
                if (response && response != undefined) {
                    commit('REGISTER_SUCCESS', response.data);
                }

                return response.data;
            })
            .catch((error) => {
                commit('REQUEST_FAIL', error.response.data);
            })
    },

    async login({ commit }, params) {
        return await api.post('register', params)
            .then(response => {
                if (response && response != undefined) {
                    commit('LOGIN_SUCCESS', response.data);
                }
            })
    }
};
