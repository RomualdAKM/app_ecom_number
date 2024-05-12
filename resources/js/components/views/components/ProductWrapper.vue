<script setup>
import {modifiedPrice} from "../../../compositions/helpers";
import { useShoppingStore } from './../../../stores/pinia.js'

const props = defineProps({
    products: Object
})

const data = useShoppingStore();


</script>

<template>
    <!-- product wrapper -->
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6">
        <!-- single product -->
        <div v-for="product in products"  :key="product.id" class="group rounded bg-white shadow overflow-hidden">
            <!-- product image -->
            <div class="relative product">
                <!-- Image principale -->
                <img
                :src="'/storage/' + product.hover_image" class="w-full"
                    :alt="product.name"
                >
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                    <router-link :to="'/product/' + product.id"
                                 class="text-white text-lg w-9 h-9 rounded-full bg-green-900 hover:bg-gray-800 transition flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </router-link>
                    <a href="#"
                       class="text-white text-lg w-9 h-9 rounded-full bg-green-900 hover:bg-gray-800 transition flex items-center justify-center">
                        <i class="far fa-heart"></i>
                    </a>
                </div>
            </div>
            <!-- product image end -->
            <!-- product content -->
            <div class="pt-4 pb-3 px-4">
                <router-link :to="'/product/' + product.id">
                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-green-900 transition">
                        {{ product.name }}
                    </h4>
                </router-link>
                <div class="flex items-baseline mb-1 space-x-2">
                    <p class="text-xl text-green-900 font-roboto font-semibold">{{ parseFloat(product.price).toFixed(0) }} F CFA</p>
                    <p class="text-sm text-gray-400 font-roboto line-through">{{ modifiedPrice(product.price) }} F CFA</p>
                </div>
            </div>
            <!-- product content end -->
            <!-- product button -->
            <button @click="data.addToCart(product)"
               class="block w-full py-1 text-center text-white bg-green-900 border border-green-900 rounded-b hover:bg-transparent hover:text-green-900 transition">
                Ajouter au panier
            </button>
            <!-- product button end -->
        </div>
        <!-- single product end -->
    </div>
    <!-- product wrapper end -->
</template>

<style scoped>
.product:hover .hover-image{
    display: block;
}
</style>
