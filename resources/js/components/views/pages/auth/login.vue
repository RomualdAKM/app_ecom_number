<script setup>

import { reactive, ref } from "vue";
import router from "./../../../../router/index.js"

let form = reactive({
    email: "",
    password: "",
});



const login = async () => {
    await axios.post("api/login", form).then((response) => {
        if (response.data.success) {
            sessionStorage.setItem("token", response.data.data.token);
            router.push("/");
             toast.fire({
            icon: "success",
            title: "Connexion réussie",
        });
        } else {
           toast.fire({
            icon: "error",
            title: response.data.message,
        });
        }
    });
};

</script>


<template>
    <!-- form wrapper -->
    <div class="container py-16 mt-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">
                CONNEXION
            </h2>
            <p class="text-gray-600 mb-6 text-sm">
                Connectez-vous si vous êtes un client fidèle
            </p>
            <form @submit.prevent="login()">
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Adresse e-mail <span class="text-primary">*</span>
                        </label>
                        <input type="email" v-model="form.email" class="input-box" placeholder="example@mail.com">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">Mot de passe <span class="text-primary">*</span></label>
                        <input type="password" v-model="form.password" class="input-box" placeholder="tapez votre mot de passe">
                    </div>
                </div>
                <!-- <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="agreement"
                            class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="agreement" class="text-gray-600 ml-3 cursor-pointer">
                            Remember Me
                        </label>
                    </div>
                    <a href="#" class="text-primary">Forgot Password?</a>
                </div> -->
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-dark bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Se connecter
                    </button>
                </div>
            </form>



            <p class="mt-4 text-gray-600 text-center">
                Vous n'avez pas de compte ? <router-link to="/register" class="text-primary">S'inscrire maintenant
                </router-link>
            </p>
        </div>
    </div>
    <!-- form wrapper end -->
</template>
