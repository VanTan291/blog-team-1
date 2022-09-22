import state from './state'

export default {
    REGISTER_SUCCESS(state, response) {
        state.errorRequest = null;
    },

    REGISTER_FAIL(state, response) {
        state.errorRegister = response;
        state.errorRequest = null;
    },

    REQUEST_FAIL(state, response) {
        console.log(response);
        state.errorRequest = response;
        state.errorRegister = null;
    },
}
