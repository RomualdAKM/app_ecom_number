<script>
import {modifiedPrice} from "../../../compositions/helpers";
import ProductWrapper from "./ProductWrapper.vue";
import useProducts from "../../../compositions/products";
import {onMounted} from "vue";

/**
 * Ce composant sera responsable de l'affichage des produits similaires.
 * Produits de la même catégories
 */
export default {
    components: {ProductWrapper},
    methods: {},
    props: {
        categoryId: {
            type: Number,
            required: true,
        },
        currentProductId: {
            type: Number,
            required: true,
        },
    },
    setup(props){
        const { relatedProducts, getRelatedProducts  }= useProducts();

        onMounted(()=>{
            getRelatedProducts(props.categoryId, props.currentProductId);
        })

        return {
            relatedProducts
        }
    }
}
</script>

<template>
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">related products</h2>
        <!-- product wrapper -->
        <ProductWrapper :products="this.relatedProducts" />
    </div>
</template>

<style scoped>

</style>
