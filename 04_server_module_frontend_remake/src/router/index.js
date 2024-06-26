import { createRouter, createWebHistory } from 'vue-router'

import AdminDashboard from "@/views/Admin/AdminDashboard.vue";
import Admin from "@/views/Admin/Admin.vue";
import UsersForm from "@/views/Admin/Users-form.vue";
import Users from "@/views/Admin/Users.vue";
import UsersFormUpdate from "@/views/Admin/Users-form-update.vue";
import Signup from "@/views/Signup.vue";
import Signin from "@/views/Signin.vue";
import UserDashboard from "@/views/User/UserDashboard.vue";
import DiscoverGame from "@/views/User/DiscoverGame.vue";
import Notfound from "@/views/Notfound.vue";
import MenageGame from "@/views/User/Menage-game.vue";
import MenageGameForm from "@/views/User/Menage-game-form.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: UserDashboard,
      meta: { authNeed : true}
    },
    {
      path: '/discover/game',
      name: 'DiscoverGame',
      component: DiscoverGame,
      meta: { authNeed : true}
    },
    {
      path: '/menage/game',
      name: 'manageGame',
      component: MenageGame,
      meta: { authNeed : true}
    },
    {
      path: '/menage/game/form',
      name: 'MenageGame',
      component: MenageGameForm,
      meta: { authNeed : true}
    },
    {
      path: '/admin/dashboard',
      name: 'AdminDashboard',
      component: AdminDashboard,
      meta: { authNeed : true, isAdmin : true}
    },
    {
      path: '/admin/form',
      name: 'AdminForm',
      component: Admin,
      meta: { authNeed : true, isAdmin : true}
    },
    {
      path: '/users/form',
      name: 'UsersForm',
      component: Users,
      meta: { authNeed : true, isAdmin : true}
    },
    {
      path: '/users/create',
      name: 'UsersCreate',
      component: UsersForm,
      meta: { authNeed : true, isAdmin : true}
    },
    {
      path: '/users/edit/:id',
      name: 'UserEdit',
      component: UsersFormUpdate,
      meta: { authNeed : true, isAdmin : true}
    },
    {
      path: '/signup',
      name: 'Signup',
      component: Signup
    },
    {
      path: '/signin',
      name: 'Signin',
      component: Signin
    },
    {
      path : '/:pathMatch(.*)*',
      name : 'notFound',
      component : Notfound
    }
  ]
});


router.beforeEach((to, from, next)=> {
  const token = localStorage.getItem('token');
  const role = localStorage.getItem('role');
  const isAuth = !!token

  if (isAuth && (to.name === 'Signup' || to.name === 'Signin')) {
    next({name: role === 'admin' ? 'AdminDashboard' : 'Dashboard'});
    return
  }

  if (to.matched.some(record => to.meta.authNeed)) {
    if(!isAuth){
      next({name : 'Signin'})
    return;
  }

  if (to.matched.some(record => to.meta.isAdmin) && role !== 'admin') {
    next({name: 'Dashboard'});
    return;
  }
    }
  next();





});

export default router
