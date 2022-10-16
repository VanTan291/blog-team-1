import states from "./state";

export default {
    LIST_SERIES(states, listSeries) {
        states.listSeries = listSeries;
    },

    SUCCESS(state) {
        state.errorRequest = null;
    },

    ERRORS(state, response) {
        state.errorRequest = response;
    },

    LIST_BLOG(state, response) {
        state.blogs = response;
    },

    EDIT(state, response) {
        state.params = response;
    }
};
