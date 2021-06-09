import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.config.productionTip = false
Vue.use(VueRouter)

import Dashboard from './components/Dashboard.vue'
import ScoreSheet from './components/ScoreSheet.vue'
import PlayerForm from './components/PlayerForm.vue'

const routes = [
  { path: '/scoresheet', component: ScoreSheet },
  { path: '/player', component: PlayerForm },
  { path: '/dashboard', component: Dashboard }

]

const router = new VueRouter({
  mode: 'history',
  routes
})

new Vue({
  router,
  render: h => h(Dashboard)
}).$mount('#app')
