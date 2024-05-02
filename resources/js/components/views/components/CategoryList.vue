<script setup>
/**
 * Ce composant sera responsable de l'affichage des categories
 * récupérées depuis l'API
 */

import axios from "axios";
import {onMounted} from "vue";
import useCateogiries from "../../../compositions/categories";

const { categories, getCategories } = useCateogiries();
onMounted( async () => {
   await getCategories()
} );
</script>

<template>
    <!-- categories -->
    <div class="container py-16" id="acheterMaintenant">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">Achat par catégorie</h2>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-3">
            <!-- single category -->
            <div v-for="category in categories" :key="category.id" class="relative group rounded-sm overflow-hidden" >
                <img src="images/category/category.jpg" class="w-full" alt="">
                <router-link :to="{name: 'category-products', params:{name: category.name} }" class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 flex items-center justify-center text-xl text-white
                    font-roboto font-medium tracking-wide transition">
                    {{ category.name }}
                </router-link>
            </div>
            <!-- single category end -->
        </div>
    </div>
    <!-- categories end -->
</template>

<style scoped>

</style>
