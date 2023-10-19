import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import notFound from '../components/notFound.vue'
import ShowProduct from "../components/views/products/ShowProduct.vue";
import CategoryProducts from "../components/views/categories/CategoryProducts.vue";
import indexDashboard from "../components/views/dashboard/DashboardIndex.vue";
import ProductIndex from "../components/views/dashboard/ProductIndex.vue";
import CategoryIndex from "../components/views/dashboard/CategoryIndex.vue";

const routes = [
    {
        path: '/',
        name: 'index',
        component: index
    },

    // Routes pour afficher les détails d'un produit
    {
        path: '/product/:id',
        component: ShowProduct,
        props: true
    },

    {
        path: '/category-products/:name',
        name: 'category-products',
        component: CategoryProducts,
        props: true
    },

    {
        path: '/dashboard',
        name: 'dashboard',
        component: indexDashboard,
        props: true,
        children:[
            {
                path: 'categories',
                component: CategoryIndex,
                name: 'dashboard-categories'
            },
            {
                path: 'products',
                component: ProductIndex,
                name: 'dashboard-products'
            },

        ]
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
