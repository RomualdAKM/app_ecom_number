import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import login from '../components/views/pages/auth/login.vue'
import register from '../components/views/pages/auth/register.vue'
import notFound from '../components/notFound.vue'
import ShowProduct from "../components/views/products/ShowProduct.vue";
import CategoryProducts from "../components/views/categories/CategoryProducts.vue";
import dashboardIndex from "../components/views/dashboard/index.vue";
import ProductIndex from "../components/views/dashboard/ProductIndex.vue";
import CategoryIndex from "../components/views/dashboard/CategoryIndex.vue";
import profil from "../components/views/dashboard/profil.vue";
import cart from "../components/views/components/Cart.vue"
import code from "../components/views/dashboard/code.vue";
// import code from "@/components/views/dashboard/code.vue";

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

    // Routes pour le dashboard
    {
        path: '/dashboard',
        name: 'dashboard',
        component: dashboardIndex,
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
            {
                path: 'profil',
                component: profil,
                name: 'dashboard-profil',
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'code',
                component: code,
                name: 'dashboard-code',
                meta: {
                    requiresAuth: true
                }
            },


        ]   ,
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
