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

    async getListBlog({ commit }, params) {
        return await api
            .get(`blogs?page=${params.page}`)
            .then((response) => {
                if (response && response != undefined) {
                    commit("LIST_BLOG", response.data);
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async store({ commit }, params) {
        let formData = new FormData();
        formData.append("series", params.series ?? "");
        formData.append("category", params.category ? params.category.id : "");
        formData.append("tags", JSON.stringify(params.tag));
        formData.append("title", params.title ?? "");
        formData.append("content", params.content ?? "");
        formData.append("thumbnail", params.thumbnail ?? "");
        formData.append("description", params.description ?? "");

        return await api
            .post("blogs", formData)
            .then((response) => {
                if (response && response != undefined) {
                    commit("ERRORS", null);
                }

                return response;
            })
            .catch((error) => {
                commit("ERRORS", error.response.data);
            });
    },

    async deleteBlog({}, id) {
        return await api
            .delete("/blogs/" + id)
            .then((response) => {
                if (response && response != undefined) {
                    return response;
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async edit({commit}, id) {
        console.log(id);
        return await api.get('blogs/' + id)
        .then((response) => {
            if (response && response != undefined) {
                console.log(response.data)
                commit('EDIT', response.data)
                return response;
            }
        })
        .catch((error) => {
            console.log(error);
            return false;
        });
    },

    async update({ commit }, params) {
        console.log(params);
        let formData = new FormData();
        formData.append('Update', true);
        formData.append("series", params.series ?? "");
        formData.append("category", params.category ? params.category.id : "");
        formData.append("tags", JSON.stringify(params.tag));
        formData.append("title", params.title ?? "");
        formData.append("content", params.content ?? "");
        formData.append("thumbnail", params.thumbnail ?? "");
        formData.append("description", params.description ?? "");

        return await api.post('/update-blog/' + params.id, formData)
            .then((response) => {
                if (response && response != undefined) {
                    commit("ERRORS", null);
                }

                return response;
            })
            .catch((error) => {
                commit("ERRORS", error.response.data);
            });
    },
};
