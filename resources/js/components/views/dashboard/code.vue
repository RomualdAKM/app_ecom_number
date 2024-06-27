<template>
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <!-- component -->
        <div class="overflow-x-auto">
            <div class="sm:flex items-center justify-between">
                <p class="uppercase">Liste des codes promos</p>
                <button type="button"
                        @click="showModal = true"
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 my-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <span class="text-sm font-medium leading-none text-white">Ajouter un code</span>
                </button>
            </div>
            <div class="">
                <table id="dataTable" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Pourcentage</th>
                        <th class="px-4 py-2">Commercial</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Téléphone</th>
                        <th class="px-4 py-2">Ajouté le</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="codes && codes.length">
                        <tr v-for="code in codes" :key="code.id">
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.name }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.percentage }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.full_name }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.email }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.phone }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <span class="font-medium">{{ code.created_at }}</span>
                            </td>
                            <td>
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg @click="editCode(code); " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg @click="destroyCode(code.id)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        </div>

        <!-- Modal: créer pays -->
        <CodeModal
            :showModal="showModal"
            :toggleModal="toggleModal"
            :getCodes="getCodes"
            :code="code"
            :mode="mode"
            :updateCode="updateCode"
            :storeCode="storeCode"
            :form="form"
        />
    </div>

</template>

<style scoped>

</style>

<script setup>
import {onMounted, ref, watch} from "vue";
import CodeModal from "./partials/CodeModal.vue";

const showModal = ref(false);
const mode = ref('create');
const codes = ref([]);
const code = ref([])
const editMode = ref(false)

const form = ref({
    name: '',
    percentage: '',
    full_name: '',
    email: '',
    phone: '',
})

// Récupérer tous les codes
const getCodes = async () =>{
    let response = await axios.get('/api/get_codes');
    codes.value = response.data.codes;
    console.log(codes.value);
}

// Initialiser le datatable
const initDataTable = () => {
    $('#dataTable').DataTable();
};

onMounted( async () => {
    getCodes()
        .then(() => {
            initDataTable()
        })

});

const toggleModal = () => {
    showModal.value = !showModal.value;
    form.value = ({})
    if (showModal.value === false) mode.value = 'create'
};

// Editer un code
const editCode = async (code) => {
    let response = await axios.get('/api/editCode/' + code.id)
    code.value  = response.data.code
    toggleModal()
    mode.value = 'edit'
    form.value = code
}

// Créer un code
const storeCode = async () => {
    await axios.post('/api/storeCode', form.value)
        .then(response => {
            if (response.data.success){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.data.success,
                    showConfirmButton: true,
                    timer: 3000,
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

// Mettre à jour un code
const updateCode = async () => {
    //if (form.value != null) code.value = form.value
       await axios.put('/api/updateCode/'+form.value.id, form.value)
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

const destroyCode = async (id) => {
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
                axios.delete('/api/destroyCode/'+id)
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
                                    getCodes()
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
