<template>
  <main>
    <div class="hero py-5 bg-light">
      <div class="container text-center">
        <h2 class="mb-3">
          Manage User - Administrator Portal
        </h2>
        <div class="text-muted">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
        </div>
      </div>
    </div>

    <div class="py-5">
      <div class="container">

        <div class="row justify-content-center ">
          <div class="col-lg-5 col-md-6">

            <form @submit.prevent="post">
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="username" class="mb-1 text-muted">Username <span class="text-danger">*</span></label>
                    <input id="username" type="text" placeholder="Username" v-model="user.username" class="form-control" required name="username"/>
                  </div>
                </div>
              </div>
              <div class="form-item card card-default my-4">
                <div class="card-body">
                  <div class="form-group">
                    <label for="password" class="mb-1 text-muted">Password <span class="text-danger">*</span></label>
                    <input id="password" type="password" placeholder="Password"v-model="user.password" class="form-control" required name="userpasswordname"/>
                  </div>
                </div>
              </div>

              <div class="mt-4 row">
                <div class="col">
                  <button class="btn btn-primary w-100">Submit</button>
                </div>
                <div class="col">
                  <router-link to="/user" class="btn btn-danger w-100">Back</router-link>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </main>
</template>
<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
export default {
  setup() {
    const user = reactive({
      username: "",
      password: "",
    });
    const Validation = ref({});

    const router = useRouter();


    function post() {
      axios
          .post("http://127.0.0.1:8000/api/v1/users", user, {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          })
          .then(() => {
            router.push({
              name: "user",
            });
          })
          .catch((err) => {
            Validation.value = err.response.data;
          });
    }
    return {
      user,
      Validation,
      router,
      post,
    };
  },
}
</script>