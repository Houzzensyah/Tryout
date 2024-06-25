<template>
  <main class="mt-5">
    <div class="container py-5">
      <div class="px-5 py-4 bg-light mb-4 d-flex align-items-center justify-content-between">
        <div>
          <div class="d-flex align-items-center gap-2 mb-2">
            <h5 class="mb-0">{{full_name}}</h5>
            <span>@{{username}}</span>
          </div>
          <small class="mb-0 text-muted">
          {{bio}}
          </small>
        </div>
        <div>
          <router-link to="/create/post" class="btn btn-primary w-100 mb-2">
            + Create new post
          </router-link>
          <div class="d-flex gap-3">
            <div>
              <div class="profile-label"><b>5</b> posts</div>
            </div>
            <div class="profile-dropdown">
              <div class="profile-label"><b>100</b> followers</div>
              <div class="profile-list">
                <div class="card">
                  <div class="card-body">
                    <div class="profile-user">
                      <a href="user-profile-private.html">@davidnaista</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@superipey</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@lukicenturi</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@_erik3010</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@asawgi</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@irfnmaulaa</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="profile-dropdown">
              <div class="profile-label"><b>100</b> following</div>
              <div class="profile-list">
                <div class="card">
                  <div class="card-body">
                    <div class="profile-user">
                      <a href="user-profile-private.html">@davidnaista</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@superipey</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@lukicenturi</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@_erik3010</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@asawgi</a>
                    </div>
                    <div class="profile-user">
                      <a href="user-profile-private.html">@irfnmaulaa</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <div class="card-images mb-2">
<!--                <img src="posts/52a93d48-b9d4-4a7e-9fb7-c9466da4c344.webp" alt="image" class="w-100"/>-->
              </div>
              <p class="mb-0 text-muted">{{caption}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

</template>
<script setup >


import {onMounted, ref} from "vue";
import axios from "axios";

const username = ref('');
const bio = ref('');
const full_name = ref('')

const caption = ref('');
const attachment = ref('');

onMounted(()=>{
  getName()
});


const getPost = () => {
  axios.get('http://127.0.0.1:8000/api/v1/users', {
    headers: {
      Authorization: 'Bearer ' + localStorage.getItem('token')
    }
  }).then((result) =>{
    caption.value = result.data.caption;

  })
}

const getName = () => {
  axios.get('http://127.0.0.1:8000/api/v1/use/profile',{
    headers : {
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((result) =>{
    username.value = result.data.username
    full_name.value = result.data.full_name
    bio.value = result.data.bio
  }).catch(() =>[

  ])
}
</script>