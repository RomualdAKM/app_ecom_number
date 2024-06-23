<template>

    <div class="container main-container">
        <router-view></router-view>
        <Copyright />
    </div>
</template>
<script setup>

import Copyright from "./views/components/Copyright.vue";
</script>

<style>
.main-container {
    padding-bottom: 60px; /* Ajustez la valeur pour correspondre à la hauteur de votre barre de menu mobile */
}
</style>
g
