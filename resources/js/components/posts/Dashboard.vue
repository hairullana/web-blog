<template>
  <div>
    <!-- Manage Categories -->
    <div class="table-responsive mb-5">
      <h1>Manage Categories</h1>

      <!-- <router-link :to="{ name: 'create' }" class="btn btn-primary mb-3">Create New Post</router-link> -->

      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>{{ category.slug }}</td>
            <td>
              <a v-bind:href="'/dashboard/posts/' + category.slug" class="text-dark badge btn-info">Detail</a>
              <router-link :to="'/edit/' + category.id" class="text-dark badge btn-warning">Edit</router-link>
              <button @click.prevent="PostDelete(category.id, index)" class="text-dark badge btn-danger border-0">Delete</span></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Manage Post -->
    <div class="table-responsive">
      <h1>Manage Posts</h1>

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
          <tr v-for="(post, index) in pageOfPosts" :key="post.id">
            <td>{{ post.id }}</td>
            <td>{{ post.title }}</td>
            <td>{{ post.category.name }}</td>
            <td>
              <a v-bind:href="'/dashboard/posts/' + post.slug" class="text-dark badge btn-info">Detail</a>
              <router-link :to="'/edit/' + post.id" class="text-dark badge btn-warning">Edit</router-link>
              <button @click.prevent="PostDelete(post.id, index)" class="text-dark badge btn-danger border-0">Delete</span></button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- paginate -->
      <div class="card-footer pb-3 pt-3 d-flex justify-content-center">
        <jw-pagination :pageSize=10 :items="posts" @changePage="onChangePage"></jw-pagination>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    data(){
      return {
        posts: [],
        categories: [],
        pageOfPosts: []
      }
    },
    mounted(){
      let postsAPI = 'http://localhost:8000/api/posts'
      this.axios.get(postsAPI).then(response => {
        this.posts = response.data.data
      })
      let categoriesAPI = 'http://localhost:8000/api/categories'
      this.axios.get(categoriesAPI).then(response => {
        this.categories = response.data.data
      })
    },
    methods: {
      PostDelete(id, index){
        let uri = `http://localhost:8000/api/post/${id}`
        console.log(uri)
        this.axios.delete(uri).then(res => {
          this.posts.splice(index, 1)
          // location.reload()
        }).catch(err => {
          alert('system error')
        })
      },
      onChangePage(pageOfPosts) {
        // update page of Post
        this.pageOfPosts = pageOfPosts;
      }
    }
  }
</script>