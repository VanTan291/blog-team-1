import api from '../../../configs/api';

export default {
    async getListSeries({ commit }) {
        return await api
            .get("/listSeries")
            .then((response) => {
                if (response && response != undefined) {
                    commit("LIST_SERIES", response.data);
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async store({ commit }, params) {
        let formData = new FormData();
        formData.append('series', params.series ?? '');
        formData.append('category', params.category ? params.category.id : '');
        formData.append('tags', JSON.stringify(params.tag));
        formData.append('title', params.title ?? '');
        formData.append('content', params.content ?? '');
        formData.append('thumbnail', params.thumbnail ?? '');

        return await api
            .post('blogs', formData)
            .then((response) => {
                if (response && response != undefined) {
                    commit("ERRORS", null);
                }

                return response;
            })
            .catch((error) => {
                commit('ERRORS', error.response.data);
            });
    },
};
