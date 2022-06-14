<template>
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hairul Lana</span>
          <img class="img-profile rounded-circle" src="http://ngeewap.xtgem.com/files/hl.jpg">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#"><i class="text-muted fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
          <a class="dropdown-item" href="#"><i class="text-muted fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Settings</a>
          <a class="dropdown-item" href="#"><i class="text-muted fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
          <div class="dropdown-divider"></div>
          <a @click.prevent="Logout" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>

export default {
  data(){
    return {
      user: null
    }
  },
  mounted() {
    this.axios.get('/api/user').then(res => {
      this.user = res.data
    })
  },
  methods: {
    Logout() {
      axios.post('/api/logout').then(() => {
        this.$router.push({ name: 'login' })
      })
    }
  }
}
</script>
