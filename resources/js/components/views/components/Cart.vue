<script setup>
import Header from "./header.vue"
import NavBar from "./NavBar.vue"
import MobileMenubar from "./MobileMenubar.vue"
import MobileSidebar from "./MobileSidebar.vue"
import Footer from "./Footer.vue"
import { useShoppingStore } from './../../../stores/pinia.js'

const data = useShoppingStore();

</script>

<template>
    <div>
         <!-- header -->
         <Header />
    <!-- header end -->

    <!-- navbar -->
        <NavBar />
    <!-- navbar end -->

    <!-- mobile menubar -->
        <MobileMenubar />
    <!-- mobile menu end -->

    <!-- mobile sidebar menu -->
        <MobileSidebar />
    <!-- mobile sidebar menu end -->

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
                <a href="index.html" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Home
                </a>
                <a href="shop.html" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Shop
                </a>
                <a href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    About Us
                </a>
                <roa href="#" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Contact Us
                </roa>
            </div>
            <!-- navlinks end -->
        </div>
    </div>
    <!-- mobile sidebar menu end -->

    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="index.html" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">Shopping Cart</p>
    </div>
    <!-- breadcrum end -->

    <!-- cart wrapper -->
    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
        <!-- product cart -->
        <div class="xl:col-span-9 lg:col-span-8">
            <!-- cart title -->
            <div class="bg-gray-200 py-2 pl-12 pr-20 xl:pr-28 mb-4 hidden md:flex">
                <p class="text-gray-600 text-center">Product</p>
                <p class="text-gray-600 text-center ml-auto mr-16 xl:mr-24">Price</p>
                
            </div>
            <!-- cart title end -->

            <!-- shipping carts -->
            <div class="space-y-4" v-for="item in data.getCartItems" :key="item.id">
                <!-- single cart -->
                <div
                    class="flex items-center md:justify-between gap-4 md:gap-6 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
                    <!-- cart image -->
                    <div class="w-32 flex-shrink-0">
                        <img src="images/products/product9.jpg" class="w-full">
                    </div>
                    <!-- cart image end -->
                    <!-- cart content -->
                    <div class="md:w-1/3 w-full">
                        <h2 class="text-gray-800 mb-3 xl:text-xl textl-lg font-medium uppercase">
                            {{item.name}}
                        </h2>
                        
                    </div>
                    <!-- cart content end -->
                    <!-- cart quantity -->
                    <div class="flex  text-gray-600 divide-x divide-gray-300">
                        <p class="text-primary font-semibold">{{item.price}} F.CFA</p>
                    </div>
                    <!-- cart quantity end -->
                    <!-- <div class="ml-auto md:ml-0">
                        <p class="text-primary text-lg font-semibold">$320.00</p>
                    </div> -->
                    <div class="text-gray-600 hover:text-primary cursor-pointer">
                        <i class="fas fa-trash" 
                        @click="data.removeFromCart(item)"></i>
                    </div>
                </div>
                <!-- single cart end -->
               
            </div>
            <!-- shipping carts end -->
        </div>
        <!-- product cart end -->
        <!-- order summary -->
        <div class="xl:col-span-3 lg:col-span-4 border border-gray-200 px-4 py-4 rounded mt-6 lg:mt-0">
            
            <div class="flex justify-between my-3 text-gray-800 font-semibold uppercase">
                <h4>Total</h4>
                <!-- <h4>{{ data.cartItems.reduce((acc,item) => acc += item.price,0) }}</h4> -->
                <h4>{{ data.cartItems.reduce((acc, item) => acc + parseFloat(item.price), 0) }} F.CFA</h4>

            </div>

            <!-- searchbar -->
            <div class="flex mb-5">
                <input type="text"
                    class="pl-4 w-full border border-r-0 border-primary py-2 px-3 rounded-l-md focus:ring-primary focus:border-primary text-sm"
                    placeholder="Coupon">
                <button type="submit"
                    class="bg-primary border border-primary text-white px-5 font-medium rounded-r-md hover:bg-transparent hover:text-primary transition text-sm font-roboto">
                    Apply
                </button>
            </div>
            <!-- searchbar end -->

            <!-- checkout -->
            <a href="checkout.html" class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent
             hover:text-primary transition text-sm w-full block text-center">
                Process to checkout
            </a>
            <!-- checkout end -->
        </div>
        <!-- order summary end -->
    </div>
    <!-- cart wrapper end -->

    <Footer />



    </div>
    
</template>