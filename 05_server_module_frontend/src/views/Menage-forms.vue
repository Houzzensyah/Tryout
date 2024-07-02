<template>
  <Navbar>

  </Navbar>
  <main>

    <div class="hero py-5 bg-light">
      <div class="container">
        <router-link to="/create/form" class="btn btn-primary">
          Create Form
        </router-link>
      </div>
    </div>

    <div class="list-form py-5">
      <div class="container" >
        <h6 class="mb-3">List Form</h6>
        <a v-for="(form,index) in forms.forms" :key='index'class="card card-default mb-3">
          <div class="card-body" @click="goToCreateQuestion(form.slug)">
            <h5 class="mb-1" >{{form.name}}</h5>
            <small class="text-muted">@{{form.slug}} (limit for 1 response)</small>
          </div>
        </a>

      </div>
    </div>

  </main>

</template>
<script setup>
import Navbar from "@/components/Navbar.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";

const forms = ref([]);

onMounted(() => {
  getData()
})

const router = useRouter();

const goToCreateQuestion = (slug) => {
  router.push({ name: 'DetailForm', params: { slug } });
};
const getData = () => {
  axios.get('http://127.0.0.1:8000/api/v1/forms', {
    headers : {
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((res) =>{
    forms.value = res.data
  }).catch((err) => {
    console.log('itula')
  })
}
</script>