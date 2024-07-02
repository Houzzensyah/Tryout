<template>
  <main>
    <section class="login">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-center mb-4">Formify</h1>
            <div class="card card-default">
              <div class="card-body">
                <h3 class="mb-3">Login</h3>
                <ul v-if="generalError" class="alert alert-danger">{{generalError}}</ul>
                <form @submit.prevent="login">
                  <!-- s: input -->
                  <div class="form-group my-3">
                    <label for="email" class="mb-1 text-muted">Email Address</label>
                    <input type="email" id="email" name="email" value="" v-model="email" class="form-control" autofocus required/>
                    <ul v-if="errors.email" class="alert alert-danger">{{errors.email[0]}}</ul>
                  </div>

                  <!-- s: input -->
                  <div class="form-group my-3">
                    <label for="password" class="mb-1 text-muted">Password</label>
                    <input type="password" id="password" name="password" v-model="password" value="" class="form-control" required/>
                    <ul v-if="errors.password" class="alert alert-danger">{{errors.password[0]}}</ul>
                  </div>

                  <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
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

import {useRouter} from "vue-router";
import {ref} from "vue";
import axios from "axios";

const router = useRouter();
const email = ref('');
const password = ref('');
const errors = ref({});
const generalError = ref('')


const login = () => {
  axios.post('http://127.0.0.1:8000/api/v1/auth/login', {
    email : email.value,
    password : password.value
  }).then((result)=>{
     const token = result.data.user.accessToken
    localStorage.setItem('token', token)
    router.push('/')
  }).catch((error) => {
    if (error.response && error.response.data) {
      if (error.response.data.errors) {
        // Capture specific field errors
        errors.value = error.response.data.errors;
      } else if (error.response.data.message) {
        // Capture general error message
        generalError.value = error.response.data.message;
      }else {
        console.log('bodod')
      }
    }
  })
}
</script>