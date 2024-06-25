<template>

  <Navbar>

  </Navbar>
  <main class="mt-5">
    <div class="container py-5">
      <div class="row justify-content-between">
        <div class="col-md-8">
          <h5 class="mb-3">News Feed</h5>
          <div v-for="post in posts" :key="post.id" class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between bg-transparent py-3">
              <h6 class="mb-0">{{ post.title }}</h6>
              <small class="text-muted">5 day</small>
            </div>
            <div class="card-body">
              <div class="card-images mb-2" v-if="post.attachments.length">
                <img v-for="(attachment, index) in post.attachments" :key="index" :src="getImageUrl(attachment.storage_path)" alt="image" class="w-100 mb-2"/>
              </div>
              <p class="mb-0 text-muted">
                <b><a href="user-profile.html">{{ post.user.username }}</a></b> {{ post.caption }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup >
import Navbar from "@/components/Navbar.vue";
import axios from "axios";
import { ref, onMounted } from "vue";


const posts = ref([]);
const errors = ref([]);
const getUsers = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/v1/posts', {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token')
      }
    });
    posts.value = response.data.posts; // Assuming your API response has posts in the data object
  } catch (err) {
    errors.value = err.response.data.errors;
  }
};
const getImageUrl = (path) => {
  return `http://127.0.0.1:8000/storage/${path}`;
};

onMounted(() => {
  getUsers();
});




</script>