<template>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <router-link class="sidebar-brand d-flex align-items-center justify-content-center" :to="{ name: 'dashboard' }">
      <div class="sidebar-brand-icon">
        <i class="bi bi-speedometer2"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Dashboard</div>
    </router-link>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      Content
    </div>
    <li class="nav-item">
      <router-link class="nav-link collapsed" :to="{name: 'categories'}">
        <i class="fas fa-fw fa-pie-chart"></i>
        <span>Categories</span>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link collapsed" :to="{ name: 'posts' }">
        <i class="fas fa-fw fa-book"></i>
        <span>Posts</span>
      </router-link>
    </li>
    <hr class="sidebar-divider">

    <div v-if="user.is_admin">
      <div class="sidebar-heading">
        Admin
      </div>
      <li class="nav-item">
        <router-link class="nav-link collapsed" to="https://google.com">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </router-link>
      </li>
      <hr class="sidebar-divider">
    </div>

    <div class="sidebar-heading">
      Links
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/">
        <i class="fas fa-fw fa-home"></i>
        <span>Back to home</span>
      </a>
    </li>  
  </ul>
</template>

<script>
export default{
  data() {
    return {
      user: {}
    }
  },
  mounted(){
    this.axios.get('/api/user').then(res => {
      this.user = res.data
    })
  }
}
</script>