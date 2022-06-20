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
                      <i class="fas fa-book fa-2x text-gray-300"></i>
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
                      <i class="fas fa-pie-chart fa-2x text-gray-300"></i>
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
                        <h6 class="m-0 font-weight-bold text-primary">Posts per Category</h6>
                      </div>
                      <div class="card-body">
                        <div v-for="(data, index) in postsPerCategory">
                          <h4 class="small font-weight-bold">{{ data[0].category.name }}<span
                                  class="float-right">{{ Math.floor(Object.keys(data).length / posts.length * 100) }}%</span></h4>
                          <div class="progress mb-4">
                              <div class="progress-bar bg-primary" role="progressbar" :style="{'width':`${Math.floor(Object.keys(data).length / posts.length * 100)}%`}" aria-valuemin="0" aria-valuemax="100"></div>
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
        categories: [],
        posts: [],
        postsPerCategory: [],
        user: null
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Dashboard | HL Blog'
      })
    },
    mounted(){
      this.axios.get('/api/user').then(res => {
        this.user = res.data

        this.axios.get('/api/posts/' + this.user.id).then(res => {
          this.posts = res.data.data
        })
        this.axios.get('/api/categories').then(res => {
          this.categories = res.data.data
        })
        this.axios.get('/api/category/percentage/' + this.user.id).then(res => {
          this.postsPerCategory = res.data.data
        })
      })
    }
  }
</script>