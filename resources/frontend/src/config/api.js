import axios from 'axios';
// import router from '../router';

const api = axios.create({
    'baseURL': PageUrl + '/api/',
    headers: {
        Accept: 'application/json',
    }
});

export default api;
