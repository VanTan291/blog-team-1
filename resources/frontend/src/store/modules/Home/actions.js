import api from '../../../configs/api';

export default {
    async getListBlogHome({ commit }, params) {
        return await api
            .get(`list-blog-home?page=${params.page}`)
            .then((response) => {
                if (response && response != undefined) {
                    commit("LIST_BLOG_HOME", response);
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async getDetailBlog({ commit }, id) {
        return await api
            .get(`detail-blog/${id}`)
            .then((response) => {
                if (response && response != undefined) {
                    commit("DETAIL_BLOG", response);
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async getListBookmarks({ commit }, params) {
        return await api
            .get(`list-bookmarks?page=${params.page}`)
            .then((response) => {
                if (response && response != undefined) {
                    commit("LIST_BOOKMARKS", response.data);
                }
            })
            .catch((error) => {
                console.log(error);
                return false;
            });
    },

    async BookMark ({}, id) {
        return await api.get(`book-mark/${id}`).then(result => {
            return result;
        }).catch(e => {
            console.log(e);
        })
    }
};
