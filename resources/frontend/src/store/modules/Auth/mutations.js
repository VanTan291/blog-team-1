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

    LOGIN_SUCCESS(state, response) {
        state.errorRequest = null;
    },

    LOGIN_FAIL(state, response) {
        console.log(response);
        state.errorLogin = response;
    },
    VERIFY_SUCCESS (state) {
        state.errorRequest = null;
    }
}
