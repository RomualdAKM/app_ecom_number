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
        <!-- <MobileSidebar /> -->
    <!-- mobile sidebar menu end -->

    <!-- banner -->
        <Banner />
    <!-- banner end -->

    <!-- Why -->
    <Why />
    <!-- Why end -->


   <!--SHOP BY CATEGORY -->
        <CategoryList />

    <!-- top new arrival -->
        <NewArrival />

        <!-- About -->
        <About />
       <!-- About end -->
         <!-- Faq -->
         <Faq />
    <!-- Faq end -->

        <!-- <Footer /> -->

    </div>
</template>

<script setup>
import CategoryList from "./components/CategoryList.vue";
import NewArrival from "./components/NewArrival.vue";
import Header from "./components/header.vue";
import Faq from "./components/Faq.vue";
import About from "./components/About.vue";
import Why from "./components/Why.vue";
import Feature from "./components/Feature.vue";
import NavBar from "./components/NavBar.vue";
import MobileMenubar from "./components/MobileMenubar.vue";
import MobileSidebar from "./components/MobileSidebar.vue";
import Banner from "./components/Banner.vue";
import Footer from "./components/Footer.vue";
import Copyright from "./components/Copyright.vue";

</script>
