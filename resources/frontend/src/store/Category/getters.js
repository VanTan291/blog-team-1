import state from "./state";

export default {
    getCategories: state => state.categories,
    getErrors: state => state.errors,
}