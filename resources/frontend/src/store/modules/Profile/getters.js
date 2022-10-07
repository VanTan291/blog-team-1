import state from "./state";

export default {
    params: state => state.params,
    requestError: state => state.requestError,
}
