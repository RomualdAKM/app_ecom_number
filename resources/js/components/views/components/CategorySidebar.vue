<script setup>
import axios from "axios";
import useCateogiries from "../../../compositions/categories";
import {onMounted} from "vue";

const { categories, getCategories } = useCateogiries();

onMounted( () =>{
    getCategories()
});
</script>

<template>
    <!-- sidebar -->
    <div
        class="col-span-1 bg-white px-4 pt-4 pb-6 shadow rounded overflow-hidden absolute lg:static left-4 top-16 z-10 w-72 lg:w-full lg:block">
        <div class="divide-gray-200 divide-y space-y-5 relative">
            <!-- category filter -->
            <div class="relative">
                <div
                    class="lg:hidden text-gray-400 hover:text-primary text-lg absolute right-0 top-0 cursor-pointer">
                    <i class="fas fa-times"></i>
                </div>
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                <div class="space-y-2">
                    <!-- single category -->
                    <div v-for="category in categories" :key="category.id" class="flex items-center">
                        <RouterLink
                            :to="{name:'category-products', params: {name: category.name}}"
                            class="ml-3 cursor-pointer"
                            :class="{'bg-primary text-white rounded-lg px-2 py-1': category.name === this.$route.params.name}"
                        >{{ category.name }}
                        </RouterLink>

                        <div class="ml-auto text-gray-600 text-sm" >
                            <!-- afficher Le nombre de produits dans la catégorie -->
                        </div>
                    </div>
                    <!-- single category end -->
                </div>
            </div>
            <!-- category filter end -->
        </div>
    </div>
    <!-- sidebar end -->
</template>

<style scoped>

</style>
