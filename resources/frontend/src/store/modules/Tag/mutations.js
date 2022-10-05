import states from "./state";

export default {
    TAGS(states, tags) {
        states.tags = tags;
    },
    ERRORS(states, errors) {
        states.errors = errors;
    },
     LIST_TAG(states, listTag) {
        states.listTag = listTag;
    },
}
