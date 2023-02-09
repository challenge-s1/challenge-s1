import { createRouter, createWebHistory } from 'vue-router'
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, computed, ref } from 'vue';
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Activate from '../views/Activate.vue'
import ResetPassword from '../views/ResetPassword.vue'
import ForgotPassword from '../views/PasswordForgot.vue'
import MasterClassList from '../views/masterClass/MasterClassList.vue'
import AddPastrie from '../views/AddPastrie.vue'
import Cart from '../views/Cart.vue'
import Profile from '../views/Profile.vue'
import Pastries from '../views/Pastries.vue'
import MyPastries from '../views/MyPastries/Mypastries.vue'
import AddPastries from '../views/MyPastries/AddPastries.vue'
import Categories from '../views/Admin/category/Categories.vue'
import Dashbord from '../views/Admin/Dashbord.vue'
import { useStore } from 'vuex';




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
      component: Profile,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/masterclass',
      name: 'MasterClassList',
      component: MasterClassList,
      meta: {
        requiresAuth: true
      }
    },
    {
      path:'/add/pastrie',
      name:'AddPastrie',
      component:AddPastrie,
      meta: {
        requiresAuth: true
      }
      
    },
    {
      path: '/pastries',
      name: 'Pastries',
      component: Pastries,
    },
    {
      path: '/cart',
      name: 'Cart',
      component: Cart,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/user/mypastries',
      name: 'MyPastries',
      component: MyPastries,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/user/add/pastries',
      name: 'AddPastries',
      component: AddPastries,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin/dashbord',
      name: 'Dashbord',
      component: Dashbord,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin/categories',
      name: 'Categories',
      component: Categories,
      meta: {
        requiresAuth: true
      }
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
  const publicPages = ['Login', 'Register','Activate','ResetPassword','ForgotPassword','Home','Pastries','MasterClassList'];

  const authRequired = !publicPages.includes(to.name);
  const store = JSON.parse(localStorage.getItem('store'));
  const user = store.user;
  const loggedIn = user && user.token;
  const token = localStorage.getItem('token');
  // console.log(user.token.token);
  // const logout = function () {
  //   localStorage.removeItem('token');
  //   localStorage.removeItem('store');
  //   window.location.reload();
    
  // }
  if (authRequired && !loggedIn) {
      return next('/login');
  }
  // if (to.matched.some(record => record.meta.requiresAuth) && (!token || token.exp < new Date().getTime( )/1000)) {
  //   logout();
  //   next('/login')
  // } else {
  //   next()
  // }
  
  // if (!authRequired && loggedIn) {
  //     return next(to.name==='Home');
  // }
  next();
})
router.afterEach((to) => {
  document.title = to.meta.name;
})
export default router
