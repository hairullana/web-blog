<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / Posts</h1>
          </div>

          <div class="row">
            <div class="col-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
                </div>
                <div class="card-body">
                  <router-link :to="{ name: 'postCreate' }" class="btn btn-primary mb-3">Create New Post</router-link>

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th v-if="user.is_admin">Author</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="posts.length == 0">
                        <td colspan="4" class="text-center">Post Not Found</td>
                      </tr>
                      <tr v-else v-for="(post, index) in pageOfPosts" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td><a v-bind:href="'/post/' + post.slug" target="_blank" style="text-decoration:none;">{{ post.title }}</a></td>
                        <td>{{ post.category.name }}</td>
                        <td v-if="user.is_admin">{{ post.author.name }}</td>
                        <td>
                          <router-link :to="'/dashboard/post/edit/' + post.id" class="text-dark badge btn-warning">Edit</router-link>
                          <button @click.prevent="PostDelete(post.id, index)" class="text-dark badge btn-danger border-0">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- paginate -->
                  <div class="card-footer pb-3 pt-3 d-flex justify-content-center">
                    <jw-pagination :pageSize=10 :items="posts" @changePage="onChangePage"></jw-pagination>
                  </div>
                </div>
              </div>
            </div>
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

  export default{
    components: {
      FooterComponent,
      Navbar,
      Sidebar
    },
    data(){
      return {
        posts: [],
        pageOfPosts: [],
        user: {}
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Post | HL Blog'
      })
    },
    mounted(){
      this.axios.get('/api/user').then(res => {
        this.user = res.data
        
        this.axios.get('/api/posts/' + this.user.id).then(res => {
          this.posts = res.data.data
        })
      })
    },
    methods: {
      PostDelete(id, index){
        this.$swal({
          title: 'Are you sure?',
          text: "to delete this post",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33'
        }).then((result) => {
          if (result.isConfirmed) {
            this.axios.delete(`/api/post/${id}`).then(res => {
              this.posts.splice(index, 1)
              this.$swal(
                'Deleted!',
                'Your post has been deleted.',
                'success'
              )
            }).catch(err => {
              this.$toasted.show('System error', { 
                type: 'error',
                theme: "bubble", 
                position: "top-right", 
                duration : 3000
              })
            })
          }
        })
      },
      onChangePage(pageOfPosts) {
        // update page of Post
        this.pageOfPosts = pageOfPosts;
      }
    }
  }
</script>