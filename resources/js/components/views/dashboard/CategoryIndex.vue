<script setup>
import {onMounted, ref} from "vue";
import CategoryModal from "./partials/CategoryModal.vue";
import useCateogiries from "../../../compositions/categories";

const {
    categories,
    errors,
    category,
    getCategory,
    getCategories,
    createCategory,
    updateCategory,
    deleteCategory
} = useCateogiries();
const showModal = ref(false);
const mode = ref('create');
//const categoryIdToUpdate = ref(null);

const form = ref({
    name: ''
})

onMounted( async () => {
    getCategories()

});
const toggleModal = () => {
    showModal.value = !showModal.value;
    form.value = ({})
    if (showModal.value === false) mode.value = 'create'
};

const editCategory = (category) => {
    getCategory(category.name)
    toggleModal()
    mode.value = 'edit'
    form.value = category
}

const storeCategory = async () => {
    await createCategory(form.value)
        .then(response => {
            getCategories()
            toggleModal()
            toast.fire({
                icon: "success",
                title: 'Catégorie ajoutée avec succès'
            })
        })
}

const saveCategory = async () => {
    if (form.value != null) category.value = form.value
    await updateCategory(category.value.id)
        .then(response => {
            getCategories()
            toggleModal()
            toast.fire({
                icon: "success",
                title: 'Catégorie mise à jour avec succès'
            })
        })
}

const destroyCategory = async (id) => {
    Swal.fire({
        title: 'Are you sure ?',
        text: "You can't go back",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it !'
    })
        .then((result) => {
            if(result.value){
                deleteCategory(id)
                    .then(() => {
                        Swal.fire(
                            'Delete',
                            'Categorie delete successfully',
                            'success'
                        )
                        getCategories()
                    })
            }
        })
}
</script>

<template>
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <!-- component -->
        <div class="overflow-x-auto">
            <div class=" flex items-center  font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">
                        <div class="sm:flex items-center justify-between">
                            <p class="uppercase">Liste des catégories</p>
                            <button type="button"
                                    @click="showModal = true"
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 my-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                                <p class="text-sm font-medium leading-none text-white">Ajouter une catégorie</p>
                            </button>
                        </div>
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nom</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="category in categories" :key="category.id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <span class="font-medium">{{ category.name }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: créer catégorie -->
        <CategoryModal
            :showModal="showModal"
            :toggleModal="toggleModal"
            :getCategories="getCategories"
            :category="category"
            :mode="mode"
            :saveCategory="saveCategory"
            :storeCategory="storeCategory"
            :form="form"
        />

    </div>

</template>

<style scoped>

</style>
