import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Notfound from "@/views/Notfound.vue";
import Signin from "@/views/Signin.vue";
import Signup from "@/views/Signup.vue";
import UserDashboard from "@/views/User/UserDashboard.vue";
import AdminDashboard from "@/views/Admin/AdminDashboard.vue";
import Admin from "@/views/Admin/Admin.vue";
import User from "@/views/Admin/User.vue";
import UsersForm from "@/views/Admin/Users-form.vue";
import UserFormUpdate from "@/views/Admin/User-form-update.vue";
import Forbidden from "@/views/Forbidden.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'userDashboard',
      component: UserDashboard,
      meta : {requiresAuth: true
      }
    },
    {
      path: '/admin/dashboard',
      name: '/admin/dashboard',
      component: AdminDashboard,

      meta : {
        requiresAuth: true, requiresAdmin: true
      }

    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,

      meta : {
        requiresAuth: true, requiresAdmin: true
      }

    },
    {
      path: '/user',
      name: 'user',
      component: User,

      meta : {
        requiresAuth: true, requiresAdmin: true
      }

    },
    {
      path: '/user/form',
      name: 'user-form',
      component: UsersForm,

      meta : {
        requiresAuth: true, requiresAdmin: true
      }

    },
    {
      path: '/user/form/:id',
      name: 'useredit',
      component: UserFormUpdate,

      meta : {
        requiresAuth: true, requiresAdmin: true
      }

    },

    {
      path : '/signin',
      name : 'signin',
      component : Signin,


    },

    {
      path : '/signup',
      name : 'signup',
      component : Signup
    },
    {
      path : '/forbidden',
      name : 'forbidden',
      component : Forbidden
    },

    {
      path : '/:pathMatch(.*)*',
      name : 'notFound',
      component : Notfound
    }
  ]
})


router.beforeEach((to,from)=>{
  if(to.meta.requiresAuth && !localStorage.getItem('token')){
    return {name: 'signin'}

  }
  if(to.meta.requiresAuth ==false && localStorage.getItem('token')){
    return {name: 'UserDashboard'}
  }


});




export default router
