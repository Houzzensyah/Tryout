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

                <form @submit.prevent="signin">

                  <!-- s: input -->
                  <div class="form-group my-3">
                    <p>{{message}}</p>
                    <label for="username" class="mb-1 text-muted">Username</label>
                    <input type="text" id="username" v-model="username" name="username" value="" class="form-control" autofocus required />
                  </div>

                  <!-- s: input -->
                  <div class="form-group my-3">
                    <label for="password" class="mb-1 text-muted">Password</label>
                    <input type="password" id="password" v-model="password" name="password" value="" class="form-control" required/>
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
<script>
import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";
export default {
  setup(){
    const username = ref('');
    const password = ref('');
    const message = ref('');

    const router = useRouter();


    const signin = async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/v1/auth/signin', {
          username : username.value,
          password : password.value
        });
        localStorage.setItem('token',response.data.token);
        localStorage.setItem('role', response.data.role);
        if(response.data.role === 'admin'){
          router.push('/admin/dashboard')
        }else{
          router.push('/')
        }
      }
      catch (error){
       message.value = 'error: ' + error.response.data.violations.username.message

      }
    }

return {
      signin,
  username,
  password,
  message
}

  }
}
</script>