<template>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/">Gaming Portal</router-link>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li><router-link to="/discover/game" class="nav-link px-2 text-white">Discover Games</router-link></li>
        <li><router-link to="/menage/game" class="nav-link px-2 text-white">Manage Games</router-link></li>
        <li><a href="profile.html" class="nav-link px-2 text-white">User Profile</a></li>
        <li class="nav-item">
          <a class="nav-link active bg-dark" href="#">Welcome, Player1</a>
        </li>
        <li class="nav-item">
          <a @click="logout" class="btn bg-white text-primary ms-4">Sign Out</a>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script >
import {useRouter} from "vue-router";

export default {
  name : 'UserNavbar',

 setup() {
   const router = useRouter();
   const logout = () => {
     localStorage.removeItem('token');
     localStorage.removeItem('role');
     router.push('/signup')
   }

   return {
     logout
   }
 }
}


</script>