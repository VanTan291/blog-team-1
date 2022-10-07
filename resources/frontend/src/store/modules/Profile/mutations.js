import state from './state'

export default {
    SETUP_SUCCESS (state) {
        state.requestError = null;
    },

    SETUP_FAIL (state, response) {
        state.requestError = response;
    },
}
