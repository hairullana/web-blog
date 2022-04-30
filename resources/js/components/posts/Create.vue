<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Create New Post</h1>
    </div>

    <div class="col-lg-8 mb-3">
      <form @submit.prevent="PostStore">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" v-model="title" id="title" autofocus>
          <div v-if="validation.title">
            <div class="invalid-feedback">
              {{ validation.title[0] }}
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" v-model="slug" id="slug">
          <div v-if="validation.slug">
            <div class="invalid-feedback">
              {{ validation.slug[0] }}
            </div>
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
          <textarea v-model="body" type="hidden" name="body"></textarea>
          <div v-if="validation.body">
            <div class="invalid-feedback">
              {{ validation.body[0] }}
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      user_id: 1,
      excerpt: '',
      title: '',
      slug: '',
      category_id: '',  
      body: '',
      validation: []
    }
  },
  methods: {
    PostStore(){
      console.log(this.title)
      let uri = 'http://localhost:8000/api/post/store'
      this.axios.post(uri, {
        user_id: this.user_id,
        excerpt: this.title,
        title: this.title,
        slug: this.slug,
        category_id: this.category_id,
        body: this.body
      }).then((response) => {
        this.$router.push({
          name: 'posts'
        })
      })
    }
  }
}
</script>