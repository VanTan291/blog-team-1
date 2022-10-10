import api from "../../../configs/api";

export default {
    async setupProfile({ commit }, params) {
        let formData = new FormData();
        console.log(params);
        formData.append('name', params.name ?? '');
        formData.append('avatar', params.avatar ?? '');
        formData.append('email', params.email ?? '');
        formData.append('password', params.password ?? '');
        formData.append('birthday', params.birthday ?? '');
        formData.append('gender', params.gender ?? '');
        formData.append('phone', params.phone ?? '');
        formData.append('address', params.address ?? '');
        formData.append('city', params.city ?? '');
        formData.append('district', params.district ?? '');
        formData.append('wards', params.wards ?? '');
        formData.append('education', params.education ?? '');

        return await api.post('setup-profile', formData)

            .then(response => {
                if (response && response != undefined) {
                    commit('SETUP_SUCCESS', response.data);
                }

                return response;
            })
            .catch((error) => {
                commit('SETUP_FAIL', error.response.data);
            })
    },
    async getProfile({ commit }) {
        return await api.get('get-profile')
            .then(response => {
                console.log(response);
                if (response && response != undefined) {
                    commit('GET_SUCCESS', response);
                }

                return response;
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },
};
