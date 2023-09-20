<script>

import axios from "axios";
import {modifiedPrice} from "../../../compositions/helpers";
import RelatedProduct from "./RelatedProduct.vue";
import useCateogiries from "../../../compositions/categories";
import {onMounted} from "vue";
import useProducts from "../../../compositions/products";
export default {
    components: {RelatedProduct},
    methods: {modifiedPrice},
    props: {
        id: Number
    },
    watch: {
        '$route.params.id': {
            handler(){
                location.reload()
            }
        }
    },
    setup(props){
        const { product, getProduct  } = useProducts();

        onMounted(()=>{
            getProduct(props.id);
        })

        return {
            product
        }
    }
}
</script>

<template>
    <!-- header -->

    <!-- header end -->

    <!-- navbar -->

    <!-- navbar end -->

    <!-- mobile menubar -->

    <!-- mobile menu end -->

    <!-- mobile sidebar menu -->

    <!-- mobile sidebar menu end -->

    <!-- breadcrum -->

    <!-- breadcrum end -->

    <!-- product view -->
    <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6">
        <!-- product image -->
        <div>
            <div class="relative product">
                <img id="main-img" :src="product.image" :alt="product.name" class="w-full">
                <!-- Image au survol -->
                <img
                    :src="product.hover_image"
                    :alt="product.name"
                    class="w-full absolute inset-0 hidden hover-image"
                />
            </div>
        </div>
        <!-- product image end -->
        <!-- product content -->
        <div>
            <h2 class="md:text-3xl text-2xl font-medium uppercase mb-2">{{ product.name }}</h2>

            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Availability: </span>
                    <span class="text-green-600">In Stock</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span v-if="product.category" class="text-gray-600">{{ product.category.name }}</span>
                </p>
            </div>
            <div class="mt-4 flex items-baseline gap-3">
                <span v-if="product" class="text-primary font-semibold text-xl">{{ parseFloat(product.price).toFixed(0) }} FCFA</span>
                <span class="text-gray-500 text-base line-through">{{ modifiedPrice(product.price) }} FCFA</span>
            </div>

            <!-- add to cart button -->
            <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6">
                <a href="#" class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase
                    hover:bg-transparent hover:text-primary transition text-sm flex items-center">
                    <span class="mr-2"><i class="fas fa-shopping-bag"></i></span> Add to cart
                </a>
                <a href="#" class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase
                    hover:bg-transparent hover:text-primary transition text-sm">
                    <span class="mr-2"><i class="far fa-heart"></i></span> Wishlist
                </a>
            </div>
            <!-- add to cart button end -->
            <!-- product share icons -->
            <div class="flex space-x-3 mt-4">
                <a href="#"
                   class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#"
                   class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#"
                   class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <!-- product share icons end -->
        </div>
        <!-- product content end -->
    </div>
    <!-- product view end -->

    <!-- product description and review -->
    <div class="container pb-16">
        <!-- description buttons -->
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">
            Product description
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
    </div>
    <!-- product description and review end -->

    <!-- related products -->
    <RelatedProduct
        v-if="product.id && product.category_id"
        :currentProductId="product.id || 0"
        :categoryId="product.category_id || 0"
    />
    <!-- related products end -->

    <!-- footer -->

    <!-- footer end -->

    <!-- copyright -->

    <!-- copyright end -->
</template>

<style scoped>
.product:hover .hover-image{
    display: block;
}
</style>
