<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Create New Category</h1>
    </div>

    <div class="col-lg-8 mb-3">
      <form @submit.prevent="CategoryStore">
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
        <button type="submit" class="btn btn-primary">Create Category</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      user_id: 1,
      name: '',
      slug: '',
      errors: {}
    }
  },
  beforeRouteEnter (to, from, next) {
    next( async vm => {
        document.title = 'Create Category | HL Blog'
    })
  },
  methods: {
    CategoryStore(){
      this.axios.post('http://localhost:8000/api/category/store', {
        name: this.name,
        slug: this.slug
      }).then(res => {
        // back to dashboard
        this.$router.push({
          name: 'dashboard'
        })
      }).catch(error => {
        this.errors = error.res.data.errors
      })
    }
  }
}
</script>