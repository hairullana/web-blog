<template>
  <div id="wrapper">
    <Sidebar :user="user" />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar :user="user" />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / <router-link class="path-link" :to="{ name: 'posts' }">Posts</router-link> / Create Post</h1>
          </div>
          <div class="col-lg-12 mb-3">
            <form @submit.prevent="PostStore">
              <div class="row">
                <div class="col-lg-5 mt-auto">
                  <img src="https://icon-library.com/images/no-image-icon/no-image-icon-0.jpg" class="img-fluid img-thumbnail">
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
                  </div>
                  <div class="mb-3 ">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" @change="uploadImage">
                  </div>
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select v-model="category_id" id="category" class="form-control">
                      <option 
                        v-for="category in categories" 
                        v-bind:value="category.id"
                        >{{ category.name }}
                      </option>
                    </select>
                    <div class="invalid-feedback" v-if="this.errors.category_id">
                      {{ this.errors.category_id[0] }}
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
        categories: '',
        image: '',
        errors: {},
        user: {}
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
        document.title = 'Create Post | HL Blog'
      })
    },
    created(){
      this.axios.get("/api/categories").then(res => {
        this.categories = res.data.data;
      });
      this.axios.get('/api/user').then(res => {
        this.user = res.data;
      });
    },
    methods: {
      uploadImage(event) {
        this.image = event.target.files[0]
        $('.img-thumbnail').attr('src', URL.createObjectURL(this.image))
      },
      createSlug(event) {
        const value = event.target.value
        this.slug = value.replace(/\s+/g, '-').replace(/\W+/g, '-').replace(/\-$/, '').toLowerCase()
      },
      PostStore(){
        const config = {
          header: {
            'content-type': 'multipart/form-data'
          }
        }
        let data = new FormData()
        data.append('user_id', this.user.id)
        data.append('excerpt', this.title)
        data.append('title', this.title)
        data.append('slug', this.slug)
        data.append('category_id', this.category_id)
        data.append('body', this.body)
        data.append('image', this.image)
        this.axios.post('/api/post/store', data, config)
          .then(res => {
            // back to dashboard
            this.$router.push({name: 'posts'}, () => {
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