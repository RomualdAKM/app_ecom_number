<script setup>

import axios from "axios";
import {modifiedPrice} from "../../../compositions/helpers";
import RelatedProduct from "../components/RelatedProduct.vue";
import useCateogiries from "../../../compositions/categories";
import {onMounted, ref, watch} from "vue";
import useProducts from "../../../compositions/products";
import Header from "../components/header.vue";
import NavBar from "../components/NavBar.vue";
import MobileSidebar from "../components/MobileSidebar.vue";
import MobileMenubar from "../components/MobileMenubar.vue";
import Footer from "../components/Footer.vue";
import Copyright from "../components/Copyright.vue";
import {useRoute} from "vue-router";
import { useShoppingStore } from './../../../stores/pinia.js'

const route = useRoute()
const name = ref(route.params.name)

watch(route, async () => {
    name.value = route.params.name;
    getProduct(props.id);
})

const props = defineProps( {
    id: Number,
    products: Object
});


const { product, getProduct  } = useProducts();

onMounted(() => {
    getProduct(props.id);
})

const data = useShoppingStore();


</script>

<template>
    <!-- header -->
    <Header />
    <!-- header end -->

    <!-- navbar -->
    <NavBar />
    <!-- navbar end -->

    <!-- mobile menubar -->
    <MobileMenubar />
    <!-- mobile menu end -->

    <!-- mobile sidebar menu -->
    <MobileSidebar />
    <!-- mobile sidebar menu end -->

    <!-- breadcrum -->

    <!-- breadcrum end -->

    <!-- product view -->
    <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6 mb-4">
        <!-- product image -->
        <div class="relative">
            <img id="main-img" :src="'/storage/' + product.hover_image" :alt="product.name" class="object-cover w-full rounded">
        </div>
        <!-- product image end -->

        <!-- product content -->
        <div>
            <h2 class="md:text-3xl text-2xl font-medium uppercase mb-2">{{ product.name }}</h2>

            <div class="space-y-2">
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span v-if="product.category" class="text-gray-600">{{ product.category.name }}</span>
                </p>
            </div>
            <div class="mt-4 flex items-baseline gap-3">
                <span v-if="product" class="text-green-800 font-semibold text-xl">{{ parseFloat(product.price).toFixed(0) }} FCFA</span>
                <span class="text-gray-500 text-base line-through">{{ modifiedPrice(product.price) }} FCFA</span>
            </div>

            <!-- add to cart button -->
            <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6">
                <a href="#" @click="data.addToCart(product)" class="bg-green-900 border border-gray-800 text-white px-8 py-2 font-medium rounded uppercase
                    hover:bg-transparent hover:text-black transition text-sm flex items-center">
                    <span class="mr-2"><i class="fas fa-shopping-bag"></i></span> Ajouter au panier
                </a>
                <a href="#" class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase
                    hover:bg-transparent hover:text-black transition text-sm">
                    <span class="mr-2"><i class="far fa-heart"></i></span> Favoris
                </a>
            </div>
            <!-- add to cart button end -->

            <div class="mt-4">
                <!-- product description and review -->
                    <!-- description buttons -->
                    <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">
                        Description du Produit
                    </h3>
                    <!-- description button end -->

                    <!-- description content -->
                    <div class="lg:w-4/5 xl:w-3/5 pt-6">
                        <div class="space-y-3 text-gray-600">
                            <p>
                                {{
                                    product.description
                                }}
                            </p>
                        </div>
                    </div>
                    <!-- description content end -->
                <!-- product description and review end -->
            </div>
        </div>
        <!-- product content end -->
    </div>
    <!-- product view end -->

    <!-- related products -->
    <RelatedProduct
        v-if="product.id && product.category_id"
        :currentProductId="product.id || 0"
        :categoryId="product.category_id || 0"
    />
    <!-- related products end -->

</template>

<style scoped>
.product:hover .hover-image{
    display: block;
}
</style>
