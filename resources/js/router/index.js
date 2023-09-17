import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import notFound from '../components/notFound.vue'

const routes = [
    {
        path: '/',
        component: index
    },
   

    {
        path: '/:pathMatch(.*)*',
        component: notFound,
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,

})

export default router
