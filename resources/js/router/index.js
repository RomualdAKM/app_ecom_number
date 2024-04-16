import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import login from '../components/views/pages/auth/login.vue'
import register from '../components/views/pages/auth/register.vue'
import notFound from '../components/notFound.vue'
import ShowProduct from "../components/views/products/ShowProduct.vue";
import CategoryProducts from "../components/views/categories/CategoryProducts.vue";
import indexDashboard from "../components/views/dashboard/DashboardIndex.vue";
import ProductIndex from "../components/views/dashboard/ProductIndex.vue";
import CategoryIndex from "../components/views/dashboard/CategoryIndex.vue";
import cart from "../components/views/components/Cart.vue"

const routes = [
    {
        path: '/',
        name: 'index',
        component: index,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: login,
        meta: {
            requiresAuth: false
        }
    },

    {
        path: '/register',
        name: 'register',
        component: register,
        meta: {
            requiresAuth: false
        }
    },
    
    {
        path: '/cart',
        name: 'cart',
        component: cart,
        meta: {
            requiresAuth: true
        }
    },
   

    // Routes pour afficher les détails d'un produit
    {
        path: '/product/:id',
        name: 'product',
        component: ShowProduct,
        props: true,
        meta: {
            requiresAuth: false
        }
    },

    {
        path: '/category-products/:name',
        name: 'category-products',
        component: CategoryProducts,
        props: true,
        meta: {
            requiresAuth: false
        }
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

        ],
        meta: {
            requiresAuth: true
        }
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

router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return { name: 'login' }
    }

    // if(to.meta.requiresAuth == false && localStorage.getItem('token')){
    //     return { name: 'index' }
    // }
})


export default router
