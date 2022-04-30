<template>
  <div class="table-responsive">

    <router-link :to="{ name: 'create' }" class="btn btn-primary mb-3">Create New Post</router-link>

    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.category.name }}</td>
          <td>
            <a v-bind:href="'/dashboard/posts/' + post.slug" class="text-dark badge btn-info">Detail</a>
            <router-link :to="'/edit/' + post.id" class="text-dark badge btn-warning">Edit</router-link>
            <a class="text-dark badge btn-danger border-0" onclick="return confirm('Are you sure?')">Delete</span></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default{
    data(){
      return {
        posts: []
      }
    },
    created(){
      let uri = 'http://localhost:8000/api/posts'
      this.axios.get(uri).then(response => {
        this.posts = response.data.data
      })
    }
  }
</script>