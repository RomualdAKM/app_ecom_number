<script>
import {modifiedPrice} from "../../../compositions/helpers";

export default {
    methods: {modifiedPrice},
    props:['products']
}
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
                    :src="product.image" class="w-full"
                    :alt="product.name"
                >
                <!-- Image au survol -->
                <img
                    :src="product.hover_image"
                    :alt="product.name"
                    class="w-full absolute inset-0 hidden hover-image"
                />
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                    <router-link :to="'/product/' + product.id"
                                 class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </router-link>
                    <a href="#"
                       class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                        <i class="far fa-heart"></i>
                    </a>
                </div>
            </div>
            <!-- product image end -->
            <!-- product content -->
            <div class="pt-4 pb-3 px-4">
                <router-link :to="'/product/' + product.id">
                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                        {{ product.name }}
                    </h4>
                </router-link>
                <div class="flex items-baseline mb-1 space-x-2">
                    <p class="text-xl text-primary font-roboto font-semibold">{{ parseFloat(product.price).toFixed(0) }} F CFA</p>
                    <p class="text-sm text-gray-400 font-roboto line-through">{{ modifiedPrice(product.price) }} F CFA</p>
                </div>
            </div>
            <!-- product content end -->
            <!-- product button -->
            <a href="#"
               class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                Add to Cart
            </a>
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
