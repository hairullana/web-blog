<template>
  <div id="wrapper">
    <Sidebar :user="user" />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <Navbar :user="user" />
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><router-link class="path-link" :to="{ name: 'dashboard' }">Dashboard</router-link> / Users</h1>
          </div>

          <div class="row">
            <div class="col-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="users.length == 0">
                        <td colspan="6" class="text-center">User Not Found</td>
                      </tr>
                      <tr v-else v-for="(user_temp, index) in pageOfUsers" :key="user_temp.id">
                        <td>{{ user_temp.name }}</td>
                        <td>{{ user_temp.username }}</td>
                        <td>{{ user_temp.email }}</td>
                        <td>{{ formatDate(user_temp.created_at) }}</td>
                        <td>{{ user_temp.is_admin ? 'Admin' : 'User' }}</td>
                        <td>
                          <button @click.prevent="UserDelete(user_temp.id, index)" class="text-dark badge btn-danger border-0">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- paginate -->
                  <div class="card-footer pb-3 pt-3 d-flex justify-content-center">
                    <jw-pagination :pageSize=10 :items="users" @changePage="onChangePage"></jw-pagination>
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
        users: [],
        pageOfUsers: [],
        user: {}
      }
    },
    beforeRouteEnter (to, from, next) {
      next( async vm => {
          document.title = 'Users | HL Blog'
      })
    },
    mounted(){
      this.axios.get('/api/user').then(res => {
        this.user = res.data;
      });
      this.axios.get('/api/users').then(res => {
        this.users = res.data;
      });
    },
    methods: {
      UserDelete(id, index){
        this.$swal({
          title: 'Are you sure?',
          text: "to delete this user with his/her users?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33'
        }).then((result) => {
          if (result.isConfirmed) {
            this.axios.delete(`/api/users/${id}`).then(res => {
              this.users.splice(index, 1)
              if(res.data.status) {
                this.$swal(
                  'Deleted!',
                  res.data.message,
                  'success'
                );
              } else {
                this.$swal(
                  'Deleted!',
                  res.data.message,
                  'success'
                );
              }
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
      onChangePage(pageOfUsers) {
        // update page of User
        this.pageOfUsers = pageOfUsers;
      },
      formatDate(value) {
        let date = new Date(value);
        const day = date.toLocaleString('default', { day: '2-digit' });
        const month = date.toLocaleString('default', { month: 'short' });
        const year = date.toLocaleString('default', { year: 'numeric' });
        return day + '-' + month + '-' + year;
      }
    }
  }
</script>