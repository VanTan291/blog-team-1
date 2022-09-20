import state from "./state";

export default {
    errorRegister: state => state.errorLogin,
    errorRequest: state => state.errorRequest,
    params: state => state.params,
}
