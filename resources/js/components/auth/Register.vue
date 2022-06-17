<template>
  <div class="d-flex justify-content-center mt-5">
    <div class="col-lg-4">
      <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
          <router-link class="nav-link shadow" id="tab-login" data-mdb-toggle="pill" :to="{ name: 'login' }" role="tab"
            aria-controls="pills-login" aria-selected="true">Login</router-link>
        </li>
        <li class="nav-item" role="presentation">
          <router-link class="nav-link shadow active" id="tab-register" data-mdb-toggle="pill" :to="{ name: 'register' }" role="tab"
            aria-controls="pills-register" aria-selected="false">Register</router-link>
        </li>
      </ul>

      <main class="form-registration">
        <h1 class="text-center h3 mb-3 fw-normal my-4">Registration Form</h1>
        <form @submit.prevent="Register">
          <div class="form-floating">
            <label for="name">Full name</label>
            <input type="text" class="form-control rounded-top" id="name" v-model="form.name" placeholder="full name" required>
            <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
          </div>
          <div class="form-floating">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" v-model="form.username" placeholder="usernmame" required>
            <div v-if="errors.username" class="invalid-feedback">{{ errors.username[0] }}</div>
          </div>
          <div class="form-floating">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" v-model="form.email" placeholder="name@example.com" required>
            <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
          </div>
          <div class="form-floating">
            <label for="password">Password</label>
            <input type="password" class="form-control rounded-bottom" id="password" v-model="form.password" placeholder="password" required>
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</div>
          </div>
          <div class="form-floating">
            <label for="password_confirmation">Retype Password</label>
            <input type="password" class="form-control rounded-bottom" id="password_confirmation" v-model="form.password_confirmation" placeholder="password" required>
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