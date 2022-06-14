require('./bootstrap')

window.Vue = require('vue').default

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueAxios from 'vue-axios'
import axios from 'axios'
import App from './App.vue'

// trix editor
import 'vue-trix'
import VueTrix from "vue-trix"
Vue.use(VueTrix)
Vue.component('VueTrix', VueTrix)
// vue axios
Vue.use(VueAxios, axios)
// toastr alert
import Toasted from 'vue-toasted';
Vue.use(Toasted)
// JwPagination
import JwPagination from 'jw-vue-pagination'
Vue.component('jw-pagination', JwPagination);
// swal2
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
Vue.use(VueSweetalert2)

// component
import Dashboard from './components/Dashboard.vue'
import Categories from './components/category/Index.vue'
import CategoryEdit from './components/category/Edit.vue'
import CategoryCreate from './components/category/Create.vue'
import Posts from './components/posts/Index.vue'
import Login from './components/auth/Login.vue'
import PostEdit from './components/posts/Edit.vue'
import PostCreate from './components/posts/Create.vue'
import Register from './components/auth/Register.vue'

import moment from 'moment'
import Vue from 'vue'
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
});

const routes = [
  {
    name: 'dashboard',
    path: '/dashboard/overview',
    component: Dashboard,
    beforeEnter: (to, form, next) => {
      axios.get('/api/auth').then(() => {
        next()
      }).catch(() => {
        return next({ name: 'login' })
      })
    }
  },
  {
    name: 'categories',
    path: '/dashboard/categories',
    component: Categories
  },
  {
    name: 'categoryEdit',
    path: '/dashboard/category/edit/:id',
    component: CategoryEdit
  },
  {
    name: 'categoryCreate',
    path: '/dashboard/category/create',
    component: CategoryCreate
  },
  {
    name: 'posts',
    path: '/dashboard/posts',
    component: Posts
  },
  {
    name: 'postEdit',
    path: '/dashboard/post/edit/:id',
    component: PostEdit
  },
  {
    name: 'postCreate',
    path: '/dashboard/post/create',
    component: PostCreate
  },
  {
    name: 'register',
    path: '/dashboard/register',
    component: Register
  },
  {
    name: 'login',
    path: '/dashboard/login',
    component: Login
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