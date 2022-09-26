import api from "../../../configs/api";

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

                return response;
            })
            .catch((error) => {
                commit('REQUEST_FAIL', error.response.data);
            })
    },

    async login({ commit }, params) {
        return await api.post('login', params)
            .then(response => {
                if (response && response != undefined) {
                    localStorage.setItem('_token', response.token);
                }

                return response;
            })
            .catch((error) => {
                console.log(error);
                commit('LOGIN_FAIL', error.response.data);
            })
    },

    async verify({ commit }, params) {
        let formData = new FormData();
        formData.append('email', params.email ?? '');
        formData.append('code', params.code ?? '');

        return await api.post('verify-email', formData)
            .then(response => {
                if (response && response != undefined) {
                    localStorage.setItem('_token', response.token);
                }

                return response;
            })
            .catch((error) => {
                commit('REQUEST_FAIL', error.response.data);
            })
    },

    async reSendVerifyEmail({ commit }, params) {
        let formData = new FormData();
        formData.append('email', params.email ?? '');

        return await api.post('re-send-verify-email', formData)
            .then(response => {
                if (response && response != undefined) {
                    commit('VERIFY_SUCCESS', response.data);
                }

                return response.data;
            })
            .catch((error) => {
                commit('REQUEST_FAIL', error.response.data);
            })
    },

    async logout({ commit }) {
        return await api.get('logout')
            .then(response => {
                if (response && response != undefined) {
                    localStorage.removeItem('_token');
                }

                return response;
            })
            .catch((error) => {
                console.log(error);
                commit('LOGIN_FAIL', error.response.data);
            })
    },
};
