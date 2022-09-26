import Layout from '../components/layouts/App.vue';
import Home from '../components/pages/home';
import Profile from '../components/pages/profile';
import Login from '../components/pages/auth/login/login.vue';
import Register from '../components/pages/auth/register/register.vue';
import Verify from '../components/pages/auth/verify/index.vue';
import Category from '../components/pages/Category/index.vue';
import Tag from '../components/pages/Tag/index.vue';

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
        meta: { requiresAuth: true }
      },
      {
        path: '/category',
        component: Category,
        name: 'category',
        meta: { requiresAuth: true }
      },
      {
        path: '/tags',
        component: Tag,
        name: 'tags',
        meta: { requiresAuth: true }
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
  {
    path: '/verify',
    component: Verify,
    name: 'verify',
  },
];

export default routes;
