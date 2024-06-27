<script setup>
import {ref,onMounted}  from 'vue'
import router from "./../../../../router/index.js"
const authUser = ref({})

const getInfoAuthUser = async () =>{
    let response = await axios.get('/api/getAuthUser');
    authUser.value = response.data.data;
    console.log('authUser',authUser.value)
}

const logout = () => {
  sessionStorage.removeItem("token");

   router.push("/");
};

onMounted( async () => {
  await  getInfoAuthUser()

})


</script>

<template>
    <!-- sidebar -->
    <div class="col-span-3">
        <!-- account profile -->
        <div class="px-4 py-3 shadow flex items-center gap-4">
            <div class="flex-shrink-0">
                <img src="/images/avatar.png"
                     class="rounded-full w-14 h-14 p-1 border border-gray-200 object-cover">
            </div>
            <div>
                <p class="text-gray-600">Salut,</p>
                <h4 class="text-gray-800 capitalize font-medium">
                        {{ authUser.name }}
                </h4>
            </div>
        </div>
        <!-- account profile end -->

        <!-- Dashboard links -->
        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <!-- Profil single link -->
            <div class="space-y-1 pl-8">
                <router-link :to="{name:'dashboard-profil'}" class="relative text-base font-medium capitalize hover:text-green-600 transition block">
                    Profil
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-user-cog"></i>
                    </span>
                </router-link>
            </div>

            <!-- Profil single link end -->

            <!-- Category single link -->
            <div class="space-y-1 pl-8" v-if="authUser.is_admin == 'admin' ">
                <router-link :to="{name: 'dashboard-categories'}"
                   class="relative text-base font-medium capitalize hover:text-green-600 transition block">
                    pays
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-list"></i>
                    </span>
                </router-link>
            </div>
            <!-- Category single link end -->

            <!-- Product single link -->
            <div class="space-y-1 pl-8 pt-4" v-if="authUser.is_admin == 'admin'">
                <router-link :to="{name:'dashboard-products'}"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-green-600 transition block">
                    Produits
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-shopping-cart"></i>
                    </span>
                </router-link>
            </div>
            <!-- Product single link end -->

            <!-- Code Promo single link -->
            <div class="space-y-1 pl-8 pt-4" v-if="authUser.is_admin == 'admin'">
                <router-link :to="{name:'dashboard-code'}"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-green-600 transition block">
                    Codes Promo
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-tag"></i>
                    </span>
                </router-link>
            </div>
            <!-- Code Promo single link end -->
            <!-- Buyer products  single link -->
            <div class="space-y-1 pl-8 pt-4">
                <router-link :to="{name:'dashboard-BuyerProducts'}"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-green-600 transition block">
                    Vos achats
                    <!-- Corrected spelling -->
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-shopping-basket"></i>
                    </span>
                </router-link>
            </div>
            <!-- Buyer products  single link end -->

            <!-- single link end -->
            <!-- single link -->
            <div class="pl-8 pt-4">
                <button type="button" @click="logout()"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-green-600 transition block">
                    logout
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                </button>
            </div>
            <!-- single link end -->
        </div>
        <!-- Dashboard links end -->
    </div>
    <!-- sidebar end -->
</template>

<style scoped>

</style>
