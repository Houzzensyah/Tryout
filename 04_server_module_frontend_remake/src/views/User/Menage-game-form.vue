<template>
  <main>
    <div class="hero py-5 bg-light">
      <div class="container text-center">
        <h2 class="mb-3">
          Manage Games - Gaming Portal
        </h2>
      </div>
    </div>
    <div v-if="errors.length" class="alert alert-danger" role="alert">
      <ul>
        <li v-for="(error, index) in errors" :key="index">
          <strong>{{ error.field }}</strong>: {{ error.message }}
        </li>
      </ul>
    </div>
    <div class="py-5">
      <div class="container">

        <div class="row justify-content-center ">
          <div class="col-lg-5 col-md-6">

            <form @submit.prevent="postgame">
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="title" class="mb-1 text-muted">Title <span class="text-danger">*</span></label>
                    <input id="title" type="text" placeholder="Title" v-model="newGame.title" required class="form-control" name="title"/>
                  </div>
                </div>
              </div>
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="description" class="mb-1 text-muted">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" v-model="newGame.description" required placeholder="Description" id="description" cols="30" rows="5"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="thumbnail" class="mb-1 text-muted">Thumbnail <span class="text-danger">*</span></label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                  </div>
                </div>
              </div>
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="game" class="mb-1 text-muted">File Game <span class="text-danger">*</span></label>
                    <input type="file" name="game" class="form-control" id="game">
                  </div>
                </div>
              </div>

              <div class="mt-4 row">
                <div class="col">
                  <button class="btn btn-primary w-100">Submit</button>
                </div>
                <div class="col">
                  <router-link to="/menage/game" class="btn btn-danger w-100">Back</router-link>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </main>

</template>
<script setup>
import axios from "axios";
import {ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter();

const errors = ref([]);

const newGame= ref({
  title : '',
  description : ''
})
const postgame = () =>{
  axios.post('http://127.0.0.1:8000/api/v1/games', newGame.value, {
    headers :{
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then(() => {
    newGame.value = {title : '', description : ''}
    router.push('/users/form')
  }).catch(err => {
    errorMes(err);
  })


  function errorMes(error){
    errors.value = error.response?.data?.violations
        ? Object.entries(error.response.data.violations).map(([field, {message}])=>({field,message}))
        :[{field : 'errors' , message: error.response?.data?.message}]
  }

}
</script>