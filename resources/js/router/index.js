import { createRouter, createWebHistory } from 'vue-router'
import index from '../components/views/index.vue'
import notFound from '../components/notFound.vue'
import ShowProduct from "../components/views/products/ShowProduct.vue";
import RelatedProduct from "../components/views/products/RelatedProduct.vue";
import CategoryProducts from "../components/views/categories/CategoryProducts.vue";

const routes = [
    {
        path: '/',
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
        path: '/:pathMatch(.*)*',
        component: notFound,
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,

})

export default router
