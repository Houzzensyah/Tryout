<template>

<html lang="en">

  <body>

   <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="index.html">Administrator Portal</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

         <li><router-link to="/admin" class="nav-link px-2 text-white">List Admins</router-link></li>
         <li><router-link to="/users" class="nav-link px-2 text-white">List Users</router-link></li>
         <li class="nav-item">
           <a class="nav-link active bg-dark" href="#">Welcome, Administrator</a>
         </li>
         <li class="nav-item">
          <a @click="logout" class="btn bg-white text-primary ms-4">Sign Out</a>
         </li>
       </ul>
      </div>
    </nav>

    <main>

      <div class="hero py-5 bg-light">
         <div class="container text-center">
          <h1 class="mb-0 mt-0">Dashboard</h1>
         </div>
      </div>

      <div class="list-form py-5">
         <div class="container">
          <h5 class="alert alert-info">
            Welcome, Administrator. Don't forget to sign out when you are finished using this page
          </h5>
         </div>
      </div>

    </main>



  </body>
</html>
</template>
<script lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default {
  setup() {
    const router = useRouter();
    function logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      router.push('/signin')
    }

    return {
      logout
    }
  }
}
</script>