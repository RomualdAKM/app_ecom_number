<script setup>
// Vous pouvez inclure des scripts si nécessaire
</script>

<template>
    <!-- mobile sidebar menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 bg-black bg-opacity-30 hidden">
        <div class="absolute left-0 top-0 w-72 h-full bg-green-600 shadow-lg">
            <div id="closeMenu" class="text-gray-200 hover:text-red-500 text-2xl absolute right-4 top-4 cursor-pointer">
                <i class="fas fa-times"></i>
            </div>
            <!-- navlink -->
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-white mb-4">Menu</h3>
                <router-link :to="{ name:'index' }" class="flex items-center px-4 py-3 text-lg font-medium text-white hover:bg-green-700 rounded-lg transition">
                    <i class="fas fa-home mr-3"></i>
                    Accueil
                </router-link>
                <a href="/#about" class="flex items-center px-4 py-3 text-lg font-medium text-white hover:bg-green-700 rounded-lg transition">
                    <i class="fas fa-info-circle mr-3"></i>
                    À Propos
                </a>
                <a href="/#faqs" class="flex items-center px-4 py-3 text-lg font-medium text-white hover:bg-green-700 rounded-lg transition">
                    <i class="fas fa-question-circle mr-3"></i>
                    FAQs
                </a>
            </div>
            <!-- navlinks end -->
        </div>
    </div>
    <!-- mobile sidebar menu end -->
</template>

<style scoped>
/* Ajoutez votre CSS personnalisé ici si nécessaire */
</style>
