import states from "./state";

export default {
    LIST_BLOG_HOME(state, response) {
        state.listBlogTrend = response.blogTrends;
        state.listBlog = response.blogs.data;
    },
};
