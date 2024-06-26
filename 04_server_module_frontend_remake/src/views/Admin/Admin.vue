<template>

  <admin-navbar></admin-navbar>
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
          <tr v-for="(admin, index) in users.content" :key="index">
            <td>{{admin.username}}</td>
            <td>{{admin.created_at}}</td>
            <td>{{admin.last_login_at}}</td>
          </tr>

          </tbody>
        </table>

      </div>
    </div>

  </main>

</template>
<script setup >
import AdminNavbar from "@/components/AdminNavbar.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

const users = ref(['']);

onMounted(()=> {
  getUser()
})

const getUser = () => {
  axios.get('http://127.0.0.1:8000/api/v1/admins',{
    headers :{
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((result) => {
    users.value = result.data
  }).catch((error) => {
    error = 'error'
  })
}

</script>