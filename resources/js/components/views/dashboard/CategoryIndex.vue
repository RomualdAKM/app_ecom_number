<template>
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <!-- component -->
        <div class="overflow-x-auto">
            <div class="sm:flex items-center justify-between">
                <p class="uppercase">Liste des payss</p>
                <button type="button"
                        @click="showModal = true"
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 my-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <span class="text-sm font-medium leading-none text-white">Ajouter une pays</span>
                </button>
            </div>
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Ajouté le</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <template v-if="categories && categories.length">
                        <tr v-for="category in categories" :key="category.id">
                            <td class="border px-4 py-2">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-12 h-12 rounded-full" :src="'/storage/' + category.image" :alt="category.name"/>
                                    </div>
                                    <span class="font-medium">{{ category.name }}</span>
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ category.created_at }}</span>
                            </td>
                            <td>
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg @click="editCategory(category); " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg @click="destroyCategory(category.id)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Modal: créer pays -->
        <CategoryModal
            :showModal="showModal"
            :toggleModal="toggleModal"
            :getCategories="getCategories"
            :category="category"
            :mode="mode"
            :updateCategory="updateCategory"
            :storeCategory="storeCategory"
            :form="form"
            :onImage="onImage"
        />
    </div>

</template>

<style scoped>

</style>

<script setup>
import {onMounted, ref, watch} from "vue";
import CategoryModal from "./partials/CategoryModal.vue";
import useCateogiries from "../../../compositions/categories";

const {
    category,
} = useCateogiries();

const showModal = ref(false);
const mode = ref('create');
const categories = ref([]);

const form = ref({
    name: '',
})

// Récupérer l'image de la pays
const  onImage = (e) => {
    form.value.image = e.target.files[0]
}
// Récupérer toutes les payss
const getCategories = async () =>{
    let response = await axios.get('/api/get_categories');
    categories.value = response.data.categories;
}

// Initialiser le datatable
const initDataTable = () => {
    $('#dataTable').DataTable();
};

onMounted( async () => {
    getCategories()
        .then(() => {
            initDataTable()
        })

});

const toggleModal = () => {
    showModal.value = !showModal.value;
    form.value = ({})
    if (showModal.value === false) mode.value = 'create'
};

// Editer une pays
const editCategory = async (category) => {
    let response = await axios.get('/api/editCategory/' + category.id)
    category.value  = response.data.category
    toggleModal()
    mode.value = 'edit'
    form.value = category
}

// Créer une pays
const storeCategory = async () => {
    let formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('image', form.value.image)
    await axios.post('/api/storeCategory', formData)
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
        });
}

// Mettre à jour une pays
const updateCategory = async () => {
    let formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('image', form.value.image)
    formData.append('_method', 'put');
       await axios.post('/api/updateCategory/'+form.value.id, formData)
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
                            toggleModal()
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
            });
}

const destroyCategory = async (id) => {
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
                axios.delete('/api/destroyCategory/'+id)
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
                                    getCategories()
                                }
                            })
                        }
                    })
                    .catch(error => {
                        console.log(error)
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
</script>
