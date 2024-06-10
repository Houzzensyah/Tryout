<template>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrators - Administrator Portal</title>
    <link rel="stylesheet" href="../../public/Vendor/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/Vendor/css/style.css">
  </head>
  <body>

   <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
      <div class="container">
        <router-link to="/admin/dashboard" class="navbar-brand" >Administrator Portal</router-link>
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

      <div class="list-form py-5">
         <div class="container">
            <h6 class="mb-3">List Admin Users</h6>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Last login</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="(admin,index) in admins.content" :key="index">
                      <td>{{admin.username}}</td>
                      <td>{{admin.created_at}}</td>
                      <td>{{admin.last_login_at}}</td>
                  </tr>

                </tbody>
            </table>

         </div>
      </div>

    </main>



  </body>
</html>
</template>
<script lang="ts">
import { onMounted, ref } from 'vue'
import axios from 'axios';
import { useRouter } from 'vue-router';
export default {
  setup() {

    let admins = ref([]);

    const router = useRouter();

    onMounted(()=>{
      axios.get('http://127.0.0.1:8000/api/v1/admins', {
        headers: {
           Authorization : "Bearer " + localStorage.getItem("token")
        },
      }).then((result)=>{
        admins.value = result.data
      }).catch((err)=>{
        console.log(err);
      });
    })
    function logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('role');
      router.push('/signin')
    }

    return {
      logout,admins
    }
  }
}
</script>