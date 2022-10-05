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
};
