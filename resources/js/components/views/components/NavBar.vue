<script setup>
import useCateogiries from "../../../compositions/categories";
import {onMounted, ref} from "vue";
import router from "../../../router/index.js"

const { categories, getCategories } = useCateogiries();
const authUser = ref({});

onMounted( async() =>{
    await getCategories();
    await getInfoAuthUser();
});

const getInfoAuthUser = async () => {
    try {
        let response = await axios.get('/api/getAuthUser');
        authUser.value = response.data.data;
    } catch (error) {
        console.error('Error fetching auth user info:', error);
        authUser.value = null; // Si une erreur survient, considérer l'utilisateur comme déconnecté
    }
};

const logout = () => {
    sessionStorage.removeItem("token");
    router.push("/login");
};
</script>

<template>
    <!-- navbar -->
    <nav class="bg-gray-800 hidden lg:block">
        <div class="container">
            <div class="flex">

                <!-- all category -->
                <div class="px-8 py-4 bg-green-900 flex items-center cursor-pointer group relative">
                    <span class="text-white">
                        <i class="fas fa-bars"></i>
                    </span>
                    <span class="capitalize ml-2 text-white">Tout les pays</span>

                    <div class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed">
                        <!-- single category -->
                        <router-link  v-for="category in categories" :key="category.id" :to="{name: 'category-products', params: {name: category.name}}" class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
                            <span class="ml-6 text-gray-600 text-sm">{{ category.name }}</span>
                        </router-link>
                        <!-- single category end -->

                    </div>
                </div>
                <!-- all category end -->

                <!-- nav menu -->
                <div class="flex items-center justify-between flex-grow pl-12">
                    <div class="flex items-center space-x-6 text-base capitalize">
                        <router-link :to="{ name:'index' }" class="text-gray-200 hover:text-white transition">Accueil</router-link>
                        <a href="/#about" class="text-gray-200 hover:text-white transition">À Propos</a>
                        <!-- <a href="#" class="text-gray-200 hover:text-white transition">Contacts</a> -->
                        <a href="/#faqs" class="text-gray-200 hover:text-white transition">FAQs</a>
                    </div>
                    <div class="ml-auto justify-self-end">
                        <router-link v-if="authUser.value != null" :to="{ name: 'login' }" class="text-gray-200 hover:text-white transition">
                            Connexion
                        </router-link>
                        <button v-else @click="logout" class="text-gray-200 hover:text-white transition">
                            Déconnexion
                        </button>
                    </div>
                </div>
                <!-- nav menu end -->

            </div>
        </div>
    </nav>
    <!-- navbar end -->
</template>

<style scoped>

</style>
