<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
      <a class="navbar-brand m-auto" href="index.html">Facegram</a>
    </div>
  </nav>

  <main class="mt-5">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between bg-transparent py-3">
              <h5 class="mb-0">Login</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="login">
                <div class="mb-2">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" v-model="username" id="username" name="username"/>
                </div>

                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" v-model="password" name="password"/>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                  Login
                </button>
              </form>
            </div>
          </div>

          <div class="text-center mt-4">
            Don't have account? <router-link to="/register">Register</router-link>
          </div>

        </div>
      </div>
    </div>
  </main>
</template>
<script setup >

// import {ref} from "vue";
// import {useRouter} from "vue-router";
// import axios from "axios";
//
// const username = ref('');
// const password = ref('');
// const error = ref([]);
// const router = useRouter();
//
// const login = () =>{
//   axios.post('http://127.0.0.1:8000/api/v1/auth/login', {
//     username : username.value,
//     password : password.value
//
//   }).then(response =>{
//     const token = response.data.token
//     localStorage.setItem('token',token);
//
//     router.push('/');
//   }).catch((err) =>{
//     error.value = err.response.message
//   })
//
// }
</script>