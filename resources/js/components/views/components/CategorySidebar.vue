<script setup>
import axios from "axios";
import useCateogiries from "../../../compositions/categories";
import {onMounted} from "vue";

const { categories, getCategories } = useCateogiries();

onMounted( () =>{
    getCategories()
});
/*const hideSidebar = () => {
    const closeIcon = document.getElementById('closeIcon');
    if (closeIcon) {
        closeIcon.addEventListener('click', () => {
            const sidebar = document.querySelector('.col-span-1');
            sidebar.style.display = 'none';
        });
    }
};*/
</script>

<template>
    <!-- sidebar -->
    <div
        class="col-span-1 bg-white px-4 pt-4 pb-6 shadow rounded overflow-hidden lg:static left-4 top-16 z-10 w-72 lg:w-full lg:block hidden lg:inline-block">
        <div class="divide-gray-200 divide-y space-y-5 relative">
            <!-- category filter -->
            <div class="relative">
                <div id="closeIcon" @click="hideSidebar"
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
                            :class="{'bg-green-900 text-white rounded-lg px-2 py-1': category.name === this.$route.params.name}"
                        >{{ category.name }}
                        </RouterLink>

                        <div class="ml-auto text-gray-600 text-sm" >
                            <!-- afficher Le nombre de produits dans le pays -->
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
