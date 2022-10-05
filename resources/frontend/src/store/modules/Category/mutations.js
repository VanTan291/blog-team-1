import states from "./state";

export default {
    CATEGORIES(states, categories) {
        states.categories = categories;
    },
    ERRORS(states, errors) {
        states.errors = errors;
    },
    LIST_CATEGORY(states, listCategory) {
        states.listCategory = listCategory;
    },
};
