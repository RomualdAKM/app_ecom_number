<script setup>
import { useShoppingStore } from './../../../stores/pinia.js'
import useCateogiries from "../../../compositions/categories";
import {onMounted} from "vue";

const { categories, getCategories } = useCateogiries();

onMounted( () =>{
    getCategories()
});
const data = useShoppingStore();
</script>

<template>
    <!-- mobile menubar -->
    <div
        class="fixed w-full border-t border-gray-200 shadow-sm bg-white py-3 bottom-0 left-0 flex justify-around items-start px-6 lg:hidden z-40">
        <a href="javascript:void(0)" class="block text-center text-gray-700 hover:text-primary transition relative">
            <div class="text-2xl" id="menuBar">
                <i class="fas fa-bars"></i>
            </div>
            <div class="text-xs leading-3">Menu</div>
        </a>
        <div class="px-8 py-4 flex items-center cursor-pointer group relative">
        <span class="text-2xl">
            <i class="fas fa-list-ul"></i>
        </span>
            <span class="capitalize ml-2 ">Toutes les categories</span>

            <div class="absolute left-0 bottom-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed md:top-full">
                <!-- single category -->
                <router-link v-for="category in categories" :key="category.id" :to="{name: 'category-products', params: {name: category.name}}" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
                    <span class="ml-6 text-gray-600 text-sm">{{ category.name }}</span>
                </router-link>
                <!-- single category end -->
            </div>
        </div>

        <!--        <a href="#" class="block text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="text-xs leading-3">Search</div>
                </a>-->
        <router-link to="/cart" class="text-center text-gray-700 hover:text-primary transition relative">
            <span
                class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                {{data.countCartItems}}
            </span>
            <div class="text-2xl">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="text-xs leading-3">Panier</div>
        </router-link>
    </div>
    <!-- mobile menu end -->
</template>

<style scoped>

</style>
