<template>
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <!-- component -->
        <div class="overflow-x-auto">
            <div class="sm:flex items-center justify-between">
                <p class="uppercase">Liste des produits</p>
                <button type="button"
                        @click="toggleModal()"
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 my-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Ajouter un produit</p>
                </button>
            </div>
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nom</th>
                    <th class="py-3 px-6 text-left">Categorie</th>
                    <th class="py-3 px-6 text-left">Prix</th>
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
                            <span class="font-medium">{{ product.name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 whitespace-nowrap">
                        <span class="font-medium">{{ product.category.name }}</span>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ product.price }}</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg @click="getProduct(product.id); " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
<!--                            show action-->
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <router-link :to="'/product/' + product.id" title="Détails du produit" >
                                    <i class="fas fa-eye"></i>
                                </router-link>
                            </div>

                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <i @click="deleteProduct(product.id)" class="fas fa-trash" title="Supprimer le produit"></i>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-------------- PRODUCT MODAL --------------->
    <div
        v-if="showModal"
        class="fixed inset-0 flex items-center justify-center z-50"
    >
        <div class="modal-overlay absolute inset-0 bg-black opacity-30"></div>

        <div class="modal-container bg-white custom-modal-width  mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Contenu du modal -->
            <div class="modal-content py-4 text-left px-6">
                <h2 class="text-2xl font-semibold mb-4">
                    {{ !editMode ? 'Créer un produit' : 'Modifier un produit' }}
                </h2>

                <!-- PRODUCT FORM -->
                <form>
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="space-y-4">
                        <!-- Form row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- Single input -->
                            <div>
                                <label for="name" class="text-gray-600 mb-2 block">
                                    Nom
                                </label>
                                <input id="name" type="text" class="input-box" v-model="form.name" required>
                            </div>
                            <!-- single input end -->
                            <!-- single input -->
                            <div>
                                <label for="category" class="text-gray-600 mb-2 block">
                                    Catégorie
                                </label>
                                <select id="category" v-model="form.category_id" class="input-box">
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                      {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <!-- Single input end -->
                        </div>
                        <!-- Form row end -->
                        <div class="grid sm:grid-cols-2 gap-4">
                          <div>
                            <label for="price" class="text-gray-600 mb-2 block">
                              Prix
                            </label>
                            <input id="price" type="number" class="input-box" name="price" v-model="form.price">
                          </div>
                          <div>
                            <label for="description" class="text-gray-600 mb-2 block">
                              Description
                            </label>
                            <textarea name="" id="description" cols="15" class="input-box" v-model="form.description"></textarea>
                          </div>

                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label for="hover_image" class="text-gray-600 mb-2 block">
                                    Image de fond
                                </label>
                                <input id="hover_image" type="file" class="input-box" ref="hover_image" @change="onImage" >
                            </div>
                          <div>
                                <label for="File" class="text-gray-600 mb-2 block">
                                    Fichier des contacts
                                </label>
                                <input id="file" type="file" class="input-box" ref="file" @change="onFile">
                            </div>
                        </div>

                    </div>
                    <!-- Boutons -->
                    <div class="flex justify-end mt-4">
                            <button @click="!editMode ? storeProduct() : updateProduct()"
                                    type="button"
                                    class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600"
                            >
                                {{ !editMode ? 'Créer' : 'Modifier' }}
                            </button>
                            <button
                                type="button"
                                class="px-4 py-2 ml-2 text-gray-600 rounded hover:text-gray-800 focus:outline-none"
                                @click="toggleModal"
                            >
                                Annuler
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</template>

<style scoped>
.custom-modal-width {
    width: 500px;
}
</style>

<script setup>
import {onMounted, ref} from "vue";

const products = ref([])
const categories = ref([])
const showModal = ref(false)
const editMode = ref(false)

const product = ref([])
const hover_image = ref(null);
const file = ref(null);

const form = ref({
    name: '',
    category_id: '',
    description: '',
    price: '',
})

const toggleModal = () => {
    showModal.value = !showModal.value;
    form.value = {}
    if (showModal.value === false) {
        editMode.value = false
    }
};

// Récupérons les produits
const getProducts = async () => {
    let response = await axios.get('/api/get_products/')
    products.value = response.data.products
}

// Récupérons les catégories
const getCategories = async () => {
    let response = await axios.get('/api/get_categories/')
    categories.value = response.data.categories
}

// get hover_image and file name
const  onFile = (e) => {
    // ajouter file à form
    form.value.file = e.target.files[0]
    //file.value = e.target.files[0]

}
const onImage = (e) => {
    form.value.hover_image = e.target.files[0]
    //hover_image.value = e.target.files[0]
}

const formDataFunc = () => {
    let formData = new FormData()
    formData.append('name', form.value.name? form.value.name : '')
    formData.append('category_id', form.value.category_id ? form.value.category_id : '')
    formData.append('description', form.value.description ? form.value.description : '')
    formData.append('price', form.value.price ? form.value.price : '')
    formData.append('hover_image', form.value.hover_image ? form.value.hover_image : '')
    formData.append('file', form.value.file ? form.value.file : '')

    return formData
}

// Stocker le produit
const storeProduct = async () => {
    let formData = formDataFunc()
    await axios.post('/api/storeProduct/', formData).then((response) => {
        getProducts()
        toggleModal()
        if (response.data.success){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.success,
                showConfirmButton: true,
                timer: 1000,
                toast: true,
                timerProgressBar: true,
                didClose() {
                    window.location.reload()
                }
            })
        }
    })
        .catch(error => {
            console.log(error)
            let message = ''
            if (error.response.data.errors){
                message = '<ul>' +
                    Object.values(error.response.data.errors).map(message => {
                        return '<li>' + message + '</li>';
                    }) +
                    '</ul>'
            } else if (error.response.data.error){
                message = error.response.data.error
            }
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                html: message,
                showConfirmButton: true,
                toast: true,
            });

    })
}

