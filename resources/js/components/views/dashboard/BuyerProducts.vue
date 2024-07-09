<template>
       <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-16">
        <!-- component -->
        <div class="overflow-x-auto mt-4 mb-4">
            
            <div class="sm:flex mb-4 items-center justify-between">
                <p class="uppercase">Mes achats</p>
               
            </div>
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Photo</th>
                    <th class="py-3 px-6 text-left">Nom</th>
                    <th class="py-3 px-6 text-left">Prix</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                <tr v-for="product in products" :key="product.id" class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left ">
                        <div class="flex items-center">
                            <div class="mr-2">
                                <img class="w-12 h-12 rounded-full" :src="'/storage/' + product.hover_image" :alt="product.name"/>
                            </div>
                         
                        </div>
                    </td>
                    <td class="py-3 px-6 whitespace-nowrap">
                        <span class="font-medium">{{ product.name }}</span>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ product.price }} F CFA</span>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ formatDate(product.created_at) }} </span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-8 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <a :href="'/storage/' + product.file" class="flex items-center" target="_blank" download>
                                   
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </a>

                            </div>
                           
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script setup>
import {ref,onMounted}  from 'vue'

const products = ref({})

const getBuyerProducts = async () =>{
    let response = await axios.get('/api/get_buyer_products');
    products.value = response.data.products;
    console.log('buyer products',products.value)
}

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric", hour: "numeric", minute: "numeric" };
    return new Date(dateString).toLocaleString("fr-FR", options);
};
onMounted( async () => {
  await  getBuyerProducts()

})

</script>