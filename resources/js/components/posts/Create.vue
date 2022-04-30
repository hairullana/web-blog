<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Create New Post</h1>
    </div>

    <div class="col-lg-8 mb-3">
      <form @submit.prevent="PostStore">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" v-model="post.title" id="title" name="title" required autofocus>
          <div v-if="validation.title">
            <div class="invalid-feedback">
              {{ validation.title[0] }}
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" v-model="post.slug" id="slug" name="slug" required>
          <div v-if="validation.slug">
            <div class="invalid-feedback">
              {{ validation.slug[0] }}
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select name="category_id" id="category" class="form-select">
            <option value="1" selected>Example</option>
          </select>
        </div>
        <!-- <div class="mb-3">
          <label for="image" class="form-label">Post Image</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
        </div> -->
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          <input id="body" v-model="body" type="hidden" name="body">
          <trix-editor input="body"></trix-editor>
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
      post: {},
      validation: []
    }
  },
  methods: {
    PostStore(){
      let uri = 'http://localhost:8000/api/post/store'
      this.axios.post(uri, this.post)
        .then((response) => {
          this.$router.push({
            name: 'posts'
          })
        })
        .catch(error => {
          this.validation = error.response.data.data
        })
    }
  }
}
</script>