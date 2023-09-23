<script setup>
import {reactive} from "vue";
import useCateogiries from "../../../../compositions/categories";

const form = reactive({
    name: ''
})

const { createCategory } = useCateogiries();
const storeCategory = async () => {
    await createCategory({form});
}
</script>

<template>

</template>

<style scoped>

</style>
