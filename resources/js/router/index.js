import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import login from '../components/views/pages/auth/login.vue'
import register from '../components/views/pages/auth/register.vue'
import notFound from '../components/notFound.vue'
import ShowProduct from "../components/views/products/ShowProduct.vue";
import RelatedProduct from "../components/views/components/RelatedProduct.vue";
import CategoryProducts from "../components/views/categories/CategoryProducts.vue";
import indexDashboard from "../components/views/dashboard/indexDashboard.vue";
import create from "../components/views/dashboard/categories/CategoryCreate.vue";
import indexCategorie from "../components/views/dashboard/categories/CategorieDashboard.vue";
import cart from "../components/views/components/Cart.vue"

const routes = [
    {
        path: '/',
        name: 'index',
        component: index
    },
    {
        path: '/login',
        component: login
    },

    {
        path: '/register',
        component: register
    },
    
    {
        path: '/cart',
        component: cart
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
                component: indexCategorie,
                name: 'dashboard-categories'
            }
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
