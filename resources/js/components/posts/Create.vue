<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / <router-link class="path-link" :to="{ name: 'posts' }">Posts</router-link> / Create Post</h1>
          </div>
          <div class="col-lg-8 mb-3">
            <form @submit.prevent="PostStore">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input required type="text" class="form-control" v-model="title" id="title" @keyup="createSlug" autofocus>
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
                    >{{ category.name }}
                  </option>
                </select>
                <div class="invalid-feedback" v-if="this.errors.category">
                  {{ this.errors.category[0] }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Body</label>
                <input type="hidden" id="body" v-model="body">
                <VueTrix inputId="body" inputName="body" v-model="body" placeholder="enter your content..."/>
                <div class="invalid-feedback" v-if="this.errors.body">
                  {{ this.errors.body[0] }}
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Create Post</button>
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
        user_id: 1,
        excerpt: '',
        title: '',
        slug: '',
        category_id: '',  
        body: '',
        categories: '',
        errors: {}
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Create Post | HL Blog'
      })
    },
    created(){
      this.axios.get("http://localhost:8000/api/categories").then(res => {
        this.categories = res.data.data
      })
    },
    methods: {
      createSlug(event) {
        const value = event.target.value
        this.slug = value.replace(/\s+/g, '-').replace(/\W+/g, '-').replace(/\-$/, '').toLowerCase()
      },
      PostStore(){
        this.axios.post('http://localhost:8000/api/post/store', {
          user_id: this.user_id,
          excerpt: this.title,
          title: this.title,
          slug: this.slug,
          category_id: this.category_id,
          body: this.body,
        }).then(res => {
          // back to dashboard
          this.$router.push({name: 'dashboard'}, () => {
            this.$toasted.show("Post has been posted!", { 
              type: 'success',
              theme: "bubble", 
              position: "top-right", 
              duration : 3000
            })
          })
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