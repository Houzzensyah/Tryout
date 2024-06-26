<template>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/admin/dashboard">Administrator Portal</router-link>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li><router-link to="/admin/form" class="nav-link px-2 text-white">List Admins</router-link></li>
        <li><router-link to="/users/form" class="nav-link px-2 text-white">List Users</router-link></li>
        <li class="nav-item">
          <router-link class="nav-link active bg-dark" to="/admin/dashboard">Welcome, Administrator</router-link>
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
  name : 'AdminNavbar',

  setup(){
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