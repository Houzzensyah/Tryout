
import { createRouter, createWebHistory } from 'vue-router'

import AdminDashboard from '../views/Admin/Index.vue'
import UserDashboard from '../views/User/Index.vue'
import Signin from '../views/Signin.vue'
import Signup from '../views/signup.vue'
import Profile from '../views/User/Profile.vue'
import ManageGameFormUpdate from '../views/User/Manage-game-form-update.vue'
import ManageGame from '../views/User/Manage-game.vue'
import ManageGameForm from '../views/User/Manage-game-form.vue'
import DiscoverGames from '../views/User/Discover-games.vue'
import Detail from '../views/User/Detail-game.vue'
import Users from '../views/Admin/User.vue'
import UsersForm from '../views/Admin/Users-form.vue'
import Admin from '../views/Admin/Admins.vue'




const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'UserDashboard',
      component: UserDashboard,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/admin/dashboard',
      name: 'adminDashboard',
      component: AdminDashboard,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/signup',
      name: 'signup',
      component: Signup,

    },
    {
      path: '/signin',
      name: 'signin',
      component: Signin
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/manage/game/form',
      name: 'manage-game-form',
      component: ManageGameForm,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/manage/game',
      name: 'manage-game',
      component: ManageGame,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/manage/game/form/update',
      name: 'manage-game-form-update',
      component: ManageGameFormUpdate,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/discover/game',
      name: 'discover-game',
      component: DiscoverGames,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/detail',
      name: 'detail',
      component: Detail,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/users',
      name: 'users',
      component: Users,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,
      meta: {
        requiresAuth : true
      }
    },
    {
      path: '/user/form/:id',
      name: 'usere',
      component: UsersForm,
      meta: {
        requiresAuth : true
      }
    },


  ]
})

router.beforeEach((to,from)=>{
  if(to.meta.requiresAuth && !localStorage.getItem('token')){
    return {name: 'signin'}

  }
  if(to.meta.requiresAuth ==false && localStorage.getItem('token')){
    return {name: 'UserDashboard'}
  }
})






export default router
