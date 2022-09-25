import state from './state'

export default {
    REGISTER_SUCCESS (state) {
        state.errorRequest = null;
    },

    REGISTER_FAIL (state, response) {
        state.errorRegister = response;
        state.errorRequest = null;
    },

    REQUEST_FAIL (state, response) {
        state.errorRequest = response;
        state.errorRegister = null;
    },

    AUTH_TOKEN(state, token) {
        state.token = token
    },

    LOGIN_FAIL(state, response) {
        state.errorLogin = response;
    },
    VERIFY_SUCCESS (state) {
        state.errorRequest = null;
    },
}
