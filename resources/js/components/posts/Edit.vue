<template>
  <div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h3><router-link :to="{ name: 'dashboard' }" style="text-decoration: none;">Dashboard</router-link> / Create New Post</h3>
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
            <option 
              v-for="category in categories" 
              v-bind:value="category.id"
              :selected="category.id == category_id"
              >{{ category.name }}
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Body</label>
          <input type="hidden" id="body" v-model="body">
          <VueTrix inputId="body" inputName="body" v-model="body" placeholder="enter your content..."/>
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
      categories: [],
      errors: {}
    }
  },
  beforeRouteEnter (to, from, next) {
    next( async vm => {
        document.title = 'Edit Post | HL Blog'
    })
  },
  created(){
    this.axios.get(`http://localhost:8000/api/post/${this.$route.params.id}`).then(res => {
      this.excerpt = res.data.data.excerpt
      this.title = res.data.data.title
      this.slug = res.data.data.slug
      this.category_id = res.data.data.category_id
      this.body = res.data.data.body
    })
    this.axios.get("http://localhost:8000/api/categories").then(res => {
      this.categories = res.data.data
    })
  },
  methods: {
    PostUpdate(){
      this.axios.post(`http://localhost:8000/api/post/update/${this.$route.params.id}`, {
        excerpt: this.title,
        title: this.title,
        slug: this.slug,
        category_id: this.category_id,
        body: this.body
      }).then((res) => {
        this.$router.push({name: 'dashboard'})
      }).catch(error => {
        this.errors = error.response.data.errors
        this.$toasted.show(error.response.data.message, { 
          type: 'error',
          theme: "bubble", 
          position: "top-right", 
          duration : 3000
        })
      })
    }
  }
}
</script>