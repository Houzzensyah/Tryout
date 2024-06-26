<template>
  <main>
    <section class="login">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-center mb-4">Gaming Portal</h1>
            <div class="card card-default">
              <div class="card-body">
                <h3 class="mb-3">Sign In</h3>

                <div v-if="errors.length" class="alert alert-danger" role="alert">
                  <ul>
                    <li v-for="(error, index) in errors" :key="index">
                      <strong>{{ error.field }}</strong>: {{ error.message }}
                    </li>
                  </ul>
                </div>


                <form @submit.prevent="signin">
                  <!-- s: input -->
                  <div class="form-group my-3">
                    <label for="username" class="mb-1 text-muted">Username</label>
                    <input type="text" id="username" name="username" v-model="username"  value="" class="form-control" required autofocus />
                  </div>

                  <!-- s: input -->
                  <div class="form-group my-3">
                    <label for="password" class="mb-1 text-muted">Password</label>
                    <input type="password" id="password" name="password" v-model="password"  value="" required class="form-control" />
                  </div>

                  <div class="mt-4 row">
                    <div class="col">
                      <button type="submit" class="btn btn-primary w-100">Sign In</button>
                    </div>
                    <div class="col">
                      <router-link to="/signup" class="btn btn-danger w-100">Sign up</router-link>
                    </div>

                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
<script setup >


import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

const username = ref('');
const password = ref('')
const errors = ref([]);
const router = useRouter();


  const signin = () => {
  axios.post('http://127.0.0.1:8000/api/v1/auth/signin',{
    username : username.value,
    password : password.value
  }).then((response) => {
    const {token, role} = response.data;
    localStorage.setItem('token', token);
    localStorage.setItem('role', role);

    if(role === 'admin'){
      router.push('/admin/dashboard')
    }else{
      router.push('/')
    }
  }).catch(err => {
    errorMes(err)
  })



  function errorMes(error){
    errors.value = error.response?.data?.violations
    ? Object.entries(error.response.data.violations).map(([field, {message}])=>({field,message}))
        :[{field : 'errors' , message: error.response?.data?.message}]
  }
}
</script>