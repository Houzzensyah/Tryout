<template>
  <admin-navbar></admin-navbar>
  <main>

    <div class="hero py-5 bg-light">
      <div class="container">
        <router-link to="/users/create" class="btn btn-primary">
          Add User
        </router-link>
      </div>
    </div>

    <div class="list-form py-5">
      <div class="container">
        <h6 class="mb-3">List Users</h6>

        <table class="table table-striped">
          <thead>
          <tr>
            <th>Username</th>
            <th>Created at</th>
            <th>Last login</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(user, index) in users.content" :key="index">
            <td>{{user.username}}</td>
            <td>{{user.created_at}}</td>
            <td>{{user.last_login_at}}</td>
            <td>
              <router-link :to="{name : 'UserEdit', params : {id : user.id}}" class="btn btn-sm btn-secondary">Update</router-link>
              <a @click="deleteUser(user.id)" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          </tbody>
        </table>

      </div>
    </div>

  </main>
</template>
<script setup lang="ts">
import AdminNavbar from "@/components/AdminNavbar.vue";

import {onMounted, ref} from "vue";
import axios from "axios";

const users = ref(['']);

onMounted(()=> {
  getUser()
})

const getUser = () => {
  axios.get('http://127.0.0.1:8000/api/v1/users',{
    headers :{
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((result) => {
    users.value = result.data
  }).catch((error) => {
    error = 'error'
  })
}

function deleteUser(userId){
  axios.delete(`http://127.0.0.1:8000/api/v1/users/${userId}`,{
    headers: {
      Authorization: 'Bearer ' + localStorage.getItem('token')
    }
  }).then(()=>{
    users.value.content = users.value.content.filter(user => user.id !== userId);
  })
}

</script>