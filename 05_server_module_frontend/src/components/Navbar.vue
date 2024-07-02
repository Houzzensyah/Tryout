<template>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/">Formify</router-link>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#">{{usernamed}}</a>
        </li>
        <li class="nav-item">
          <a @click="logout" class="btn bg-white text-primary ms-4">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script >
import {useRouter} from "vue-router";
import axios from "axios";
import {onMounted, ref} from "vue";

export default {
  name: 'Navbar',

  setup(){
    const usernamed = ref('');
    const router = useRouter();

    const logout = () =>{
      localStorage.removeItem('token')
      router.push('/login')
    }

    onMounted(()=>{
      username()
    });

    const username = () => {
      axios.get('http://127.0.0.1:8000/api/user', {
        headers : {
          Authorization : 'Bearer ' + localStorage.getItem('token')
        }
      }).then((res) => {
        usernamed.value = res.data.name
      })
    }
    return {
      logout,
      username,
      usernamed
    }
  }

}
</script>