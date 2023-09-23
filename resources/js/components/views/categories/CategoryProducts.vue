<script setup>
import useCateogiries from "../../../compositions/categories";
import {onMounted, ref, watch} from "vue";
import Header from "../components/header.vue";
import NavBar from "../components/NavBar.vue";
import CategorySidebar from "../components/CategorySidebar.vue";
import ProductWrapper from "../components/ProductWrapper.vue";
import Footer from "../components/Footer.vue";
import Copyright from "../components/Copyright.vue";
import {useRoute} from "vue-router";

const route = useRoute()
const name = ref(route.params.name)
const props = defineProps( {
    name: String
});

watch(route, async () => {
    name.value = route.params.name;
    getCategoryProducts(props.name);
})

const { categoryProducts, getCategoryProducts  } = useCateogiries();

onMounted(()=>{
    const categoryName = props.name
    getCategoryProducts(categoryName);
})

</script>

<template>
    <Header />

    <NavBar />

    <!-- breadcrum -->
    <div class="container py-4 flex justify-between">
        <div class="flex gap-3 items-center">
            <a href="index.html" class="text-primary text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <p class="text-gray-600 font-medium">Shop</p>
        </div>
    </div>
    <!-- breadcrum end -->

    <!-- shop wrapper -->
    <div class="container grid lg:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
        <!-- Category sidebar -->
        <CategorySidebar />
        <!-- Category sidebar end -->

        <!-- products -->
        <div class="col-span-3">
            <!-- sorting -->
            <div class="mb-4 flex items-center">
                <button @click="showFilter=!showFilter"
                class="bg-primary border border-primary text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition lg:hidden text-sm mr-3 focus:outline-none">
                Filter
                </button>
                <select
                    class="w-44 text-sm text-gray-600 px-4 py-3 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                    <option>Default sorting</option>
                    <option>Price low-high</option>
                    <option>Price high-low</option>
                    <option>Latest product</option>
                </select>
                <div class="flex gap-2 ml-auto">
                    <div
                        class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                        <i class="fas fa-th"></i>
                    </div>
                    <div
                        class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                        <i class="fas fa-list"></i>
                    </div>
                </div>
            </div>
            <!-- sorting end -->
            <!-- product wrapper -->
            <ProductWrapper :products="categoryProducts" />
            <!-- product wrapper end -->
        </div>
        <!-- products end -->
    </div>
    <!-- shop wrapper end -->

    <Footer />

    <Copyright />
</template>

<style scoped>

</style>
