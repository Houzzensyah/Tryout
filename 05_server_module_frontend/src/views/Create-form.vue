<template>

  <Navbar></Navbar>
  <main>
    <div class="hero py-5 bg-light">
      <div class="container">
        <h2>Create Form</h2>
      </div>
    </div>

    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4">

            <form @submit.prevent="store">
              <!-- s: input -->
              <div class="form-group mb-3">
                <label for="name" class="mb-1 text-muted">Form Name</label>
                <input type="text" id="name" name="name" v-model="data.name" class="form-control" autofocus required/>
                <ul v-if="errors.name" class="alert alert-danger">{{errors.name[0]}}</ul>
              </div>

              <!-- s: input -->
              <div class="form-group my-3">
                <label for="slug" class="mb-1 text-muted">Form Slug</label>
                <input type="text" id="slug" name="slug"  v-model="data.slug" class="form-control" required />
                <ul v-if="errors.slug" class="alert alert-danger">{{errors.slug[0]}}</ul>
              </div>

              <!-- s: input -->
              <div class="form-group my-3">
                <label for="description" class="mb-1 text-muted">Description</label>
                <textarea id="description" name="description" v-model="data.description" rows="4" class="form-control" ></textarea>
                <ul v-if="errors.description" class="alert alert-danger">{{errors.description[0]}}</ul>
              </div>

              <!-- s: input -->
              <div class="form-group my-3">
                <label for="allowed-domains" class="mb-1 text-muted">Allowed Domains</label>
                <input type="text" id="allowed-domains" name="allowed_domains" v-model="data.allowed_domains" required class="form-control" />
                <div class="form-text">Separate domains using comma ",". Ignore for public access.</div>
                <ul v-if="errors.allowed_domains" class="alert alert-danger">{{errors.allowed_domains[0]}}</ul>
              </div>

              <!-- s: input -->
              <div class="form-check form-switch" aria-colspan="my-3">
                <input type="checkbox" id="limit_one_response" name="limit_one_response" class="form-check-input" role="switch"/>
                <label class="form-check-label" for="limit_one_response">Limit to 1 response</label>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </main>

</template>
<script setup >
import Navbar from "@/components/Navbar.vue";
import {useRouter} from "vue-router";
import {ref} from "vue";
import axios from "axios";

const router = useRouter();
const data = ref({
  name : '',
  slug : '',
  description : '',
  allowed_domains : '',
  limit_one_response: true
});
const errors = ref({});

const store = () =>{
  const finalData = {
    ...data.value,
    allowed_domains: data.value.allowed_domains.split(',').map(domain => domain.trim())
  };

  axios.post('http://127.0.0.1:8000/api/v1/forms', finalData, {
    headers : {
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((res) =>{
    data.value = {name : '' ,slug : '', description : '', allowed_domains : '', limit_one_response: true}
    router.push('/')
  }).catch((error) => {
    if (error.response && error.response.data) {
      if (error.response.data.errors) {
        // Capture specific field errors
        errors.value = error.response.data.errors;
      }else {
        console.log('dododl')
      }
    }
  })
}
</script>