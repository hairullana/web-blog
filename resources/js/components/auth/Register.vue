<template>
  <div class="row align-items-center">
    <div class="col-lg-5">
      <main class="form-registration">
        <h1 class="text-center h3 mb-3 fw-normal">Registration Form</h1>
        <form @submit.prevent="Register">
          <div class="form-floating">
            <input type="text" class="form-control rounded-top" id="name" v-model="form.name" placeholder="full name" required>
            <label for="name">Full name</label>
            <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="username" v-model="form.username" placeholder="usernmame" required>
            <label for="username">Username</label>
            <div v-if="errors.username" class="invalid-feedback">{{ errors.username[0] }}</div>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" id="email" v-model="form.email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
            <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control rounded-bottom" id="password" v-model="form.password" placeholder="password" required>
            <label for="password">Password</label>
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</div>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control rounded-bottom" id="password_confirmation" v-model="form.password_confirmation" placeholder="password" required>
            <label for="password_confirmation">Retype Password</label>
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</div>
          </div>
      
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
        </form>

        <div class="d-block text-center mt-3">
          <small>Already registered? <router-link :to="{ name: 'login' }">Login!</router-link></small>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default{
  data() {
    return {
      form: {
        name: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: []
    }
  },
  beforeRouteEnter (to, from, next) {
    next( async vm => {
        document.title = 'Register | HL Blog'
    })
  },
  methods: {
    Register(){
      axios.post('/api/register', this.form).then(res => {
        this.$toasted.show('Register successfully', { 
          type: 'success',
          theme: "bubble", 
          position: "top-right", 
          duration : 3000
        }).then(
          this.$router.push({name: 'dashboard' })
        )
      }).catch(err => {
        this.$toasted.show(err.response.data.message, { 
          type: 'error',
          theme: "bubble", 
          position: "top-right", 
          duration : 3000
        })
        this.errors = err.response.data.errors
      })
    }
  }
}
</script>