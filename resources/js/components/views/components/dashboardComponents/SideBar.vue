<script setup>

</script>

<template>
    <!-- sidebar -->
    <div class="col-span-3">
        <!-- account profile -->
        <div class="px-4 py-3 shadow flex items-center gap-4">
            <div class="flex-shrink-0">
                <img src="images/avatar.png"
                     class="rounded-full w-14 h-14 p-1 border border-gray-200 object-cover">
            </div>
            <div>
                <p class="text-gray-600">Hello,</p>
                <h4 class="text-gray-800 capitalize font-medium">Russell Ahmed</h4>
            </div>
        </div>
        <!-- account profile end -->

        <!-- Dashboard links -->
        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <!-- Category single link -->
            <div class="space-y-1 pl-8">
                <router-link :to="{name: 'dashboard-categories'}"
                   class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
                    Manage categories
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="far fa-address-card"></i>
                        </span>
                </router-link>
                <!-- <a href="profile-info.html" class="hover:text-primary transition capitalize block">Profile information</a>-->

            </div>
            <!-- Category single link end -->

            <!-- Product single link -->
            <div class="space-y-1 pl-8 pt-4">
                <a href="#"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block">
                    Manage products
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-gift"></i>
                        </span>
                </a>
            </div>
            <!-- Product single link end -->

            <!-- single link -->
            <div class="space-y-1 pl-8 pt-4">
                <a href="#"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block">
                    Payment methods
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="far fa-credit-card"></i>
                        </span>
                </a>
                <a href="#" class="hover:text-primary transition block capitalize">Voucher</a>
            </div>
            <!-- single link end -->
            <!-- single link -->
            <div class="pl-8 pt-4">
                <a href="wishlist.html" class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block">
                    my wishlist
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="far fa-heart"></i>
                        </span>
                </a>
            </div>
            <!-- single link end -->
            <!-- single link -->
            <div class="pl-8 pt-4">
                <a href="#"
                   class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block">
                    logout
                    <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                </a>
            </div>
            <!-- single link end -->
        </div>
        <!-- Dashboard links end -->
    </div>
    <!-- sidebar end -->
</template>

<style scoped>

</style>
