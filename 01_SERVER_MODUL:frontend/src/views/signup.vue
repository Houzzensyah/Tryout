<template>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Gaming Portal</title>
    <link rel="stylesheet" href="../../public/Vendor/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/Vendor/css/style.css">
  </head>
  <body>

    <main>
      <div class="hero py-5 bg-light">
         <div class="container text-center">
            <h2 class="mb-3">
               Sign Up - Gaming Portal
            </h2>
            <div class="text-muted">

            </div>
         </div>
      </div>

      <div class="py-5">
         <div class="container">

            <div class="row justify-content-center ">
               <div class="col-lg-5 col-md-6">

                  <form @submit.prevent="signup">
                        <p> {{message}}</p>
                     <div class="form-item card card-default my-4">
                        <div class="card-body">
                           <div class="form-group">
                              <label for="username" class="mb-1 text-muted">Username <span class="text-danger">*</span></label>
                              <input id="username" type="text" placeholder="Username" v-model="username" class="form-control" name="username"/>
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
                          <router-link to="/signup" class="btn btn-danger w-100">Sign in</router-link>
                        </div>
                     </div>
                  </form>

               </div>
             </div>

         </div>
      </div>
    </main>



  </body>
</html>
</template>
<script lang="ts">

import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'

export default {
  setup() {
    const username = ref('');
    const password = ref('');
    const message = ref('');

    const router = useRouter();
    const signup = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/v1/auth/signup', {
          username: username.value,
          password: password.value,
        });
        message.value = 'Signup successful';
        router.push('/signin')
      } catch (error) {
        message.value = 'Error: ' + error.response.data.message;
      }
    };

    return {
      username,
      password,
      message,
      signup,
    };
  },
};
</script>