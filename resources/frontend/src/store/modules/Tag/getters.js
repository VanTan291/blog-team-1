import state from "./state";

export default {
    getListTags: (state) => state.tags,
    getErrors: (state) => state.errors,
    listTag: (state) => state.listTag,
};
