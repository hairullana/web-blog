<template>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
          <!-- Sidebar - Brand -->
          <router-link class="sidebar-brand d-flex align-items-center justify-content-center" :to="{ name: 'categoryCreate' }">
              <div class="sidebar-brand-icon rotate-n-15">
                  <i class="bi bi-123"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Dashboard</div>
          </router-link>
  
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
  
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
              <a class="nav-link" href="index.html">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
          </li>
  
          <!-- Divider -->
          <hr class="sidebar-divider">
  
          <!-- Heading -->
          <div class="sidebar-heading">
            Content
          </div>
  
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Posts</span>
              </a>
          </li>
  
          <!-- Nav Item - Utilities Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#">
                  <i class="fas fa-fw fa-wrench"></i>
                  <span>Categories</span>
              </a>
          </li>
  
          <!-- Divider -->
          <hr class="sidebar-divider">
  
          <!-- Heading -->
          <div class="sidebar-heading">
            Links
          </div>
  
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#">
                  <i class="fas fa-fw fa-folder"></i>
                  <span>Back to home</span>
              </a>
          </li>  
      </ul>
      <!-- End of Sidebar -->
</template>