<script setup>
import { useShoppingStore } from './../../../stores/pinia.js'

const data = useShoppingStore();



</script>

<template>
    <!-- header -->
    <header class="py-4 shadow-sm bg-pink-100 lg:bg-white">
        <div class="container flex items-center justify-between">
            <!-- logo -->
            <a href="#" class="block w-32">
                <img src="images/logo.svg" alt="logo" class="w-full">
            </a>
            <!-- logo end -->



            <!-- navicons -->
            <div class="space-x-4 flex items-center">

                <router-link to="/cart"
                   class="lg:block text-center text-gray-700 hover:text-primary transition hidden relative">
                    <span
                        class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">{{data.countCartItems}}</span>
                    <div class="text-2xl">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="text-xs leading-3">Panier</div>
                </router-link>
                <router-link :to="{ name: 'dashboard'}" class="block text-center text-gray-700 hover:text-primary transition">
                    <div class="text-2xl">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="text-xs leading-3">Compte</div>
                </router-link>
            </div>
            <!-- navicons end -->
        </div>
    </header>
    <!-- header end -->
</template>
