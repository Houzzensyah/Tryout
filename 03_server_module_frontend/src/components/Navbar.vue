<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
      <router-link class="navbar-brand" to="/">Facegram</router-link>
      <div class="navbar-nav">
        <router-link class="nav-link" to="/profile">@{{username}}</router-link>
        <a  @click="logout" class="nav-link" >Logout</a>
      </div>
    </div>
  </nav>
</template>
<script >
import {useRouter} from "vue-router";
import {ref, onMounted} from "vue";
import axios from "axios";

export default {
  name : 'Navbar',

  setup(){

    const username = ref('');

    onMounted(()=>{
      getName()
    });

    const getName = () => {
      axios.get('http://127.0.0.1:8000/api/v1/use/profile',{
        headers : {
          Authorization : 'Bearer ' + localStorage.getItem('token')
        }
      }).then((result) =>{
        username.value = result.data.username
      }).catch(() =>[

      ])
    }


    const router = useRouter();
const logout = () =>{
  localStorage.removeItem('token');
  router.push('/login')
}

return {
  logout,
  username,
  getName,

}

  }
}

</script>