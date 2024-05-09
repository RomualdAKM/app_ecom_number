<template>
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <!-- component -->
        <div class="overflow-x-auto">
            <div class=" flex items-center  font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <form>
                        <div class="space-y-12">
                            <form @submit.prevent="updateProfil()" id="updateProfil">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Informations Personnelles</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Mettez à jour vos informations personnelles ici.</p>

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom complet</label>
                                            <div class="mt-2">
                                                <input type="text" name="name" id="name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                       v-model="authUser.name"
                                                />
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
                                            <div class="mt-2">
                                                <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                       v-model="authUser.email"
                                                />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Téléphone</label>
                                            <div class="mt-2">
                                                <input type="tel" name="number" id="number" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                       v-model="authUser.number"
                                                />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="sex" class="block text-sm font-medium leading-6 text-gray-900">Sexe</label>
                                            <div class="mt-2">
                                                <select id="sex" name="sex" autocomplete="sex-name" class="ps-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                        v-model="authUser.sex">
                                                    <option :value="0" >Féminin</option>
                                                    <option :value="1">Masculin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <label for="is_admin" class="block text-sm font-medium leading-6 text-gray-900">Rôle</label>
                                            <div class="mt-2">
                                                <input type="text" name="is_admin" id="is_admin" autocomplete="is_admin" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" disabled
                                                       v-model="authUser.is_admin"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <button :type="reset" class="text-sm font-semibold leading-6 text-gray-900">Annuler</button>
                                        <button type="submit" class="rounded-md bg-green-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                                    </div>
                                </div>
                            </form>

                            <form @submit.prevent="changePasswd()" id="changePasswd">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Modification du mot de passe</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Changer votre mot de passe ici</p>

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Nouveau mot de passe</label>
                                            <div class="mt-2">
                                                <input type="password" name="password" id="password" autocomplete="family-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                v-model="passwdForm.password"
                                                />
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Confirmer mot de passe</label>
                                            <div class="mt-2">
                                                <input type="password" name="confirm_password" id="confirm_password" autocomplete="family-confirm_password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    v-model="passwdForm.confirm_password"
                                                />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Annuler</button>
                                        <button type="submit" class="rounded-md bg-green-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>

<script setup>

import {onMounted, ref} from "vue";

// définir les variables dynamiques réactives
const authUser = ref([])
const passwdForm = ref({
    password: '',
    confirm_password: '',
})
const getAuthUSer = async () => {
   let response = await axios.get('/api/getAuthUser')
    //console.log(response.data.data)
    authUser.value = response.data.data
}

const updateProfil = async () => {
    await axios.put('/api/updateProfil/'+authUser.value.id, authUser.value)
        .then(response => {
           if (response.data.success){
               Swal.fire({
                   position: 'top-end',
                   icon: 'success',
                   title: response.data.success,
                   showConfirmButton: true,
                   timer: 4000,
                   toast: true,
                   timerProgressBar: true,
               })
           }
        })
        .catch(error => {
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

const changePasswd = async () => {
    await axios.put('/api/changePasswd/'+authUser.value.id, passwdForm.value)
        .then(response => {
           if (response.data.success){
               passwdForm.value.password = ''
               passwdForm.value.confirm_password = ''
               Swal.fire({
                   position: 'top-end',
                   icon: 'success',
                   title: response.data.success,
                   showConfirmButton: true,
                   timer: 4000,
                   toast: true,
                   timerProgressBar: true,
               })
           }
        })
        .catch(error => {
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
onMounted(() => {
    getAuthUSer()
})
</script>
