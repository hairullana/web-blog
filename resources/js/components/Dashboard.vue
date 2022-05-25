<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Post</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ posts.length }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Category</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ categories.length }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- bar -->
          <div class="row">
              <!-- Content Column -->
              <div class="col-12 mb-4">

                  <!-- Project Card Example -->
                  <div class="card shadow mb-4">
                      <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                      </div>
                      <div class="card-body">
                          <h4 class="small font-weight-bold">Server Migration <span
                                  class="float-right">20%</span></h4>
                          <div class="progress mb-4">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <h4 class="small font-weight-bold">Sales Tracking <span
                                  class="float-right">40%</span></h4>
                          <div class="progress mb-4">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <h4 class="small font-weight-bold">Customer Database <span
                                  class="float-right">60%</span></h4>
                          <div class="progress mb-4">
                              <div class="progress-bar" role="progressbar" style="width: 60%"
                                  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <h4 class="small font-weight-bold">Payout Details <span
                                  class="float-right">80%</span></h4>
                          <div class="progress mb-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                  aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <h4 class="small font-weight-bold">Account Setup <span
                                  class="float-right">Complete!</span></h4>
                          <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
  import FooterComponent from './Footer.vue'
  import Navbar from './Navbar.vue'
  import Sidebar from './Sidebar.vue'

  export default{
    components: {
      FooterComponent,
      Navbar,
      Sidebar
    },
    data(){
      return {
        posts: [],
        categories: [],
        pageOfPosts: []
      }
    },
    mounted(){
      this.axios.get('http://localhost:8000/api/posts').then(res => {
        this.posts = res.data.data
      })
      this.axios.get('http://localhost:8000/api/categories').then(res => {
        this.categories = res.data.data
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
            this.axios.delete(`http://localhost:8000/api/post/${id}`).then(res => {
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