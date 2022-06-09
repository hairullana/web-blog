<template>
  <div id="wrapper">
    <Sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / Categories</h1>
          </div>

          <div class="row">
            <div class="col-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="card-body">
                  <router-link :to="{ name: 'categoryCreate' }" class="btn btn-primary mb-3">Create New Category</router-link>

                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="posts.length == 0">
                        <td colspan="4" class="text-center">Category Not Found</td>
                      </tr>
                      <tr v-else v-for="(category, index) in categories" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.slug }}</td>
                        <td>
                          <router-link :to="'/dashboard/category/edit/' + category.id" class="text-dark badge btn-warning">Edit</router-link>
                          <button @click.prevent="CategoryDelete(category.id, index)" class="text-dark badge btn-danger border-0">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
        categories: [],
        pageOfPosts: []
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Categories | HL Blog'
      })
    },
    mounted(){
      this.axios.get('/api/categories').then(res => {
        this.categories = res.data.data
      })
    },
    methods: {
      CategoryDelete(id, index){
        this.$swal({
          title: 'Are you sure?',
          text: "to delete this category and it posts",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33'
        }).then((result) => {
          if (result.isConfirmed) {
            this.axios.delete(`/api/category/${id}`).then(res => {
              this.categories.splice(index, 1)
              this.$swal(
                'Deleted!',
                'Your category has been deleted.',
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