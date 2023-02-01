import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Activate from '../views/Activate.vue'
import ResetPassword from '../views/ResetPassword.vue'
import ForgotPassword from '../views/PasswordForgot.vue'
import AddPastrie from '../views/AddPastrie.vue'
import Profile from '../views/Profile.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [

    {
      path: '/',
      name: 'Home',
      component:Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/account/activate/:token',
      name: 'Activate',
      component:  Activate
    },
    {
      path:'/reset-password/:token',
      name:'ResetPassword',
      component:ResetPassword
    },
    {
      path:'/forgot-password',
      name:'ForgotPassword',
      component:ForgotPassword
    },
    {
      path: '/profile',
      name: 'Profile',
      component: Profile
    },
    {
      path:'/add/pastrie',
      name:'AddPastrie',
      component:AddPastrie
      
    }
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
  ]
})

router.beforeEach(async (to, from, next) => {
  // redirect to login page if not logged in and trying to access a restricted page
  // const publicPages = ['/login', '/register','/account/activate/:token'];
  const publicPages = ['Login', 'Register','Activate','ResetPassword','ForgotPassword'];
  const authRequired = !publicPages.includes(to.name);
  const store = JSON.parse(localStorage.getItem('store'));
  const user = store.user;
  const loggedIn = user && user.token;
  if (authRequired && !loggedIn) {
      return next('/login');
  }
  if (!authRequired && loggedIn) {
      return next('/');
  }
  next();
})
router.afterEach((to) => {
  document.title = to.meta.title;
})
export default router
