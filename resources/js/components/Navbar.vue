<template>
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ user.name }}</span>
          <img class="img-profile rounded-circle" src="http://ngeewap.xtgem.com/files/hl.jpg">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <router-link class="dropdown-item" :to="{name: 'profile'}"><i class="text-muted fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</router-link>
          <div class="dropdown-divider"></div>
          <a @click.prevent="Logout" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>

export default {
  methods: {
    Logout() {
      axios.post('/api/logout').then(() => {
        this.$router.push({ name: 'login' })
      })
    }
  },
  props: [
    'user'
  ]
}
</script>
