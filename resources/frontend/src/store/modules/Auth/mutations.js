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

    VERIFY_SUCCESS (state) {
        state.errorRequest = null;
    }
}
