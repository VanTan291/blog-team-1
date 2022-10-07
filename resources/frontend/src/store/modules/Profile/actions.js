import api from "../../../configs/api";

export default {
    async setupProfile({ commit }, params) {

        return await api.post('setup-profile', params)
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
};
