import state from "./state";

export default {
    params: state => state.params,
    RequestError: state => state.requestError,
}
