import { createRouter, createWebHistory } from 'vue-router/dist/vue-router.esm-bundler'
import { routes } from './routes'

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
