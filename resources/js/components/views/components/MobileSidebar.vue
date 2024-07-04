<script setup>

</script>

<template>
    <!-- mobile sidebar menu -->
    <div class="fixed left-0 top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow hidden" id="mobileMenu">
        <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
            <div id="closeMenu"
                 class="text-gray-400 hover:text-primary text-lg absolute right-3 top-3 cursor-pointer">
                <i class="fas fa-times"></i>
            </div>
            <!-- navlink -->
            <h3 class="text-xl font-semibold text-gray-700 mb-1 font-roboto pl-4 pt-4">Menu</h3>
            <div class="">
                <router-link :to="{ name:'index' }" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Acceuil
                </router-link>
                <a href="#about" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    À Propos
                </a>
                <!-- <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Contacts
                </a> -->
                <a href="#faqs" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    FAQs
                </a>
            </div>
            <!-- navlinks end -->
        </div>
    </div>
    <!-- mobile sidebar menu end -->
</template>

<style scoped>

</style>
