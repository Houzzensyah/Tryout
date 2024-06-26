<template>
  <main>

    <div class="hero py-5 bg-light">
      <div class="container">
        <router-link to="/menage/game/form" class="btn btn-primary">
          Add Game
        </router-link>
      </div>
    </div>

    <div class="list-form py-5">
      <div class="container">
        <h6 class="mb-3">List Games</h6>

        <table class="table table-striped">
          <thead>
          <tr>
            <th width="100">Thumbnail</th>
            <th width="200">Title</th>
            <th width="500">Description</th>
            <th width="180">Action</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><img src="../example_game/v1/thumbnail.png" alt="Demo Game 1 Logo" style="width: 100%"></td>
            <td>Demo Game 1</td>
            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, numquam repellendus perspiciatis cupiditate veritatis porro quod eveniet animi perferendis molestias debitis temporibus, asperiores iusto.                    </td>
            <td>
              <a href="detail-games.html" class="btn btn-sm btn-primary">Detail</a>
              <a href="manage-games-form-update.html" class="btn btn-sm btn-secondary">Update</a>
              <a href="#" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          <tr>
            <td><img src="../example_game/v1/thumbnail.png" alt="Demo Game 2 Logo" style="width: 100%"></td>
            <td>Demo Game 2</td>
            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, numquam repellendus perspiciatis cupiditate veritatis porro quod eveniet animi perferendis molestias debitis temporibus, asperiores iusto.                    </td>
            <td>
              <a href="detail-games.html" class="btn btn-sm btn-primary">Detail</a>
              <a href="manage-games-form-update.html" class="btn btn-sm btn-secondary">Update</a>
              <a href="#" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          <tr>
            <td><img src="../example_game/v1/thumbnail.png" alt="Demo Game 3 Logo" style="width: 100%"></td>
            <td>Demo Game 3</td>
            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, numquam repellendus perspiciatis cupiditate veritatis porro quod eveniet animi perferendis molestias debitis temporibus, asperiores iusto.                    </td>
            <td>
              <a href="detail-games.html" class="btn btn-sm btn-primary">Detail</a>
              <a href="manage-games-form-update.html" class="btn btn-sm btn-secondary">Update</a>
              <a href="#" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          </tbody>
        </table>

      </div>
    </div>

  </main>
</template>
<script setup >
</script>