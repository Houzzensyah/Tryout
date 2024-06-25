<template>

  <main class="mt-5">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between bg-transparent py-3">
            <h5 class="mb-0">Create new post</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="post">
              <div class="mb-2">
                <label for="caption">Caption</label>
                <textarea class="form-control" name="caption"  v-model="newPost.caption" id="caption" cols="30" rows="3"></textarea>
              </div>

              <div class="mb-3">
                <label for="attachments">Image(s)</label>
                <input type="file" class="form-control" ref="newPost.Attachments" id="attachments" name="attachments" multiple/>
              </div>

              <button type="submit" class="btn btn-primary w-100">
                Share
              </button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</main></template>
<script setup>
import axios from "axios";
import {ref} from "vue";

const newPost = ref({
  caption : '',
  Attachments : ''
})

const router = useRouter();

const createUser = () => {
  axios.post('http://127.0.0.1:8000/api/v1/users', newPost.value, {
    headers : {
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }

  }).then(()=> {
    newPost.value = {caption: '' , Attachments : ''};
    router.push({name : 'user'})
  }).catch(error => {
    processError(error);
  });
}

</script>