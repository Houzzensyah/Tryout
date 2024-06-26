<template>
  <user-navbar></user-navbar>
  <main>

    <div class="hero py-5 bg-light">
      <div class="container text-center">
        <h1>Discover Games</h1>
      </div>
    </div>

    <div class="list-form py-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="mb-3">300 Game Avaliable</h2>
          </div>

          <div class="col-lg-8" style="text-align: right;">
            <div class="mb-3">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary">Popularity</button>
                <button type="button" class="btn btn-outline-primary">Recently Updated</button>
                <button type="button" class="btn btn-outline-primary">Alphabetically</button>
              </div>

              <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary">ASC</button>
                <button type="button" class="btn btn-outline-primary">DESC</button>
              </div>
            </div>
          </div>
        </div>


        <div class="row" v-for="(game, index) in games.content" :key="index">
          <div class="col-md-6">
            <a href="detail-games.html" class="card card-default mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <img src="../example_game/v1/thumbnail.png" alt="Demo Game 1 Logo" style="width: 100%">
                  </div>
                  <div class="col">
                    <h5 class="mb-1">{{game.title}}<small class="text-muted">{{game.author}}</small></h5>
                    <div>{{game.description}}</div>
                    <hr class="mt-1 mb-1">
                    <div class="text-muted">#scores submitted : 203</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

  </main>

</template>
<script setup >
import UserNavbar from "@/components/UserNavbar.vue";
import {onMounted, ref} from "vue";
import axios from "axios";


const games = ref([]);

onMounted(()=> {
  getGame()
})

const getGame = () => {
  axios.get('http://127.0.0.1:8000/api/v1/games',{
    headers :{
      Authorization : 'Bearer ' + localStorage.getItem('token')
    }
  }).then((result) => {
    games.value = result.data
  }).catch((error) => {
    error = 'error'
  })
}
</script>