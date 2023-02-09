import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Activate from '../views/Activate.vue'
import ResetPassword from '../views/ResetPassword.vue'
import ForgotPassword from '../views/PasswordForgot.vue'
import MasterClassList from '../views/masterClass/MasterClassList.vue'
import PastryChefMasterClass from '../views/masterClass/PastryChefMasterClassesList.vue'
import MasterClassDetails from '../views/masterClass/MasterClassDetails.vue'
import AddMasterClass from '../views/masterClass/AddMasterClass.vue'
import AddPastrie from '../views/AddPastrie.vue'
import Cart from '../views/Cart.vue'
import Profile from '../views/Profile.vue'
import Pastries from '../views/Pastries.vue'


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
      path: '/masterclass',
      name: 'MasterClassList',
      component: MasterClassList
    },
    {
      path: '/my_masterclasses',
      name: 'PastryChefMasterClass',
      component: PastryChefMasterClass
    },
    {
      path: '/add/masterclass',
      name: 'AddMasterClass',
      component: AddMasterClass
    },
    {
      path: '/masterclass/:id',
      name: 'MasterClassDetails',
      component: MasterClassDetails

    },
    {
      path:'/add/pastrie',
      name:'AddPastrie',
      component:AddPastrie
      
    },
    {
      path: '/pastries',
      name: 'Pastries',
      component: Pastries
    },
    {
      path: '/cart',
      name: 'Cart',
      component: Cart
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
  const publicPages = ['Login', 'Register','Activate','ResetPassword','ForgotPassword','Home','Pastries','MasterClassList','MasterClassDetails'];

  const authRequired = !publicPages.includes(to.name);
  const store = JSON.parse(localStorage.getItem('store'));
  const user = store.user;
  const loggedIn = user && user.token;
  if (authRequired && !loggedIn) {
      return next('/login');
  }
  // if (!authRequired && loggedIn) {
  //     return next(to.name==='Home');
  // }
  next();
})
router.afterEach((to) => {
  document.title = to.meta.name;
})
export default router
