<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / <router-link class="path-link" :to="{ name: 'categories' }">Categories</router-link> / Edit Category</h1>
          </div>
          <div class="col-lg-8 mb-3">
            <form @submit.prevent="CategoryUpdate">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input required type="text" class="form-control" v-model="name" id="name" @keyup="createSlug" autofocus>
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
      </div>

      <FooterComponent />
    </div>
  </div>
</template>

<script>
  import FooterComponent from '../Footer.vue'
  import Navbar from '../Navbar.vue'
  import Sidebar from '../Sidebar.vue'

  export default {
    components: {
      FooterComponent,
      Navbar,
      Sidebar
    },
    data(){
      return {
        name: '',
        slug: '',
        errors: {}
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Edit Category | HL Blog'
      })
    },
    created(){
      this.axios.get(`http://127.0.0.3:9292/api/category/${this.$route.params.id}`).then(res => {
        this.name = res.data.data.name
        this.slug = res.data.data.slug
      })
    },
    methods: {
      createSlug(event) {
        const value = event.target.value
        this.slug = value.replace(/\s+/g, '-').replace(/\W+/g, '-').replace(/\-$/, '').toLowerCase()
      },
      CategoryUpdate(){
        this.axios.post(`http://127.0.0.3:9292/api/category/update/${this.$route.params.id}`, {
          name: this.name,
          slug: this.slug
        }).then(res => {
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