<template>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.html">Gaming Portal</a>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li><router-link to="discover-games.html" class="nav-link px-2 text-white">Discover Games</router-link></li>
        <li><router-link to="manage-games.html" class="nav-link px-2 text-white">Manage Games</router-link></li>
        <li><router-link to="profile.html" class="nav-link px-2 text-white">User Profile</router-link></li>
        <li class="nav-item">
          <router-link class="nav-link active bg-dark" href="#">Welcome, Player1</router-link>
        </li>
        <li class="nav-item">
          <a @click="logout" class="btn bg-white text-primary ms-4">Sign Out</a>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
import {useRouter} from "vue-router";

export default {
  name: 'UserComponent',
  setup(){

    const router = useRouter();
    const logout = function (){
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      router.push('/signin')
    };

    return{
      logout
    }
  }
}
</script>