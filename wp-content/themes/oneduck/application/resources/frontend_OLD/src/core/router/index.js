import Vue from 'vue/dist/vue.js'
import VueRouter from 'vue-router'
import {routes} from './routes'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router