<template>
  <div class="row justify-content-center">
    <div class="col-md-5">
      <main class="form-signin">
        <h1 class="text-center h3 mb-3 fw-normal">Please login</h1>

        <form @submit.prevent="Login">
          <div class="form-floating">
            <input type="text" class="form-control" id="email" v-model="form.user" placeholder="name@example.com" required autofocus>
            <label for="user">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>
      
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
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
