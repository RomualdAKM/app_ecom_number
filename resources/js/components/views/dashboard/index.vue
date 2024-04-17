<script setup>

import Header from "../components/header.vue";
import MobileMenubar from "../components/MobileMenubar.vue";
import MobileSidebar from "../components/MobileSidebar.vue";
import NavBar from "../components/NavBar.vue";
import SideBar from "../components/dashboardComponents/SideBar.vue";
import DashboardContent from "../components/dashboardComponents/DashboardContent.vue";
import Footer from "../components/Footer.vue";
import Copyright from "../components/Copyright.vue";
</script>

<template>
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

    <!-- dashboard wrapper -->
    <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-16">
        <!-- sidebar -->
            <SideBar />
        <!-- sidebar end -->

        <!-- dashboard content -->
            <router-view>

            </router-view>
        <!-- dashboard content end -->
    </div>
    <!-- dashboard wrapper end -->

    <Footer />

    <Copyright />
</template>

<style scoped>

</style>
