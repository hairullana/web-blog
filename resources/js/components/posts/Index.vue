<template>
  <div class="container">
    <h1 class="mb-3 text-center">Blog Post</h1>
    <div class="row">
      <div class="col-md-4 mb-3" v-for="post in posts" :key="post.id">
        <div class="card">
          <div class="position-absolute px-3 py-2 text-white"><a v-bind:href="'/posts?category=' + post.category.slug" class="text-decoration-none text-white">{{ post.category.name }}</a></div>
          <img src="https://source.unsplash.com/500x400?news" class="img-fluid mt-3" v-bind:alt="post.category.name">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <small class="text-muted">By <a v-bind:href="'/posts?author=' + post.author.username" class="text-decoration-none">{{ post.author.name }}</a> {{ post.created_at | formatDate }}</small>
            <p class="card-text">{{ post.excerpt }}</p>
            <a v-bind:href="'/posts/' + post.slug" class="btn btn-primary">Readmore</a>
          </div>
        </div>
      </div>
    </div>
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