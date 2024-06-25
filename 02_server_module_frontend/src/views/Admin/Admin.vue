<template>


  <AdminNavbar></AdminNavbar>
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
</template>
<script >
import { onMounted, ref } from 'vue'
import axios from 'axios';
import { useRouter } from 'vue-router';
import AdminNavbar from "@/components/AdminComponent.vue";
export default {
  components: {AdminNavbar},

  setup(){
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