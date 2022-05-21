<template>
  <div>
    <!-- Manage Categories -->
    <div class="table-responsive mb-5">
      <h1>Manage Categories</h1>

      <router-link :to="{ name: 'categoryCreate' }" class="btn btn-primary mb-3">Create New Category</router-link>

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
          <tr v-for="(category, index) in categories" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>{{ category.slug }}</td>
            <td>
              <router-link :to="'/dashboard/category/edit/' + category.id" class="text-dark badge btn-warning">Edit</router-link>
              <button @click.prevent="CategoryDelete(category.id, index)" class="text-dark badge btn-danger border-0">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Manage Post -->
    <div class="table-responsive">
      <h1>Manage Posts</h1>

      <router-link :to="{ name: 'postCreate' }" class="btn btn-primary mb-3">Create New Post</router-link>

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
            <td><a v-bind:href="'/post/' + post.slug" target="_blank" style="text-decoration:none;">{{ post.title }}</a></td>
            <td>{{ post.category.name }}</td>
            <td>
              <router-link :to="'/dashboard/post/edit/' + post.id" class="text-dark badge btn-warning">Edit</router-link>
              <button @click.prevent="PostDelete(post.id, index)" class="text-dark badge btn-danger border-0">Delete</button>
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
      this.axios.get('http://localhost:8000/api/posts').then(res => {
        this.posts = res.data.data
      })
      this.axios.get('http://localhost:8000/api/categories').then(res => {
        this.categories = res.data.data
      })
    },
    methods: {
      PostDelete(id, index){
        this.axios.delete(`http://localhost:8000/api/post/${id}`).then(res => {
          this.posts.splice(index, 1)
        }).catch(err => {
          alert('system error')
        })
      },
      CategoryDelete(id, index){
        this.$swal({
          title: 'Are you sure?',
          text: "to delete this category and it posts",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33'
        }).then((result) => {
          if (result.isConfirmed) {
            this.axios.delete(`http://localhost:8000/api/category/${id}`).then(res => {
              this.categories.splice(index, 1)

              // reload posts data
              this.axios.get('http://localhost:8000/api/posts').then(res => {
                this.posts = res.data.data
              })
              this.$swal(
                'Deleted!',
                'Your category has been deleted.',
                'success'
              )
            }).catch(err => {
              alert('System Error!')
            })
          }
        })
      },
      onChangePage(pageOfPosts) {
        // update page of Post
        this.pageOfPosts = pageOfPosts;
      }
    }
  }
</script>