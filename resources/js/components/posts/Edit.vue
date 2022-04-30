<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Create New Post</h1>
    </div>

    <div class="col-lg-8 mb-3">
      <form @submit.prevent="PostUpdate">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input required type="text" class="form-control" v-model="title" id="title" autofocus>
          <div class="invalid-feedback" v-if="this.errors.title">
            {{ this.errors.title[0] }}
          </div>
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input required type="text" class="form-control" v-model="slug" id="slug">
          <div class="invalid-feedback" v-if="this.errors.slug">
            {{ this.errors.slug[0] }}
          </div>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select v-model="category_id" id="category" class="form-select">
            <option value="1" selected>Example</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Body</label>
          <textarea required v-model="body" type="hidden" name="body"></textarea>
          <div class="invalid-feedback" v-if="this.errors.body">
            {{ this.errors.body[0] }}
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      excerpt: '',
      title: '',
      slug: '',
      category_id: '',  
      body: '',
      errors: {}
    }
  },
  created(){
    let uri = `http://localhost:8000/api/post/${this.$route.params.id}`
    this.axios.get(uri)
      .then((res) => {
        this.excerpt = res.data.data.excerpt
        this.title = res.data.data.title
        this.slug = res.data.data.slug
        this.category_id = res.data.data.category_id
        this.body = res.data.data.body
      })
  },
  methods: {
    PostUpdate(){
      let uri = `http://localhost:8000/api/post/update/${this.$route.params.id}`
      this.axios.post(uri, {
        excerpt: this.title,
        title: this.title,
        slug: this.slug,
        category_id: this.category_id,
        body: this.body
      }).then((res) => {
        this.$router.push({name: 'dashboard'})
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    }
  }
}
</script>