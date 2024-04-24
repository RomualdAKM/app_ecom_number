<script setup>

import {ref} from "vue";

const props = defineProps({
    showModal: Boolean,
    toggleModal: Function,
    storeCode: Function,
    updateCode: Function,
    getCodes: Function,
    code: ref([]),
    mode: ref(''),
    form: ref({})
});

</script>

<template>
    <!-------------- code MODAL --------------->
    <div
        v-if="showModal"
        class="fixed inset-0 flex items-center justify-center z-50"
    >
        <div class="modal-overlay absolute inset-0 bg-black opacity-30"></div>

        <div class="modal-container bg-white w-96 mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Contenu du modal -->
            <div class="modal-content py-4 text-left px-6">
                <h2 class="text-2xl font-semibold mb-4">
                    {{ props.mode === 'create' ? 'Créer un code promo' : 'Modifier un code promo' }}
                </h2>

                <!-- code FORM -->
                <form>
                    <div class="mb-4">
                        <label for="codeName" class="block text-gray-700">NOM</label>
                        <input
                            id="categorObjectyName"
                            v-model="props.form.name"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300"
                            name="name"
                            type="text"
                        />
                    </div> <div class="mb-4">
                        <label for="codePercentage" class="block text-gray-700">POURCENTAGE</label>
                        <input
                            id="categorObjectyName"
                            v-model="props.form.percentage"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300"
                            name="percentage"
                            type="text"
                        />
                    </div>
                    <div class="mb-4">
                        <label for="codeFullName" class="block text-gray-700">COMMERCIAL</label>
                        <input
                            id="categorObjectyName"
                            v-model="props.form.full_name"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300"
                            name="full_name"
                            type="text"
                        />
                    </div>
                    <div class="mb-4">
                        <label for="codeEmail" class="block text-gray-700">EMAIL</label>
                        <input
                            id="categorObjectyName"
                            v-model="props.form.email"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300"
                            name="email"
                            type="email"
                        />
                    </div><div class="mb-4">
                        <label for="codeFullName" class="block text-gray-700">TELEPHONE</label>
                        <input
                            id="categorObjectyName"
                            v-model="props.form.phone"
                            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300"
                            name="phone"
                            type="text"
                        />
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-end">
                        <button @click="props.mode === 'create' ? props.storeCode() : props.updateCode()"
                            type="button"
                            class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600"
                        >
                            {{ props.mode === 'create' ? 'Créer' : 'Modifier' }}
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

</style>
