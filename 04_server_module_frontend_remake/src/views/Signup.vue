<template>
  <main>
    <div class="hero py-5 bg-light">
      <div class="container text-center">
        <h2 class="mb-3">
          Sign Up - Gaming Portal
        </h2>
        <div class="text-muted">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
        </div>
      </div>
    </div>

    <div v-if="errors.length" class="alert alert-danger" role="alert">
      <ul>
        <li v-for="(error, index) in errors" :key="index">
          <strong>{{ error.field }}</strong>: {{ error.message }}
        </li>
      </ul>
    </div>


    <div class="py-5">
      <div class="container">

        <div class="row justify-content-center ">
          <div class="col-lg-5 col-md-6">

            <form @submit.prevent="signup">
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="username" class="mb-1 text-muted">Username <span class="text-danger">*</span></label>
                    <input id="username" type="text" placeholder="Username" v-model="username" required class="form-control" name="username"/>
                  </div>
                </div>
              </div>
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="password" class="mb-1 text-muted">Password <span class="text-danger">*</span></label>
                    <input id="password" type="password" placeholder="Password" v-model="password" class="form-control" name="userpasswordname"/>
                  </div>
                </div>
              </div>

              <div class="mt-4 row">
                <div class="col">
                  <button class="btn btn-primary w-100">Sign Up</button>
                </div>
                <div class="col">
                  <router-link to="/signin" class="btn btn-danger w-100">Sign In</router-link>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </main>
</template>
<script setup>
import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

const username = ref('');
const password = ref('')
const errors = ref([]);
const router = useRouter();


const signup = () => {
  axios.post('http://127.0.0.1:8000/api/v1/auth/signup',{
    username : username.value,
    password : password.value
  }).then((response) => {
   router.push('/signin')

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