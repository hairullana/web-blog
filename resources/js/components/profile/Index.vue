<template>
  <div id="wrapper">
    <Sidebar :user="user" />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar :user="user" />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / Profile</h1>
          </div>

          <div class="row">
            <div class="col-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 px-5">
                      <img class="img-profile rounded-circle img-fluid" src="http://ngeewap.xtgem.com/files/hl.jpg">
                    </div>
                    <div class="col-md-4">
                      <form>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" :value="user.name">
                        </div>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" :value="user.username">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" :value="user.email">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    </div>
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
          document.title = 'Edit Profile | HL Blog'
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