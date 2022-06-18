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
            <form @submit.prevent="PostUpdate">
              <div class="row">
                <div class="col-lg-5 mt-auto image-preview">
                  <img v-bind:src="this.image" class="img-fluid img-thumbnail">
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
                    <input class="form-control" type="file" id="image" @change="uploadImage">
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
        id: '',
        excerpt: '',
        title: '',
        slug: '',
        category_id: '',  
        body: '',
        categories: [],
        image: '',
        errors: {},
        users: null
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Edit Post | HL Blog'
      })
    },
    created(){
      this.axios.get('/api/user').then(res => {
        this.user = res.data

        this.axios.get(`/api/post/${this.$route.params.id}`).then(res => {
          this.$router.push({name: 'posts'}, () => {
            this.$toasted.show(`You don't have permission to access this page!`, { 
              type: 'error',
              theme: "bubble", 
              position: "top-right", 
              duration : 3000
            })
          })

          this.id = res.data.data.id
          this.excerpt = res.data.data.excerpt
          this.title = res.data.data.title
          this.slug = res.data.data.slug
          this.category_id = res.data.data.category_id
          this.body = res.data.data.body
          
          let me = this
          let imageURL = "/storage/images/posts/" + res.data.data.id + ".jpg"
          this.axios.get(imageURL).then(res => {
            me.image = imageURL
          }).catch(err => {
            me.image = "http://ngeewap.xtgem.com/files/hl.jpg"
          })
        })
      })
      
      this.axios.get("/api/categories").then(res => {
        this.categories = res.data.data
      })
    },
    methods: {
      uploadImage(event) {
        this.image = event.target.files[0]
        $('.image-preview').find('.img-thumbnail').remove()
        $('.image-preview').append(`<img src="${URL.createObjectURL(this.image)}" class="img-fluid img-thumbnail">`)
      },
      createSlug(event) {
        const value = event.target.value
        this.slug = value.replace(/\s+/g, '-').replace(/\W+/g, '-').replace(/\-$/, '').toLowerCase()
      },
      PostUpdate(){
        const config = {
          header: {
            'content-type': 'multipart/form-data'
          }
        }
        let data = new FormData()
        data.append('excerpt', this.title)
        data.append('title', this.title)
        data.append('slug', this.slug)
        data.append('category_id', this.category_id)
        data.append('body', this.body)
        data.append('image', this.image)
        this.axios.post(`/api/post/update/${this.$route.params.id}`, data, config).then((res) => {
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