const getProduct = async (id) => {
    let response = await axios.get('/api/get_product/'+id)
    product.value = response.data.product
    editMode.value = true
    // Mettez à jour les références hover_image et file à partir de form.value

    toggleModal()
    form.value = product.value
    form.value.hover_image = ''
    form.value.file = ''
}

const updateProduct = async () => {
    let formData = formDataFunc();
    formData.append('_method', 'put');
    await axios.post('/api/updateProduct/'+product.value.id, formData).then((response) => {
        if (response.data.success){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.success,
                showConfirmButton: true,
                timer: 1000,
                toast: true,
                timerProgressBar: true,
                didClose() {
                    getProducts()
                    toggleModal()
                }
            })
        }
    }) .catch(error => {
        //console.log(error)
        let message = ''
        if (error.response.data.errors){
            message = '<ul>' +
                Object.values(error.response.data.errors).map(message => {
                    return '<li>' + message + '</li>';
                }) +
                '</ul>'
        } else if (error.response.data.error){
            message = error.response.data.error
        }
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            html: message,
            showConfirmButton: true,
            toast: true,
        });
    });
}
const deleteProduct = async (id) => {
    Swal.fire({
        title: 'Are you sure ?',
        text: "You can't go back",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it !',
        reverseButtons: true
    })
        .then((result) => {
            if(result.value){
                axios.delete('/api/destroyProduct/'+id)
                    .then(response => {
                        if (response.data.success){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.success,
                                showConfirmButton: true,
                                timer: 1000,
                                toast: true,
                                timerProgressBar: true,
                                didClose() {
                                    getProducts()
                                }
                            })
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: error.response.data.error,
                            showConfirmButton: true,
                            toast: true,
                        });
                    });
            }
        })
}

onMounted(() => {
    getProducts()
    getCategories()
        .then(() => {
            $('#dataTable').DataTable();
        })
})
</script>
