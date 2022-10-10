import states from "./state";

export default {
    LIST_BLOG_HOME(state, response) {
        state.listBlogTrend = response.blogTrends;
        state.listBlog = response.blogs.data;
    },
    DETAIL_BLOG(state, response) {
        state.detailBlog = response.data;
        state.listOfRelatedBlogs = response.listOfRelatedBlogs;
    },
    LIST_BOOKMARKS(state, response) {
        state.listBookmarks = response;
    }
};
