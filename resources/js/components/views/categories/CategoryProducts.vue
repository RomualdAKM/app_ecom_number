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
import MobileSidebar from "../components/MobileSidebar.vue";
import MobileMenubar from "../components/MobileMenubar.vue";

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

const critere = ref('default');
const filterProducts = async () => {
    // Copie de la liste des produits pour ne pas modifier les données d'origine
    let filteredProducts = [...categoryProducts.value];

    // Filtrer les produits en fonction du critère sélectionné
    if (critere.value === 'asc') {
        filteredProducts.sort((a, b) => a.price - b.price);
    } else if (critere.value === 'desc') {
        filteredProducts.sort((a, b) => b.price - a.price);
    } else if (critere.value === 'last') {
        filteredProducts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    }

    // Mise à jour de la liste des produits avec les produits filtrés
    categoryProducts.value = critere.value === 'default' ? [...categoryProducts.value] : filteredProducts;
}

</script>

<template>
    <Header />

    <NavBar />

    <!-- breadcrum -->
    <div class="container py-4 flex justify-between">
        <div class="flex gap-3 items-center">
            <a href="/" class="text-secondary text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <p class="text-gray-600 font-medium">Les produits de la catégorie {{ props.name }}</p>
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
                class="bg-green-900 border border-green-900 text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition lg:hidden text-sm mr-3 focus:outline-none">
                Filtre
                </button>
                <form action="" id="">
                    <select v-model="critere" @change="filterProducts"
                        class="w-44 text-sm text-gray-600 px-4 py-3 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                        <option value="default">Tri par défault</option>
                        <option value="asc">Prix bas-élevé</option>
                        <option value="desc">Prix élevé-bas</option>
                        <option value="last">Dernier produit</option>
                    </select>
                </form>
                <!--<div class="flex gap-2 ml-auto">
                    <div
                        class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                        <i class="fas fa-th"></i>
                    </div>
                    <div
                        class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                        <i class="fas fa-list"></i>
                    </div>
                </div>-->
            </div>
            <!-- sorting end -->
            <!-- product wrapper -->
            <ProductWrapper :products="categoryProducts" />
            <!-- product wrapper end -->
        </div>
        <!-- products end -->
    </div>
    <!-- mobile menubar -->
    <MobileMenubar />
    <!-- mobile menu end -->

    <!-- mobile sidebar menu -->
    <MobileSidebar />
    <!-- mobile sidebar menu end -->
</template>

<style scoped>

</style>
