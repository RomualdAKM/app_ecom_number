<script >
/**
 * Ce composant sera responsable de l'affichage des 4 produits
 * récemment ajoutés, récupérées depuis l' API
 */

import axios from "axios";
import {modifiedPrice} from "../../../compositions/helpers";
import ProductWrapper from "./ProductWrapper.vue";
import useProducts from "../../../compositions/products";
import {onMounted} from "vue";
export default {
    components: {ProductWrapper},
    setup (){
        const { products, getProducts } = useProducts();

        onMounted( () => {
          getProducts()
        });

        return {
            products
        }

    },

}
</script>

<template>
    <!-- top new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">top new arrival</h2>
        <!-- product wrapper -->
        <ProductWrapper :products="this.products.slice(0,8)" />
    </div>
    <!-- top new arrival end -->
</template>

<style scoped>

</style>
