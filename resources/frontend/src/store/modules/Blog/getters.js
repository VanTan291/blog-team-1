import state from "./state";

export default {
    params: (state) => state.params,
    listSeries: (state) => state.listSeries,
    errorRequest: (state) => state.errorRequest,
    blogs: (state) => state.blogs,
};
