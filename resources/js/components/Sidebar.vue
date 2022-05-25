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
        <i class="fas fa-fw fa-wrench"></i>
        <span>Categories</span>
      </router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link collapsed" :to="{ name: 'posts' }">
        <i class="fas fa-fw fa-cog"></i>
        <span>Posts</span>
      </router-link>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      Links
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/">
        <i class="fas fa-fw fa-folder"></i>
        <span>Back to home</span>
      </a>
    </li>  
  </ul>
</template>