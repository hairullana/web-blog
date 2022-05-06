require('./bootstrap')

window.Vue = require('vue').default

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueAxios from 'vue-axios'
import axios from 'axios'
import App from './App.vue'

Vue.use(VueAxios, axios)

// JwPagination
import JwPagination from 'jw-vue-pagination'
Vue.component('jw-pagination', JwPagination);

import Dashboard from './components/Dashboard.vue'
import PostCreate from './components/posts/Create.vue'
import PostEdit from './components/posts/Edit.vue'
import CategoryEdit from './components/category/Edit.vue'
import CategoryCreate from './components/category/Create.vue'

import moment from 'moment'
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
});

const routes = [
  {
    name: 'dashboard',
    path: '/dashboard',
    component: Dashboard
  },
  {
    name: 'postCreate',
    path: '/dashboard/post/create',
    component: PostCreate
  },
  {
    name: 'postEdit',
    path: '/dashboard/post/edit/:id',
    component: PostEdit
  },
  {
    name: 'categoryCreate',
    path: '/dashboard/category/create',
    component: CategoryCreate
  },
  {
    name: 'categoryEdit',
    path: '/dashboard/category/edit/:id',
    component: CategoryEdit
  }
]

const router = new VueRouter({
  mode: 'history',
  routes: routes
})

const app = new Vue(
  Vue.util.extend(
    {router},
    App
  )
).$mount('#app')