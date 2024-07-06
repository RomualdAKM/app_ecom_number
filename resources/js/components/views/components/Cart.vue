<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';
import { useShoppingStore } from '../../../stores/pinia';
import Header from './header.vue';
import NavBar from './NavBar.vue';
import MobileMenubar from './MobileMenubar.vue';
import MobileSidebar from './MobileSidebar.vue';
import router from "./../../../router/index.js"

import Footer from './Footer.vue';
import { openKkiapayWidget, addKkiapayListener, removeKkiapayListener } from 'kkiapay';
import axios from 'axios';
import Copyright from "./Copyright.vue";

// Store and reference variables
const data = useShoppingStore();
const cartTotal = ref(data.getCartTotal);
const codes = ref([]);
const formCode = ref('');
const showCodePromoSection = ref(true);

// Success handler for payment
const successHandler = async () => {
  try {
    // Créer la charge utile avec les produits du panier
    const payload = {
      items: data.getCartItems,
      total: cartTotal.value,
    };

    // Inclure le code promo s'il n'est pas vide
    if (formCode.value.trim() !== '') {
      payload.promoCode = formCode.value;
    }

    // Envoyer la requête
    const response = await axios.post('/api/store_user_products', payload);
    router.push("/dashboard/BuyerProducts")

    const success = response.data.success;
    const message = response.data.message;

    if (success) {
      toast.fire({ icon: 'success', title: 'Enregistré avec succès' });

    } else {
      toast.fire({ icon: 'error', title: 'Erreur: ' + message });
    }
  } catch (error) {
    console.error("Erreur lors de l'enregistrement", error);
  }
};

// Function to open Kkiapay widget
const open = (price) => {
  openKkiapayWidget({
    amount: price,
    api_key: "e6d03d3d6591f35c24cc65ce4c05ef2cec26e9c5",
    sandbox: false,
    // phone: "61000000",
  });
};

// Fetch promo codes
const fetchPromoCodes = async () => {
  try {
    const response = await axios.get("/api/get_codes");
    codes.value = response.data.codes;
  } catch (error) {
    console.error("Erreur lors de la récupération des codes promo", error);
  }
};

// Apply promo code to cart
const applyPromo = (price) => {
  const promo = codes.value.find(c => c.name === formCode.value);
  if (promo) {
    const newPrice = (price * (1 - promo.percentage / 100)).toFixed(2);
    cartTotal.value = parseFloat(newPrice);
    toast.fire({ icon: 'success', title: 'Code promo valide' });
    showCodePromoSection.value = false;
  } else {
    formCode.value = '';
    toast.fire({ icon: 'error', title: 'Code promo invalide' });
  }
};

// Lifecycle hooks
onMounted(async () => {
  await fetchPromoCodes();
  addKkiapayListener('success', successHandler);
});

onBeforeUnmount(() => {
  removeKkiapayListener('success', successHandler);
});

</script>

<template>
  <div>
    <Header />
    <NavBar />
    <MobileMenubar />
    <MobileSidebar />
    <div class="py-4 container flex gap-3 items-center">
      <a href="/" class="text-green-900 text-base"><i class="fas fa-home"></i></a>
      <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
      <p class="text-gray-600 font-medium uppercase">Panier</p>
    </div>
    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
      <div class="xl:col-span-9 lg:col-span-8">
        <div class="bg-gray-200 py-2 pl-12 pr-20 xl:pr-28 mb-4 hidden md:flex">
          <p class="text-gray-600 text-center">Product</p>
          <p class="text-gray-600 text-center ml-auto mr-16 xl:mr-24">Price</p>
        </div>
        <div class="space-y-4" v-for="item in data.getCartItems" :key="item.id">
          <div class="flex items-center md:justify-between gap-4 md:gap-6 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
            <div class="w-32 flex-shrink-0">
                <img
                    :src="'/storage/' + item.hover_image" class="w-full"
                    :alt="item.name"
                >
            </div>
            <div class="md:w-1/3 w-full">
              <h2 class="text-gray-800 mb-3 xl:text-xl font-medium uppercase">{{ item.name }}</h2>
            </div>
            <div class="flex text-gray-600 divide-x divide-gray-300">
              <p class="text-green-900 font-semibold">{{ item.price }} F.CFA</p>
            </div>
            <div class="text-gray-600 hover:text-primary cursor-pointer">
              <i class="fas fa-trash" @click="data.removeFromCart(item)"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="xl:col-span-3 lg:col-span-4 border border-gray-200 px-4 py-4 rounded mt-6 lg:mt-0">
        <div class="flex justify-between my-3 text-gray-800 font-semibold uppercase">
          <h4>Total</h4>
          <h4>{{ cartTotal }} F.CFA</h4>
        </div>
        <div class="flex mb-5" v-if="showCodePromoSection">
          <input type="text" v-model="formCode" placeholder="Coupon" class="pl-4 w-full border border-r-0 border-green-900 py-2 px-3 rounded-l-md" />
          <button type="button" @click="applyPromo(cartTotal)" class="bg-green-900 border text-white px-5 font-medium rounded-r-md">Appliquer</button>
        </div>
        <button type="button" @click="open(cartTotal)" class="bg-green-900 text-white px-4 py-3 font-medium rounded-md">Payez Maintenant</button>
      </div>
    </div>
  </div>
</template>
