<script>
import axios from "axios";
import useCateogiries from "../../../compositions/categories";
import {onMounted} from "vue";

export default {
    setup(){
        const { categories, getCategories } = useCateogiries();

        onMounted( () =>{
            getCategories()
        } );

        return {
            categories
        }
    }
}
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
                        <input type="checkbox" id="Bedroom"
                               class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="Bedroom" class="text-gray-600 ml-3 cursor-pointer">{{ category.name }}</label>
                        <div class="ml-auto text-gray-600 text-sm">(15)</div>
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
