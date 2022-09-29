import Layout from '../components/layouts/App.vue';
import Home from '../components/pages/home';
import Profile from '../components/pages/profile';
import Login from '../components/pages/auth/login/login.vue';
import Register from '../components/pages/auth/register/register.vue';
import Verify from '../components/pages/auth/verify/index.vue';
import Category from '../components/pages/bloggers/category';
import Tag from '../components/pages/bloggers/tag';
import Blogger from '../components/pages/bloggers/layouts/App.vue';
import Dashboard from '../components/pages/bloggers/dashboard';

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
  {
    path: '',
    component: Blogger,
    meta: { requiresAuth: true },
    children: [
      {
        path: '/blogger/dashboard',
        component: Dashboard,
        name: 'dashboard',
      },
      {
        path: '/blogger/categories',
        component: Category,
        name: 'categories',
      },
      {
        path: '/blogger/tags',
        component: Tag,
        name: 'tags',
      },
    ]
  },
];

export default routes;
