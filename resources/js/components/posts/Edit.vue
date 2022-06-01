<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / <router-link class="path-link" :to="{ name: 'posts' }">Posts</router-link> / Edit Post</h1>
          </div>
          <div class="col-lg-12 mb-3">
            <form @submit.prevent="PostStore">
              <div class="row">
                <div class="col-lg-5 mt-auto">
                  <img src="http://127.0.0.1:8000/img/blog-1.jpg" class="img-fluid img-thumbnail">
                </div>
                <div class="col-lg-7">
                  <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input required type="text" class="form-control" v-model="title" id="title" @keyup="createSlug" autofocus>
                    <div class="invalid-feedback" v-if="this.errors.title">
                      {{ this.errors.title[0] }}
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input required type="text" class="form-control" v-model="slug" id="slug" disabled>
                    <div class="invalid-feedback" v-if="this.errors.slug">
                      {{ this.errors.slug[0] }}
                    </div>
                  </div>
                  <div class="mb-3 ">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image">
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
                </div>
              </div>
              <div class="mb-3 mt-3">
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
      createSlug(event) {
        const value = event.target.value
        this.slug = value.replace(/\s+/g, '-').replace(/\W+/g, '-').replace(/\-$/, '').toLowerCase()
      },
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