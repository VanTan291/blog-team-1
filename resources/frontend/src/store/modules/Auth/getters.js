import state from "./state";

export default {
    errorRegister: state => state.errorRegister,
    errorRequest: state => state.errorRequest,
    errorLogin: state => state.errorLogin,
    params: state => state.params,
    token: state => state.token,
}
