import Layout from '../components/layouts/App.vue';
import Home from '../components/pages/home';
import Profile from '../components/pages/profile';
import Login from '../components/pages/auth/login.vue';
import Register from '../components/pages/auth/register/register.vue';

const routes = [
  {
    path: '',
    component: Layout,
    children: [
      {
        path: '',
        component: Home,
        name: 'home',
      },
      {
        path: '/profile',
        component: Profile,
        name: 'profile',
      },

    ]
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
  },
  {
    path: '/register',
    component: Register,
    name: 'register',
  },
];

export default routes;
