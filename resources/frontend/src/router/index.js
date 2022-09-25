import Vue from 'vue'
import VueRouter from 'vue-router';
import routes from './router.js';

Vue.use(VueRouter);

function loggedIn() {
    return localStorage.getItem('token');
}

const router = new VueRouter({
    routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    mode: 'history',
})

router.beforeEach(async (to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth) && loggedIn() == null) {
      next('/login');
    } else if (!loggedIn()) {
      switch (to.path) {
        case 'login' || 'register':
          next({ path: '/login' });
          break;
        default:
          next();
          break;
      }
    } else next();
});

export default router;
