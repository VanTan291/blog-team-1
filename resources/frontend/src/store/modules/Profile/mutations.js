import state from './state'

export default {
    SETUP_SUCCESS (state) {
        state.requestError = null;
    },

    SETUP_FAIL (state, response) {
        state.requestError = response;
    },
    GET_SUCCESS (state, response) {
        state.params = response.dataProfile;
        state.params.avatar =  response.dataUser.avatar;
        state.params.name =  response.dataUser.name;
        state.params.phone =  response.dataUser.phone;
        state.params.number_blog =  response.dataUser.number_blog;
        state.params.followers =  response.dataUser.followers;
        state.params.following =  response.dataUser.following;
    }
}
