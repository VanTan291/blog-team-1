import Layout from '../components/layouts/App.vue';
import Home from '../components/pages/home';
import Profile from '../components/pages/profile';
import Login from '../components/pages/auth/login.vue';
import Category from '../components/pages/Category/index.vue';

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
      {
        path: '/category',
        component: Category,
        name: 'category',
      },
    ]
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
  },
];

export default routes;
