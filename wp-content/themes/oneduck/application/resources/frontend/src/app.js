import Vue from 'vue/dist/vue.js'
import router from './core/router'
import store from './core/store'

import '@core/scss/main.scss'

import '@/globalComponents'

window.Vue = Vue

Vue.config.productionTip = false

new Vue({
    el: '#app',
    router,
    store
})