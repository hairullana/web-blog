<template>
  <div class="d-flex justify-content-center mt-5">
    <div class="col-md-4">
      <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <router-link class="nav-link shadow active" id="tab-login" data-mdb-toggle="pill" :to="{ name: 'login' }" role="tab"
            aria-controls="pills-login" aria-selected="true">Login</router-link>
        </li>
        <li class="nav-item" role="presentation">
          <router-link class="nav-link shadow" id="tab-register" data-mdb-toggle="pill" :to="{ name: 'register' }" role="tab"
            aria-controls="pills-register" aria-selected="false">Register</router-link>
        </li>
      </ul>

      <main class="form-signin">
        <h1 class="text-center h3 mb-3 fw-normal my-4">Please login</h1>

        <form @submit.prevent="Login">
          <div class="form-floating">
            <label for="user">Email / Username</label>
            <input type="text" class="form-control" id="email" v-model="form.user" placeholder="name@example.com" required autofocus>
          </div>
          <div class="form-floating">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password" required>
          </div>
      
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="login">Login</button>
        </form>

        <div class="d-block text-center mt-3">
          <small>Not registered? <router-link :to="{ name: 'register' }">Register now!</router-link></small>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default{
  data(){
    return {
      form: {
        user: '',
        password: ''
      }
    }
  },
  beforeRouteEnter (to, from, next) {
    next( async vm => {
        document.title = 'Login | HL Blog'
    })
  },
  methods: {
    Login(){
      axios.post('/api/login', this.form).then(res => {
        this.$router.push({name: 'dashboard' })
      }).catch(err => {
        this.$toasted.show('Login failed! User or password is wrong!', { 
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
