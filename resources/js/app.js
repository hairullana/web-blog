require('./bootstrap')

window.Vue = require('vue').default

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueAxios from 'vue-axios'
import axios from 'axios'
import App from './App.vue'

Vue.use(VueAxios, axios)

import Index from './components/posts/Index.vue'
import Create from './components/posts/Create.vue'
import Edit from './components/posts/Edit.vue'

const routes = [
  {
    name: 'posts',
    path: '/',
    component: Index
  },
  {
    name: 'create',
    path: '/create',
    component: Create
  },
  {
    name: 'edit',
    path: '/edit:id',
    component: Edit
  }
]

const router = new VueRouter({
  mode: 'history',
  routes: routes
})

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')