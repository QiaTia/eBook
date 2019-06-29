import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router'
import '@/assets/style/icon.css'
import '@/assets/style/global.css'

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
Vue.prototype.axios = axios