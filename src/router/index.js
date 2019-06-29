import Vue from 'vue'
import Router from 'vue-router'
import index from '@/components/index'
import shelf from '@/components/shelf/index'
import user from '@/components/user/index'
import store from '@/components/store/index'
import bookInfo from '@/components/store/bookInfo'
import reader from '@/components/reader/reader'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      component: index,
      children:[
        { 
          path: '/', 
          name:'shelf', 
          component: shelf
        },
        { 
          path: '/user', 
          name:'user', 
          component: user
        },
        { 
          path: '/store',
          name: 'store',
          component: store
        }
      ]
    },
    {
      path: '/reader/',
      name: 'reader',
      component: reader
    },{
      path: '/store/bookInfo',
      name: 'bookInfo',
      component: bookInfo
    }
  ]
})
