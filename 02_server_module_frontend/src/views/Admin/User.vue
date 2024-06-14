<template>

<AdminNavbar></AdminNavbar>
  <main>

    <div class="hero py-5 bg-light">
      <div class="container">
        <router-link to="/user/form" class="btn btn-primary">
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
          <tr v-for="(admin,index) in admins.content" :key="index">
            <td>{{admin.id}}</td>
            <td>{{admin.username}}</td>
            <td>{{admin.created_at}}</td>
            <td>{{admin.last_login_at}}</td>
            <td>

              <router-link to="/user/form/:id" class="btn btn-sm btn-secondary">Update</router-link>
              <a @click="destroy(admin.id, index)" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          <tr>

          </tr>
          </tbody>
        </table>

      </div>
    </div>

  </main>
</template>
<script >

import AdminNavbar from "@/components/AdminComponent.vue";
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default {
  components: {AdminNavbar},
    setup(){
      let admins = ref([]);

      const router = useRouter();

      onMounted(()=>{
        axios.get('http://127.0.0.1:8000/api/v1/users', {
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

      function destroy(id, index) {
        console.log("Deleting admin with ID:", id);  // Debugging log
        axios
            .delete(`http://127.0.0.1:8000/api/v1/users/${id}`, {
              headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
              },
            })
            .then(() => {
              console.log("Deleted admin, updating list.");  // Debugging log
              admins.value.content.splice(index, 1); // Remove the item from the list
            })
            .catch((err) => {
              console.log("Error deleting admin:", err.response.data);
            });
      }
      return {
        logout,admins,destroy
      }
    }


}
</script>