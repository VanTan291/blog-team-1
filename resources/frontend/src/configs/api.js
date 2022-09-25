import axios from 'axios';
import router from '../router';
import authState from '../store/modules/Auth/state';

const initialState = {
    isAuthenticated: false,
};

const api = axios.create({
    'baseURL': PageUrl + '/api/',
    headers: {
        Accept: 'application/json',
    }
});

api.interceptors.request.use(function (config) {
    config.headers.Authorization = authState.token ? `Bearer ${authState.token}` : '';
    return config;
});

api.interceptors.response.use(function (response) {
    return response.data
}, function (error) {
    switch (error.response.status) {
        case 401:
            this.$router.push({ name: 'home' })
            break;
    }
    return Promise.reject(error);
});

export default api;
