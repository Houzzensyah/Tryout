import { createRouter, createWebHistory } from 'vue-router'

import Login from "@/views/Login.vue";
import Register from "@/views/Register.vue";
import HomePage from "@/views/HomePage.vue";
import MyProfile from "@/views/My-profile.vue";
import CreateNewPost from "@/views/Create-new-post.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/create/post',
      name: 'post',
      component: CreateNewPost,
      meta : {
        requiredAuth : true
      }
    },
    {
      path: '/profile',
      name: 'myProfile',
      component: MyProfile,
      meta : {
        requiredAuth : true
      }
    },
    {
      path: '/',
      name: 'homepage',
      component: HomePage,
      meta : {
        requiredAuth : true
      }
    },
    {
      path: '/login',
      name: 'login',
      component:Login,

    },
    {
      path: '/register',
      name: 'register',
      component: Register,

    },

  ]
})


router.beforeEach((to, from, next) => {
  if(to.matched.some(record=> record.meta.requiredAuth)){
    const token = localStorage.getItem('token')
    if (token){
      next()
    }else {
      next('/login')
    }
  }else {
    next()
  }
})

export default router
