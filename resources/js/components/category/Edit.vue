<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Edit Category</h1>
    </div>

    <div class="col-lg-8 mb-3">
      <form @submit.prevent="CategoryUpdate">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input required type="text" class="form-control" v-model="name" id="name" autofocus>
          <div class="invalid-feedback" v-if="this.errors.name">
            {{ this.errors.name[0] }}
          </div>
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input required type="text" class="form-control" v-model="slug" id="slug">
          <div class="invalid-feedback" v-if="this.errors.slug">
            {{ this.errors.slug[0] }}
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      name: '',
      slug: '',
      errors: {}
    }
  },
  created(){
    let uri = `http://localhost:8000/api/category/${this.$route.params.id}`
    this.axios.get(uri)
      .then((res) => {
        this.name = res.data.data.name
        this.slug = res.data.data.slug
      })
  },
  methods: {
    CategoryUpdate(){
      let uri = `http://localhost:8000/api/category/update/${this.$route.params.id}`
      this.axios.post(uri, {
        name: this.name,
        slug: this.slug
      }).then((res) => {
        this.$router.push({name: 'dashboard'})
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    }
  }
}
</script>