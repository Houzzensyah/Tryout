import { createRouter, createWebHistory } from 'vue-router'
import MenageForms from "@/views/Menage-forms.vue";
import CreateForm from "@/views/Create-form.vue";
import DetailForm from "@/views/Detail-form.vue";
import Responses from "@/views/Responses.vue";
import SubmitForm from "@/views/Submit-form.vue";
import Login from "@/views/Login.vue";
import NotFound from "@/views/NotFound.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'MenageForm',
      component: MenageForms,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/create/form',
      name: 'Createform',
      component: CreateForm,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/detail/form/:slug',
      name: 'DetailForm',
      component: DetailForm,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFound,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/responses',
      name: 'response',
      component: Responses,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/submit/form',
      name: 'SubmitForm',
      component: SubmitForm,
      meta : {
        needAuth :true
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },

  ]
})

router.beforeEach((to, from, next)=> {
  const token = localStorage.getItem('token')

  if (to.matched.some(record => record.meta.needAuth)) {
    if (token) {
      next()
    }
    else {
      next('/login')
    }
  }else {
    next()
  }



})

export default router
