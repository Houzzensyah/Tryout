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
              <h5 class="mb-0">Register</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="register">
                <div class="mb-2">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" v-model= "full_name" name="full_name"/>
                </div>

                <div class="mb-2">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" v-model="username" name="username"/>
                </div>

                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" v-model="password" name="password"/>
                </div>

                <div class="mb-3">
                  <label for="bio">Bio</label>
                  <textarea name="bio" id="bio" cols="30" rows="3" v-model="bio" class="form-control"></textarea>
                </div>

                <div class="mb-3 d-flex align-items-center gap-2">
                  <input type="checkbox" id="is_private" v-model="is_private" name="is_private"/>
                  <label for="is_private">Private Account</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                  Register
                </button>
              </form>
            </div>
          </div>

          <div class="text-center mt-4">
            Already have an account? <router-link to="/login">Login</router-link>
          </div>

        </div>
      </div>
    </div>
  </main>
</template>
<script setup >
import {ref, watch} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

const is_private = ref(0);
const username = ref('');
const full_name= ref('');
const bio = ref('');
const password = ref('');
const error = ref([]);
const router = useRouter();





const register = () => {
  axios.post('http://127.0.0.1:8000/api/v1/auth/register', {
    username: username.value,
    full_name: full_name.value,
    bio: bio.value,
    password: password.value,
   is_private : is_private.value

  }).then(response => {
    const token = response.data.token
    localStorage.setItem('token', token);

    router.push('/');
  }).catch((err) => {
    error.value = err.response.message
  })
}
</script>